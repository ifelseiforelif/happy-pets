<?php
class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Report_model', 'Report_model');
    }

    public function index()
    {
        $data["page_title"] = "report";



        $data['option_year'] = $this->Report_model->getYearsData();
        $this->load->view("admin/reports/index_view", $data);
    }

    public function filterReports()
    {
        // cek apakah user sudah memilih Typereport
        if (isset($_GET["reports"]) && !empty($_GET["reports"])) {
            $reports = $_GET["reports"];
            // jika Typereport yang diChoose penjualan
            if ($reports == '1') {

                // cek apakah user sudah memfilter report
                if (isset($_GET["filter"]) && !empty($_GET["filter"])) {
                    $filter = $_GET["filter"];
                    // jika user memfilter dari month
                    if ($filter == "1") {
                        $this->_printTransaksiReportByMonth();
                    } else {
                        $this->_printTransaksiReportByYear();
                    }
                }
            } else {
                // cek apakah user sudah memfilter report
                if (isset($_GET["filter"]) && !empty($_GET["filter"])) {
                    $filter = $_GET["filter"];
                    // jika user memfilter dari month
                    if ($filter == "1") {
                        $this->_printGroomingReportsByMonth();
                    } else {
                        $this->_printGroomingReportsByYear();
                    }
                }
            }
        }
    }

    private function _printTransaksiReportByMonth()
    {
        $month = $_GET["month"];
        $year = $_GET["years"];
        $NameBulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $data["keterangan"] = "Data Sales Bulan " . $NameBulan[$month] . " " . $year;
        $data["url_cetak"] = 'report/cetak?filter=1&month=' . $month . '&year=' . $year;
        $data["transaksi"] = $this->Report_model->viewSalesByMonth($month, $year);
        if (!$data["transaksi"]) {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect("report");
        }
        // cetak report
        ob_start();
        $this->load->view("admin/reports/report_transaksi_view", $data);
        $html = ob_get_contents();
        ob_end_clean();

        require './assets/html2pdf/autoload.php';

        $pdf = new Spipu\Html2Pdf\Html2Pdf('L', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('report_TRANSAKSI_BULANAN.pdf', 'D');
    }

    private function _printTransaksiReportByYear()
    {
        $year = $_GET["years"];

        $data["keterangan"] = "Data Sales year " . $year;
        $data["url_cetak"] = "report/cetak?filter=2&year=" . $year;
        $data["transaksi"] = $this->Report_model->viewSalesByYear($year);
        if (!$data["transaksi"]) {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect("report");
        }
        // cetak report
        ob_start();
        $this->load->view("admin/reports/report_transaksi_view", $data);
        $html = ob_get_contents();
        ob_end_clean();

        require './assets/html2pdf/autoload.php';

        $pdf = new Spipu\Html2Pdf\Html2Pdf('L', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('report_TRANSAKSI_TAHUNAN.pdf', 'D');
    }

    private function _printGroomingReportsByMonth()
    {
        $month = $_GET["month"];
        $year = $_GET["years"];
        $NameBulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $data["keterangan"] = "Data Grooming Bulan " . $NameBulan[$month] . "" . $year;
        $data["url_cetak"] = 'report/cetak?filter=1&month=' . $month . '&year=' . $year;
        $data["grooming"] = $this->Report_model->viewGroomingByMonth($month, $year);
        if (!$data["grooming"]) {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect("report");
        }
        // cetak report
        ob_start();
        $this->load->view("admin/reports/report_grooming_view", $data);
        $html = ob_get_contents();
        ob_end_clean();

        require './assets/html2pdf/autoload.php';

        $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('report_GROOMING_BULANAN.pdf', 'D');
    }

    private function _printGroomingReportsByYear()
    {
        $year = $_GET["years"];

        $data["keterangan"] = "Data Grooming year" . $year;
        $data["url_cetak"] = "report/cetak?filter=2&year=" . $year;
        $data["grooming"] = $this->Report_model->viewGroomingByYear($year);
        if (!$data["grooming"]) {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect("report");
        }
        // cetak report
        ob_start();
        $this->load->view("admin/reports/report_grooming_view", $data);
        $html = ob_get_contents();
        ob_end_clean();

        require './assets/html2pdf/autoload.php';

        $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('report_GROOMING_TAHUNAN.pdf', 'D');
    }
}
