<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		// cek apakah ada session admin
		if ($this->session->userdata("email")) {
			redirect("dashboard");
		}

		$data["page_title"] = "Login Admin";

		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/auth/login_view", $data);
		} else {
			$this->_loginAction();
		}
	}

	private function _loginAction()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");


		$adminData = $this->db->get_where("admins", ["email" => $email])->row_array();
		if ($adminData) {
			if ($adminData['is_active'] == 1) {

				if (password_verify($password, $adminData["password"])) {
					$data = [
						"name" => $adminData["name"],
						"avatar" => $adminData["avatar"],
						"email" => $adminData["email"],
						"role" => $adminData["role"],
						"is_active" => $adminData["is_active"],
						"created_at" => $adminData["created_at"],

						"logged_in" => "admin"
					];

					$this->session->set_userdata($data);
					redirect("dashboard");
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Your password is incorrect</div>');
					redirect("admin");
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">E-mail your nonaktif, hubungi admin.</div>');
				redirect("admin");
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">E-mail your tidak terdaftar</div>');
			redirect("admin");
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			"smtp_user" => "ifelseiforelif@gmail.com",
			"smtp_pass" => "PetshopApp123",
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->email->initialize($config);
		$this->email->from("ifelseiforelif@gmail.com", "Admin Petshop");
		$this->email->to($this->input->post("email"));

		if ($type == "forgot") {
			$this->email->subject("Permintaan Reset Password");
			$this->email->message('Sebuah permintaan reset password telah Accepted, klik link berikut untuk melakukan reset password : <a href="' . base_url() . 'admin/auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>. Jika your tidak pernah melakukan permintaan reset password, abaikan email ini.');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	// reset password
	public function forgotPassword()
	{
		$data["page_title"] = "Reset password";

		$this->form_validation->set_rules("email", 'E-mail', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/auth/forgotpassword_view", $data);
		} else {
			$email = $this->input->post("email");
			$user =  $this->db->get_where("admins", ["email" => $email])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert("admin_tokens", $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Silahkan cek email your untuk reset password</div>');
				redirect("admin/auth/forgotpassword");
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email ini belum terdaftar</div>');
				redirect("admin/auth/forgotpassword");
			}
		}
	}

	// reset password
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get("token");

		$user = $this->db->get_where("admins", ["email" => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where("admin_tokens", ["token" => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata("reset_email", $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata("message", "<div class='alert alert-danger'>Reset Password Gagal! Token Salah</div>");
				redirect("admin");
			}
		} else {
			$this->session->set_flashdata("message", "<div class='alert alert-danger'>Reset Password Gagal! Token Salah</div>");
			redirect("admin");
		}
	}

	// change password
	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('admin');
		}

		$data["page_title"] = "Reset Password your";

		$this->form_validation->set_rules("new_password", "New password", "trim|required|min_length[3]|matches[new_password_confirm]");
		$this->form_validation->set_rules('new_password_confirm', 'Confirm password', 'trim|required|min_length[3]|matches[new_password]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/auth/changepassword_view", $data);
		} else {
			$password = password_hash($this->input->post("new_password"), PASSWORD_DEFAULT);
			$email = $this->session->userdata("reset_email");

			$this->db->set("password", $password);
			$this->db->where("email", $email);
			$this->db->update("admins");

			$this->session->unset_userdata("reset_email");
			$this->db->delete("admin_tokens", ["email" => $email]);

			$this->session->set_flashdata("message", "<div class='alert alert-success'>Success Change password! Silahkan Login</div>");
			redirect("admin");
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("admin_id");
		$this->session->unset_userdata("name");
		$this->session->unset_userdata("avatar");
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('message', '<div class="alert alert-success">You have successfully loggin.</div>');
		redirect("admin");
	}
}
