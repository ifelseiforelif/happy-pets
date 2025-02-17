<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin/Product_model', 'Product_model');
		if ($this->session->userdata("logged_in") !== "admin") {
			redirect("/");
		}
	}

	public function index()
	{
		$data["page_title"] = "Manage product";
		$data["products"] = $this->Product_model->getAllProduct();

		$this->load->view("admin/products/index_view", $data);
	}

	public function create()
	{
		$data["categories"] = $this->Product_model->getProductCategory();
		$data["page_title"] = "add product Baru";

		$this->_validationCreate();
		if ($this->form_validation->run() == FALSE) {

			$this->load->view("admin/products/create_view", $data);
		} else {
			$name = htmlspecialchars($this->input->post("name", true));
			$description = htmlspecialchars($this->input->post("description", true));
			$stock = htmlspecialchars($this->input->post("stock", true));
			$price = htmlspecialchars($this->input->post("price", true));
			$categoryId = $this->input->post("category_id");
			$dateCreated = time();
			// buat slug product
			//Buat slug
			$string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $name); //filter karakter unik dan replace dengan kosong ('')
			$trim = trim($string); // hilangkan spasi berlebihan dengan fungsi trim
			$pre_slug = strtolower(str_replace(" ", "-", $trim)); // hilangkan spasi, kemudian ganti spasi dengan tanda strip (-)
			$slug = $pre_slug; // addkan ektensi .html pada slug
			// upload image product
			$images = $_FILES["images"];
			if ($images) {
				$config["allowed_types"] = "jpg|jpeg|png|bmp|gif";
				// $config["max_size"] = 1024; //1 MB
				$config["upload_path"] = "./assets/uploads/items/";
				$config['file_name'] = round(microtime(true) * 1000);
				$this->load->library("upload", $config);
				if ($this->upload->do_upload("images")) {
					$images = $this->upload->data("file_name");
				} else {
					// echo $this->display_error();
					echo "Upload gagal";
				}
			}
			$productData = [
				"name" => $name,
				"slug" => $slug,
				"images" => $images,
				"description" => $description,
				"stock" => $stock,
				"price" => $price,
				"category_id" => $categoryId
			];
			$this->Product_model->addNewProduct($productData);
			$this->session->set_flashdata('message', 'Diadd');
			redirect("manage-product");
		}
	}

	public function edit($id)
	{
		$data["page_title"] = "Edit Data product";
		$data["product"] = $this->db->get_where("items", ["item_id" => $id])->row_array();
		$data["categories"] = $this->Product_model->getProductCategory();

		$this->_validationUpdate();
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/products/edit_view", $data);
		} else {
			// validasi Success
			$name = htmlspecialchars($this->input->post("name", true));
			$description = htmlspecialchars($this->input->post("description", true));
			$stock = htmlspecialchars($this->input->post("stock", true));
			$price = htmlspecialchars($this->input->post("price", true));
			$categoryId = $this->input->post("category_id", true);
			// buat slug product
			//Buat slug
			$string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $name); //filter karakter unik dan replace dengan kosong ('')
			$trim = trim($string); // hilangkan spasi berlebihan dengan fungsi trim
			$pre_slug = strtolower(str_replace(" ", "-", $trim)); // hilangkan spasi, kemudian ganti spasi dengan tanda strip (-)
			$slug = $pre_slug; // addkan ektensi .html pada slug
			// upload images product
			$images = $_FILES["images"];
			if ($images) {
				$config["allowed_types"] = "jpg|jpeg|png|bmp|gif";
				$config["max_size"] = 1024; //1 MB
				$config["file_name"] = $id;
				$config["upload_path"] = "./assets/uploads/items/";
				$config['file_name'] = round(microtime(true) * 1000);
				$this->load->library("upload", $config);
				if ($this->upload->do_upload("images")) {
					$product = $this->Product_model->getProductById($id);
					$oldImages = $product["images"];
					if ($oldImages) {
						unlink('./assets/uploads/items/' . $oldImages);
					}
					$newImages = $this->upload->data("file_name");
					$images = $newImages;
				} else {
					$product = $this->Product_model->getProductById($id);
					$images = $product["images"];
				}
			}
			$productData = [
				"name" => $name,
				"slug" => $slug,
				"images" => $images,
				"description" => $description,
				"stock" => $stock,
				"price" => $price,
				"category_id" => $categoryId,
			];
			$this->Product_model->updateProduct($productData, $id);
			$this->session->set_flashdata('message', 'Diubah');
			redirect("manage-product");
		}
	}

	public function delete($id)
	{
		$product = $this->Product_model->getProductById($id);
		if (file_exists('./assets/uploads/items/' . $product["images"]) && $product["images"]) {
			unlink('./assets/uploads/items/' . $product["images"]);
		}
		$this->Product_model->deleteProduct($id);
		$this->session->set_flashdata('message', 'Didelete');
		redirect("manage-product");
	}

	public function detail($id)
	{
		$data["page_title"] = "Detail product";
		$data["product"] = $this->Product_model->getProductById($id);

		$this->load->view("admin/products/detail_view", $data);
	}

	private function _validationCreate()
	{
		$this->form_validation->set_rules("name", "Name product", "required|trim");
		$this->form_validation->set_rules("stock", "Stock product", "required|trim");
		$this->form_validation->set_rules("price", "Price product", "required|trim");
		$this->form_validation->set_rules("category_id", "category", "required");
	}

	private function _validationUpdate()
	{
		$this->form_validation->set_rules("name", "Name product", "required|trim");
		$this->form_validation->set_rules("description", "Deskripsi product", "required|trim");
		$this->form_validation->set_rules("stock", "Stok product", "required|trim");
		$this->form_validation->set_rules("price", "Price product", "required|trim");
		$this->form_validation->set_rules("category_id", "category", "required");
	}
}
