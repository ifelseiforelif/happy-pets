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
						<h1 class="h3 mb-0 text-gray-800">Order</h1>
					</div>
					<!-- alert flashdata -->
					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
					<!-- end alert flashdata -->
					<div class="card" style="border-radius: 20px; background-color: #EDEADE;">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>#</th>
											<th>Date of order</th>
											<th>Recipient\'s Name</th>
											<th>Address</th>
											<th>Total</th>
											<th>Status</th>
											<th>Info</th>
											<th>Payment Receipt</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($orders as $order) : ?>
											<tr>
												<td><?= $i++; ?></td>
												<td><?= date('d F Y', strtotime($order["order_date"])) ?></td>
												<td><?= $order["receipent_name"] ?></td>
												<td><?= $order["receipent_address"] ?></td>
												<td>UAH <?= number_format($order["total_payment"]) ?></td>
												<td>
													<?php if ($order["order_status"] == "New") : ?>
														<span class="badge badge-info"><?= $order["order_status"] ?></span>
													<?php elseif ($order["order_status"] == "Processed") : ?>
														<span class="badge badge-warning"><?= $order["order_status"] ?></span>
													<?php elseif ($order["order_status"] == "Delivered") : ?>
														<span class="badge badge-primary"><?= $order["order_status"] ?></span>
													<?php else : ?>
														<span class="badge badge-success"><?= $order["order_status"] ?></span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($order["info"] == "Paid") : ?>
														<span class="badge badge-success"><?= $order["info"] ?></span>
													<?php else : ?>
														<span class="badge badge-warning"><?= $order["info"] ?></span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($order["info"] == "Paid") : ?>
														<img src="<?= base_url("assets/uploads/payments/" . $order["payment_slip"]) ?>" width="200">
													<?php else : ?>
														-
													<?php endif; ?>
												</td>
												<td>
													<a href="<?= base_url("order-profile/detail/" . $order["order_id"]) ?>" class="btn btn-info btn-sm shadow rounded-0">Detail</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
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
	<script>
		<?php if ($this->session->flashdata('message')): ?>
		const flashData = $('.flash-data').data('flashdata');
		if (flashData) {
			Swal.fire({
				title: 'Success',
				text: 'Grooming Success ' + flashData,
				icon: 'success'
			});
			$.ajax({
				url: '<?= base_url('session/clear_flashdata') ?>',
				method:'GET'
			});
		}
	<?php endif; ?>

		$('.button-delete').on('click', function(e) {

			e.preventDefault();
			const href = $(this).attr('href');
			<?php if ($this->session->flashdata('message')): ?>
			Swal.fire({
				title: 'Are you sure?',
				text: "Data grooming your akan didelete!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok, delete'
			}).then((result) => {
				if (result.isConfirmed) {
					document.location.href = href;
				}
			})
	<?php endif; ?>
		})
	</script>

</body>

</html>
