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
						<a href="<?= base_url("manage-admin/add") ?>" class="btn btn-primary btn-lg">add Grooming</a>
					</div>
					<!-- alert flashdata -->
					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
					<!-- end alert flashdata -->
					<div class="row">
						<div class="col-12">
							<div class="card">
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
