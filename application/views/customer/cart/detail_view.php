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
						<h1 class="h3 mb-0 text-gray-800">Detail</h1>
					</div>
					<!-- alert flashdata -->
					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
					<!-- end alert flashdata -->
					<div class="card" style="border-radius: 20px; background-color: #EDEADE;">
						<div class="card-body">
							<table class="table table-borderless table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>Picture</th>
										<th>Name</th>
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
	<?php if ($this->session->flashdata('message')): ?>
	<script>
		const flashData = $('.flash-data').data('flashdata');
		if (flashData) {
			Swal.fire({
				title: 'Success',
				text: 'Grooming Success ' + flashData,
				icon: 'success'
			});
		}
</script>
	<?php endif; ?>
	<script>

		$('.button-delete').on('click', function(e) {

			e.preventDefault();
			const href = $(this).attr('href');
			<?php if ($this->session->flashdata('message')): ?>
			Swal.fire({
				title: 'Are you sure?',
				text: "Data grooming your deleted!",
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
