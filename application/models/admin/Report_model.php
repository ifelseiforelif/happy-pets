<?php
class Report_model extends CI_Model
{

    public function getYearsData()
    {
        $this->db->select('YEAR(date_order) AS year');
        $this->db->from('order_details');
        $this->db->order_by('YEAR(date_order)');
        $this->db->group_by('YEAR(date_order)');

        return $this->db->get()->result_array();
    }

    public function viewSalesByMonth($month, $year)
    {
        $this->db->select("*");
        $this->db->from("order_details");
        $this->db->join("items", "items.item_id = order_details.item_id");
		$this->db->join("orders", "orders.order_id = order_details.order_id");
        $this->db->where("MONTH(date_order)", $month);
        $this->db->where("YEAR(date_order)", $year);
        return $this->db->get()->result_array();
    }

    public function viewSalesByYear($year)
    {
        $this->db->select("*");
        $this->db->from("order_details");
        $this->db->join("items", "items.item_id = order_details.item_id");
		$this->db->join("orders", "orders.order_id = order_details.order_id");
        $this->db->where("YEAR(date_order)", $year);
        return $this->db->get()->result_array();
    }

    public function viewGroomingByMonth($month, $year)
    {
        $this->db->select("*");
        $this->db->from("groomings");
        $this->db->join("packages", "packages.package_id = groomings.package_id");
        $this->db->where("MONTH(date_created)", $month);
        $this->db->where("YEAR(date_created)", $year);
        return $this->db->get()->result_array();
    }

    public function viewGroomingByYear($year)
    {
        $this->db->select("*");
        $this->db->from("groomings");
        $this->db->join("packages", "packages.package_id = groomings.package_id");
        $this->db->where("YEAR(date_created)", $year);
        return $this->db->get()->result_array();
    }
}
