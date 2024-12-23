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
					<!-- alert flashdata -->
					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
					<!-- end alert flashdata -->
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped" id="table-1">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Name Customer</th>
													<th>Pet type</th>
													<th>Package</th>
													<th>Cost</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($groomings as $grooming) : ?>
													<tr>
														<td><?= $i++ ?></td>
														<td><?= date('d F Y', strtotime($grooming["date_created"])) ?></td>
														<td><?= $grooming["customer_name"] ?></td>
														<td><?= $grooming["pet_type"] ?></td>
														<td><?= $grooming["name"] ?></td>
														<td> UAH
															<?php if ($grooming["pet_type"] == "Cat") : ?>
																<?= $grooming["cost_for_cat"] ?>
															<?php else : ?>
																<?= $grooming["cost_for_dog"] ?>
															<?php endif; ?>
														</td>
														<td>
															<a href="<?= base_url("admin/grooming/changestatus/" . $grooming["grooming_id"]) ?>">
																<?php if ($grooming["grooming_status"] == "Registered") : ?>
																	<span class="badge badge-secondary"><?= $grooming["grooming_status"] ?></span>
																<?php elseif ($grooming["grooming_status"] == "Accepted") : ?>
																	<span class="badge badge-info"><?= $grooming["grooming_status"] ?></span>
																<?php elseif ($grooming["grooming_status"] == "Performed") : ?>
																	<span class="badge badge-warning"><?= $grooming["grooming_status"] ?></span>
																<?php else : ?>
																	<span class="badge badge-success"><?= $grooming["grooming_status"] ?></span>
																<?php endif; ?>
															</a>
														</td>
														<td>
															<a href="<?= base_url("manage-grooming/detail/" . $grooming["grooming_id"]) ?>" class="btn btn-icon btn-info">
																<i class="far fa-eye"></i>
															</a>
															<a href="<?= base_url("manage-grooming/delete/" . $grooming["grooming_id"]) ?>" class="btn btn-icon btn-danger button-delete">
																<i class="fas fa-trash"></i>
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
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
	<!-- specified scripts -->
	<script>
		const flashData = $('.flash-data').data('flashdata');
		if (flashData) {
			swal({
				title: 'Success',
				text: 'Status Grooming Success ' + flashData,
				icon: 'success'
			});
		}

		// tombol delete
		$('.button-delete').on('click', function(e) {

			e.preventDefault();
			const href = $(this).attr('href');

			swal({
				title: "Anda yakin?",
				text: "Data Admin akan didelete!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((result) => {
				if (result) {
					document.location.href = href;
				}
			})

		})
	</script>
</body>

</html>
