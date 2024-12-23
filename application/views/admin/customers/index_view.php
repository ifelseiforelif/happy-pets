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
						<a href="<?= base_url("manage-customer/add") ?>" class="btn btn-primary btn-lg">add Customer</a>
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
													<th>#</th>
													<th>Avatar</th>
													<th>Name</th>
													<th>Phone</th>
													<th>E-mail</th>
													<th>Status User Profile</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($customers as $customer) : ?>
													<tr>
														<td><?= $i++ ?></td>
														<td>
															<img src="<?= base_url("assets/uploads/avatars/" . $customer["avatar"]) ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; object-position: center;">
														</td>
														<td><?= $customer["name"] ?></td>
														<td><?= $customer["phone"] ?></td>
														<td><?= $customer["email"] ?></td>
														<td>
															<?php if ($customer["is_active"] == 1) : ?>
																<span class="badge badge-success">Aktif</span>
															<?php else : ?>
																<span class="badge badge-danger">Nonaktif</span>
															<?php endif; ?>
														</td>
														<th>
															<a href="<?= base_url("manage-customer/detail/" . $customer["customer_id"]) ?>" class="btn btn-icon btn-info">
																<i class="fas fa-eye"></i>
															</a>
															<a href="<?= base_url("manage-customer/ubah/" . $customer["customer_id"]) ?>" class="btn btn-icon btn-warning">
																<i class="far fa-edit"></i>
															</a>
															<a href="<?= base_url("manage-customer/delete/" . $customer["customer_id"]) ?>" class="btn btn-icon btn-danger button-delete">
																<i class="fas fa-trash"></i>
															</a>
														</th>
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
				text: 'Data Customer Success ' + flashData,
				icon: 'success'
			});
		}

		// tombol delete
		$('.button-delete').on('click', function(e) {

			e.preventDefault();
			const href = $(this).attr('href');

			swal({
				title: "Anda yakin?",
				text: "Data Customer akan didelete!",
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
