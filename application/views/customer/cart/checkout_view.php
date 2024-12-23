<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("customer/layouts/_head"); ?>

<body>
	<!-- Page Content -->
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
	<div class="container mt-5">
		<div class="text-center">
			<img src="<?= base_url("assets/customer/img/checkout.png") ?>" width="250" class="mb-3">		
			<h3 class="font-weight-bold">Checkout Success</h3>
			<p class="text-muted">We will send your order to the address in your user profile<br> Prepare for cash on delivery.</p>
			<div class="row">
				<div class="col-3 mx-auto">
					<a href="<?= base_url("product") ?>" class="btn btn-success text-white rounded-0 btn-block">Continue Shopping</a>
					<a href="<?= basename("order-profile") ?>" class="btn btn-light rounded-0 btn-block">Order profile</a>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view("customer/layouts/_scripts"); ?>

</body>

</html>
