<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("customer/layouts/_head"); ?>

<body>

	<!-- Navigation -->
	<?php $this->load->view("customer/layouts/_navbar"); ?>
	<!-- Page Content -->
	<div class="container py-5">
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
		<div class="section-title">
		<div class="row pt-5">
			<div class="col">
				<h3 class="font-weight-bold">Cart profile</h3>
			</div>
		</div>
		</div>
		<hr>
		<?php if ($this->cart->contents()) : ?>
			<div class="cart">
				<div class="row">
					<div class="col-sm-3">
						<div class="card shadow border-0" style="border-radius: 20px; background-color: #EDEADE;">
							<div class="card-body">
								<h5><b class="text-info">Total : </b> UAH <?= number_format($this->cart->total(), 0, ',', '.'); ?></h5>
								<a href="<?= base_url("clear-cart") ?>" class="btn btn-block btn-danger">Clear</a>
								<!-- <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-block btn-success">Order</a> -->
								<a href="<?= base_url("customer/cart/continueorder") ?>" class="btn btn-block btn-success">Order</a>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="card shadow border-0" style="border-radius: 20px; background-color: #EDEADE;">
							<div class="card-body">
								<table class="table table-borderless table-hover">
									<tr>
										<th>#</th>
										<th>Image</th>
										<th>Name Item</th>
										<th>Quantity</th>
										<th align="right">Price</th>
										<th align="right">Total</th>
									</tr>
									<?php $i = 1; ?>
									<?php foreach ($this->cart->contents() as $item) : ?>
										<tr>
											<td><?= $i++; ?></td>
											<td>
												<img src="<?= base_url("assets/uploads/items/" . $item["images"]) ?>" style="width: 120px; height: 64px; object-position:center; object-fit:cover; border-radius: 20px;">
											</td>
											<td><?= $item["name"]; ?></td>
											<td><?= $item["qty"]; ?></td>
											<td>UAH <?= number_format($item["price"], 0, ',', '.'); ?></td>
											<td>UAH <?= number_format($item["subtotal"], 0, ',', '.'); ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		<?php else : ?>
			<div class="card shadow border-0" style="border-radius: 20px; background-color: #EDEADE;">
				<div class="card-body">
					<div class="text-center mt-5">
						<img src="<?= base_url("assets/customer/img/shopping-basket.png") ?>" width="250">
						<h3 class="text-danger mt-3 font-weight-bold">No product yet</h3>
						<a href="<?= base_url("product") ?>" class="btn btn-success">Catalog product</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div> <!-- /.container -->

	<!-- Modal -->
	<div class="modal fade" id="exampleModal">
		<div class="modal-dialog">
			<form action="<?= base_url("process-order") ?>" method="post">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">New Data Order</h5>
					</div>
					<div class="modal-body">
						<input type="hidden" name="customer_id" value="<?= $this->session->userdata("customer_id"); ?>">
						<input type="hidden" name="total_payment" value="<?= $this->cart->total(); ?>">
						<div class="form-group">
							<label for="receipent_name">Recipient\'s Name</label>
							<input type="text" name="receipent_name" id="receipent_name" class="form-control" value="<?= $this->session->userdata("name"); ?>" required>
						</div>
						<div class="form-group">
							<label for="receipent_phone">№</label>
							<input type="number" name="receipent_phone" id="receipent_phone" class="form-control" value="<?= $this->session->userdata("phone"); ?>" required>
						</div>
						<div class="form-group">
							<label for="receipent_address">Address</label>
							<textarea name="receipent_address" id="receipent_address" rows="3" class="form-control" required><?= $this->session->userdata("address"); ?></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success rounded-0">Process Order</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Footer -->
	<?php $this->load->view("customer/layouts/_footer"); ?>

	<?php $this->load->view("customer/layouts/_scripts"); ?>

</body>

</html>
