<?php
class Order extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin/Order_model', 'Order_model');
		if ($this->session->userdata("logged_in") !== "admin") {
			redirect("/");
		}
	}

	public function index()
	{
		$data["page_title"] = "Manage Orderan";
		$data["orders"] = $this->Order_model->getAllOrders();

		$this->load->view("admin/orders/index_view", $data);
	}

	public function changeStatus($id)
	{
		$data["page_title"] = "Ubah Status Transactions";
		$data["order"] = $this->Order_model->getOrderById($id);

		$this->form_validation->set_rules("order_status", "Status Orderan", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/orders/changestatus_view", $data);
		} else {
			$orderStatus = $this->input->post("order_status");
			$this->Order_model->updateOrderStatus($id, $orderStatus);
			$this->session->set_flashdata("message", "Diubah");
			redirect("manage-order");
		}
	}

	public function deleteOrder($id)
	{
		$this->Order_model->deleteOrder($id);
		$this->session->set_flashdata('message', 'Delete');
		redirect("manage-order");
	}

	public function detailOrder($id)
	{
		$data["page_title"] = "Detail Order";
		$data["items"] = $this->Order_model->showDetailOrder($id);

		$this->load->view("admin/orders/invoice_view", $data);
	}
}
