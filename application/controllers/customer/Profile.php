<?php
class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('customer/Profile_model', 'Profile_model');
		if ($this->session->userdata("logged_in") !== "customer") {
			redirect("login");
		}
	}

	public function index()
	{
		$data["page_title"] = "My Profile";

		$this->load->view("customer/profiles/index_view", $data);
	}

	public function editProfile()
	{

		$this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email");
		$this->form_validation->set_rules("name", "Name", "required|trim");
		$this->form_validation->set_rules("phone", "Phone", "required|trim");
		$this->form_validation->set_rules("address", "Address", "required|trim");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$name = htmlspecialchars($this->input->post("name", true));
			$phone = htmlspecialchars($this->input->post("phone", true));
			$address = htmlspecialchars($this->input->post("address", true));
			$email = htmlspecialchars($this->input->post("email", true));
			$profileData = [
				"name" => $name,
				"phone" => $phone,
				"address" => $address,
				"email" => $email
			];
			$this->session->set_userdata($profileData);
			// cek jika ada gambar yang diupload
			$uploadImage = $_FILES["avatar"];

			if ($uploadImage) {
				$config["allowed_types"] = "gif|jpg|png|bmp|jpeg";
				$config["max_size"] = "1024";
				$config["upload_path"] = "./assets/uploads/avatars/";
				$config['file_name'] = round(microtime(true) * 1000);
				$this->load->library("upload", $config);
				if ($this->upload->do_upload("avatar")) {
					$userSession = $this->db->get_where("customers", ["email" => $this->session->userdata("email")])->row_array();
					$oldAvatar = $userSession["avatar"];
					if ($oldAvatar != "default.jpg") {
						unlink('./assets/uploads/avatars/' . $oldAvatar);
					}
					$newAvatar = $this->upload->data("file_name");
					$this->db->set("avatar", $newAvatar);
					$this->session->set_userdata("avatar", $newAvatar);
				} else {
					echo $this->upload->display_errors();
				}
			}


			$this->Profile_model->updateProfile($profileData);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Your profile has been successfully updated</div>');
			redirect("customer/profile");
		}
	}

	public function changePassword()
	{

		$this->form_validation->set_rules("current_password", "Password current", "required|trim");
		$this->form_validation->set_rules("new_password", "New password", "required|trim|min_length[4]", [
			"min_length" => "Password minimal 4 Karakter"
		]);
		$this->form_validation->set_rules("password_confirm", "Confirm password", "required|trim|matches[new_password]", [
			"matches" => "Confirm password salah"
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data["user_session"] = $this->db->get_where("customers", ["email" => $this->session->userdata("email")])->row_array();
			$currentPassword = $this->input->post("current_password");
			$newPassword = $this->input->post("new_password");
			if (password_verify($currentPassword, $data["users_session"]["password"])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Your password is incorrect</div>');
				redirect("customer/profile");
			} else {
				if ($currentPassword == $newPassword) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">New password cannot be the same as before</div>');
					redirect("customer/profile");
				} else {
					// password sudah bisa Accepted
					$passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

					$this->Profile_model->updatePassword($passwordHash);

					$this->session->set_flashdata('message', '<div class="alert alert-success">Success. New password</div>');
					redirect("customer/profile");
				}
			}
		}
	}
}
