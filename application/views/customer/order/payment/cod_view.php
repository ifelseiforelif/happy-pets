<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("customer/layouts/_head"); ?>

<body>

	<!-- Navigation -->
	<?php $this->load->view("customer/layouts/_navbar"); ?>
	<!-- Page Content -->
	<div class="container py-5">
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
		<div class="row pt-5">
			<div class="col text-center">
				<h2 class="font-weight-bold">Complete Order Details</h2>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-sm-8 mx-auto">
				<form action="<?= base_url("customer/order/cod") ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="customer_id" value="<?= $this->session->userdata("customer_id"); ?>">
					<input type="hidden" name="total_payment" value="<?= $this->cart->total(); ?>">
					<div class="card shadow border-0 text-decoration-none text-muted" style="background-color: #F5F5DC; border-radius: 20px; margin-top: 20px;">
						<div class="card-body">
							<div class="text-center">
								<h4 class="font-weight-bold">Shipping Details</h4>
							</div>
							<div class="form-group">
								<label for="receipent_name">Recipient\'s Name</label>
								<input type="text" class="form-control <?= form_error('receipent_name') ? 'is-invalid' : ''; ?>" name="receipent_name" id="receipent_name" placeholder="Recipient\'s Name" value="<?= $this->session->userdata("name"); ?>">
								<?= form_error('receipent_name', '<div class="invalid-feedback font-weight-bold pl-1">', '</div>') ?>
							</div>
							<div class="form-group">
								<label for="receipent_phone">Phone</label>
								<input type="number" class="form-control <?= form_error('receipent_phone') ? 'is-invalid' : ''; ?>" name="receipent_phone" id="receipent_phone" placeholder="Phone" value="<?= $this->session->userdata("phone"); ?>">
								<?= form_error('receipent_phone', '<div class="invalid-feedback font-weight-bold pl-1">', '</div>') ?>
							</div>
							<div class="form-group">
								<label for="receipent_address">Address</label>
								<textarea name="receipent_address" id="receipent_address" rows="4" class="form-control <?= form_error('receipent_address') ? 'is-invalid' : ''; ?>"><?= $this->session->userdata("address"); ?></textarea>
								<?= form_error('receipent_address', '<div class="invalid-feedback font-weight-bold pl-1">', '</div>') ?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">OK</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div> <!-- /.container -->


	<!-- Footer -->
	<!-- <?php $this->load->view("customer/layouts/_footer"); ?> -->

	<?php $this->load->view("customer/layouts/_scripts"); ?>

</body>

</html>
