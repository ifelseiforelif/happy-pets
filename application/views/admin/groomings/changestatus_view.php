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
						<div class="col-8">
							<div class="card">
								<div class="card-body">
									<form action="<?= base_url("admin/grooming/changestatus/" . $grooming["grooming_id"]) ?>" method="post">
										<div class="form-group">
											<label for="grooming_status">Status Grooming</label>
											<select name="grooming_status" id="grooming_status" class="form-control">
												<?php if ($grooming["grooming_status"] == "Registered") : ?>
													<option value="Registered" selected>Registered</option>
													<option value="Accepted">Accepted</option>
													<option value="Performed">Performed</option>
													<option value="Completed">Completed</option>
												<?php elseif ($grooming["grooming_status"] == "Accepted") : ?>
													<option value="Registered" disabled>Registered</option>
													<option value="Accepted" selected>Accepted</option>
													<option value="Performed">Performed</option>
													<option value="Completed">Completed</option>
												<?php elseif ($grooming["grooming_status"] == "Performed") : ?>
													<option value="Registered" disabled>Registered</option>
													<option value="Accepted" disabled>Accepted</option>
													<option value="Performed" selected>Performed</option>
													<option value="Completed">Completed</option>
												<?php else : ?>
													<option value="Registered" disabled>Registered</option>
													<option value="Accepted" disabled>Accepted</option>
													<option value="Performed" disabled>Performed</option>
													<option value="Completed" selected>Completed</option>
												<?php endif; ?>
											</select>
										</div>
										<div class="form-action">
											<button type="submit" class="btn btn-primary">Ubah Status</button>
											<a href="<?= base_url("manage-grooming") ?>" class="btn btn-warning">Back</a>
										</div>
									</form>
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
