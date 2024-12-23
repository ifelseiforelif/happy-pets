<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php $this->load->view("admin/layouts/_head"); ?>

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
                    <div class="section-header d-flex justify-content-between">
                        <h1><?= $page_title; ?></h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Picture</th>
                                        <th>Name Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td>
                                                <img src="<?= base_url("assets/uploads/items/" . $item["images"]) ?>" width="50">
                                            </td>
                                            <td><?= $item["name"] ?></td>
                                            <td>UAH <?= number_format($item["price"]) ?></td>
                                            <td><?= $item["qty"] ?> Item</td>
                                            <td>UAH <?= number_format($item["total_price"]) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
</body>

</html>
