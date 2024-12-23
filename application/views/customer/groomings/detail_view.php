<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("customer/layouts/_home/_head"); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("customer/layouts/_home/_sidebar"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view("customer/layouts/_home/_topbar"); ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Grooming</h1>
                    </div>
                    <!-- alert flashdata -->
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <!-- end alert flashdata -->
                    <div class="card" style="border-radius: 20px; background-color: #EDEADE;">
                        <div class="card-body">
                            <b>Name Customer</b>
                            <p><?= $grooming["customer_name"]; ?></p>
                            <b>Phone Customer</b>
                            <p><?= $grooming["customer_phone"]; ?></p>
                            <b>Address Customer</b>
                            <p><?= $grooming["customer_address"]; ?></p>
                            <b>Pet type</b>
                            <p><?= $grooming["pet_type"]; ?></p>
                            <b>Tarif Grooming</b>
                            <p>
                                <?php if ($grooming["pet_type"] == "Cat") : ?>
                                    UAH <?= number_format($grooming["cost_for_cat"]) ?>
                                <?php else : ?>
                                    UAH <?= number_format($grooming["cost_for_dog"]) ?>
                                <?php endif; ?>
                            </p>
                            <b>Status Grooming</b>
                            <p>
                                <?php if ($grooming["grooming_status"] == "Registered") : ?>
                                    <span class="badge badge-secondary"><?= $grooming["grooming_status"] ?></span>
                                <?php elseif ($grooming["grooming_status"] == "Accepted") : ?>
                                    <span class="badge badge-info"><?= $grooming["grooming_status"] ?></span>
                                <?php elseif ($grooming["grooming_status"] == "Performed") : ?>
                                    <span class="badge badge-warning"><?= $grooming["grooming_status"] ?></span>
                                <?php else : ?>
                                    <span class="badge badge-success"><?= $grooming["grooming_status"] ?></span>
                                <?php endif; ?>
                            </p>
                            <b>TypePackage grooming</b>
                            <p><?= $grooming["name"]; ?></p>
                            <b>Comment Customer</b>
                            <p><?= $grooming["notes"] ?></p>
                            <b>New Date</b>
                            <p><?= date('d F Y', strtotime($grooming["date_created"])); ?></p>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("customer/layouts/_home/_footer"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?php $this->load->view("customer/layouts/_home/_scripts"); ?>

</body>

</html>
