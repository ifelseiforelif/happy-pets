<?php

class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/Product_model', 'Product_model');
		if ($this->session->userdata("logged_in") !== "customer") {
			redirect("login");
		}
	}

	public function index()
	{
		$data["page_title"] = "Cart profile";
		$this->load->view("customer/cart/index_view", $data);
	}

	public function addToCart($id)
	{
		$item = $this->Product_model->find($id);
		$qty = 1;


		if ($this->input->post("qty")) {
			$qty = $this->input->post("qty");
		}

		$data = array(
			"id" => $item->item_id,
			"qty" => $qty,
			"price" => $item->price,
			"name" => $item->name,
			"images" => $item->images,
		);
		$this->cart->insert($data);
		$this->session->set_flashdata('message', 'Added to Cart');

		redirect($_SERVER["HTTP_REFERER"]);

	}

	public function emptyCart()
	{
		$this->cart->destroy();
		redirect('detail-cart');
	}

	public function continueOrder()
	{
		$data["page_title"] = "Choose Payment Method";
		$this->load->view("customer/order/index_view", $data);
	}



	public function checkoutSuccess()
	{
		$data["page_title"] = "Checkout Success";

		$this->load->view("customer/cart/checkout_view", $data);
	}

	public function showMyOrder()
	{
		$data["page_title"] = "Order";
		$data["orders"] = $this->Product_model->getAllOrdersByUser();

		$this->load->view("customer/cart/order_view", $data);
	}

	public function showDetailOrder($id)
	{
		$data["page_title"] = "Detail Order";
		$data["items"] = $this->Product_model->getDetailOrderById($id);

		$this->load->view("customer/cart/detail_view", $data);
	}
}
