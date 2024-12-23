<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php $this->load->view("admin/layouts/_head"); ?>
<link rel="stylesheet" href="<?= base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" /> <!-- Load file css jquery-ui -->
<script src="<?= base_url('assets/jquery.min.js'); ?>"></script> <!-- Load file jquery -->

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <!-- topbar -->
            <?php $this->load->view("admin/layouts/_topbar"); ?>

            <!-- sidebar -->
            <?php $this->load->view("admin/layouts/_sidebar"); ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>report</h1>
                    </div>
                    <!-- alert flashdata -->
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <!-- end alert flashdata -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 mx-auto">
                                    <form action="<?= base_url("report/filter") ?>" method="GET">
                                        <div class="form-group">
                                            <label for="reports">Typereport</label>
                                            <select name="reports" id="reports" class="form-control">
                                                <option value="" disabled selected>Choose Typereport</option>
                                                <option value="1">Sales</option>
                                                <option value="2">Grooming</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="filter">Filter Berdasarkan</label>
                                            <select name="filter" id="filter" class="form-control">
                                                <option value="" disabled selected>Filter report</option>
                                                <option value="1">Bulan</option>
                                                <option value="2">Tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="form-month">
                                            <label for="month">Bulan</label>
                                            <select name="month" id="month" class="form-control">
                                                <option value="" disabled selected>Choose Bulan</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="" id="form-year">
                                            <label for="years">Tahun</label>
                                            <select name="years" id="years" class="form-control">
                                                <option value="" disabled selected>Choose Tahun</option>
                                                <?php foreach ($option_year as $year) : ?>
                                                    <option value="<?= $year["year"]; ?>"><?= $year["year"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-action">
                                            <button type="submit" class="btn btn-primary btn-block">Buat report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- footer -->
            <?php $this->load->view("admin/layouts/_footer"); ?>
        </div>
    </div>

    <!-- scripts -->
    <?php $this->load->view("admin/layouts/_scripts"); ?>
    <script src="<?= base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            swal({
                title: 'Gagal',
                text: flashData,
                icon: 'error'
            });
        }

        $(document).ready(function() { // Ketika halaman Completed di load

            $('#form-month, #form-year').hide(); // Sebagai default kita sembunyikan form filter tanggal, month & yearnya
            $('#filter').change(function() { // Ketika user memilih filter
                if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                    $('#form-month').show(); // Tampilkan form tanggal
                    $('#form-year').show(); // Sembunyikan form month dan year
                } else { // Jika filternya 3 (per year)
                    $('#form-month').hide(); // Sembunyikan form tanggal dan month
                    $('#form-year').show(); // Tampilkan form year
                }

                $('#form-tanggal input, #form-month select, #form-year select').val(''); // Clear data pada textbox tanggal, combobox month & year
            })
        })
    </script>
</body>

</html>
