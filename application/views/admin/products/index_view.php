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
						<a href="<?= base_url("manage-product/add") ?>" class="btn btn-primary btn-lg">add product</a>
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
													<th width="10">No.</th>
													<th width="200">Thumbnail</th>
													<th>Name product</th>
													<th>Stok</th>
													<th>Price Jual</th>
													<th>category</th>
													<th width="150">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												<?php foreach ($products as $product) : ?>
													<tr>
														<td><?= $i++ ?></td>
														<td>
															<img src="<?= base_url("assets/uploads/items/" . $product["images"]) ?>" style="width: 100%; height: 150px; object-fit: cover; object-position: center;">
														</td>
														<td><?= $product["name"] ?></td>
														<td>

															<?php if ($product["stock"] == 0) : ?>
																<span class="badge badge-danger">Stok Habis</span>
															<?php else : ?>
																<?= $product["stock"] ?> Qty
															<?php endif; ?>

														</td>
														<td>UAH <?= number_format($product["price"]) ?></td>
														<td><?= $product["category_name"] ?></td>
														<th>
															<a href="<?= base_url("manage-product/detail/" . $product["item_id"]) ?>" class="btn btn-icon btn-info">
																<i class="fas fa-eye"></i>
															</a>
															<a href="<?= base_url("manage-product/ubah/" . $product["item_id"]) ?>" class="btn btn-icon btn-warning">
																<i class="far fa-edit"></i>
															</a>
															<a href="<?= base_url("manage-product/delete/" . $product["item_id"]) ?>" class="btn btn-icon btn-danger btn-delete">
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
				text: 'product Success ' + flashData,
				icon: 'success'
			});
		}


		// tombol delete
		$('.btn-delete').on('click', function(e) {

			e.preventDefault();
			const href = $(this).attr('href');

			swal({
				title: "Anda yakin?",
				text: "product akan didelete!",
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
