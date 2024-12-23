<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('customer/Auth_model', 'Auth_model');
	}


	public function index()
	{
		if ($this->session->userdata("logged_in") == "customer") {
			redirect("/");
		}

		$data["page_title"] = "Login";

		$this->_loginValidation();
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("customer/auth/login_view", $data);
		} else {
			$this->_loginAction();
		}
	}

	private function _loginAction()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");

		$userData = $this->db->get_where("customers", ["email" => $email])->row_array();
		if ($userData) {
			if ($userData['is_active'] == 1) {
				if (password_verify($password, $userData["password"])) {
					$customerData = [
						"customer_id" => $userData["customer_id"],
						"name" => $userData["name"],
						"avatar" => $userData["avatar"],
						"phone" => $userData["phone"],
						"address" => $userData["address"],
						"email" => $userData["email"],
						"created_at" => $userData["created_at"],
						"logged_in" => "customer"
					];

					$this->session->set_userdata($customerData);
					redirect("/");
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Your password is incorrect</div>');
					redirect("login");
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Your email account is not yet active.</div>');
				redirect("login");
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Not registered</div>');
			redirect("login");
		}
	}

	public function register()
	{
		if ($this->session->userdata("logged_in") == "customer") {
			redirect("/");
		}

		$data["page_title"] = "Register";

		$this->_registerValidation();
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("customer/auth/register_view", $data);
		} else {
			$name = htmlspecialchars($this->input->post("name", true));
			$email = htmlspecialchars($this->input->post("email", true));
			$phone = htmlspecialchars($this->input->post("phone", true));
			$address = htmlspecialchars($this->input->post("address", true));
			$avatar = "default.jpg";
			$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
			$isActive = 1;

			// Set Data
			$userData = [
				'name' => $name,
				'avatar' => $avatar,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'password' => $password,
				'is_active' => $isActive,
			];
			$this->Auth_model->userRegistration($userData);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Success Register! Please log in</div>');
			redirect("login");
		}
	}

	public function logout()
	{
		$this->cart->destroy();
		$this->session->unset_userdata("customer_id");
		$this->session->unset_userdata("avatar");
		$this->session->unset_userdata("phone");
		$this->session->unset_userdata("address");
		$this->session->unset_userdata("email");
		$this->session->unset_userdata("created_at");
		$this->session->unset_userdata("logged_in");
		$this->session->set_flashdata('message', '<div class="alert alert-success">You have successfully logged out.</div>');
		$this->session->unset_userdata('message');
		redirect("login");
	}

	public function blocked()
	{
		$data["page_title"] = "Access Denied";

		$this->load->view("customer/auth/blocked_view", $data);
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			"smtp_user" => "ifelseiforelif@gmail.com",
			"smtp_pass" => "PetshopApp",
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->email->initialize($config);
		$this->email->from("ifelseiforelif@gmail.com", "Admin");
		$this->email->to($this->input->post("email"));

		if ($type == "forgot") {
			$this->email->subject("Reset Password");
			$this->email->message('Your password reset request has been accepted. Please click the following link to reset your password : <a href="' . base_url() . 'customer/auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>. If you have not initiated a password reset request, please ignore this email.');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	// Reset password
	public function forgotPassword()
	{
		$data["page_title"] = "Reset password";

		$this->form_validation->set_rules("email", 'E-mail', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("customer/auth/forgotpassword_view", $data);
		} else {
			$email = $this->input->post("email");
			$user =  $this->db->get_where("customers", ["email" => $email])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert("customer_tokens", $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Please check your email for a password reset link.</div>');
				redirect("customer/auth/forgotpassword");
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">This email address is not registered.</div>');
				redirect("customer/auth/forgotpassword");
			}
		}
	}

	// reset password
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get("token");

		$user = $this->db->get_where("customers", ["email" => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where("customer_tokens", ["token" => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata("reset_email", $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata("message", "<div class='alert alert-danger'>Password Reset Failed! Invalid Token</div>");
				redirect("login");
			}
		} else {
			$this->session->set_flashdata("message", "<div class='alert alert-danger'>Password Reset Failed! Invalid Token</div>");
			redirect("login");
		}
	}

	// change password
	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('login');
		}

		$data["page_title"] = "Reset Password your";

		$this->form_validation->set_rules("new_password", "New password", "trim|required|min_length[3]|matches[new_password_confirm]");
		$this->form_validation->set_rules('new_password_confirm', 'Confirm password', 'trim|required|min_length[3]|matches[new_password]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("customer/auth/changepassword_view", $data);
		} else {
			$password = password_hash($this->input->post("new_password"), PASSWORD_DEFAULT);
			$email = $this->session->userdata("reset_email");

			$this->db->set("password", $password);
			$this->db->where("email", $email);
			$this->db->update("customers");

			$this->session->unset_userdata("reset_email");
			$this->db->delete("customer_tokens", ["email" => $email]);

			$this->session->set_flashdata("message", "<div class='alert alert-success'>Success Change password! Login</div>");
			redirect("login");
		}
	}

	// validation method

	private function _loginValidation()
	{
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
	}

	private function _registerValidation()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[customers.email]', [
			'is_unique' => 'This email is already registered.'
		]);
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim|is_unique[customers.phone]', [
			'is_unique' => 'Phone is already registered'
		]);
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', [
			'min_length' => 'Password minimal 4 char'
		]);
		$this->form_validation->set_rules('password_confirm', 'Confirm password', 'required|trim|matches[password]', [
			'matches' => 'Confirm password does not match'
		]);
	}
}
