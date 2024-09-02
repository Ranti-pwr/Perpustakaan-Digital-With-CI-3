<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Categories</h3>
				<!-- <p class="text-subtitle text-muted">For user to check they list</p> -->
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<!-- <ol class="breadcrumb">
            						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            						<li class="breadcrumb-item active" aria-current="page">DataTable</li>
            					</ol> -->
					<?= create_breadcrumb(); ?>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="row">
			<div class="col-md-5 col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Categories</h4>
					</div>
					<div class="card-content">
						<div class="card-body">
							<form class="form form-vertical" action="<?= site_url('kategori') ?>" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group has-icon-left">
												<label for="first-name-icon">Nama Kategori</label>
												<div class="position-relative">
													<input type="text" class="form-control"
														placeholder="Categories book.." onkeypress="validateTextInput(event)" id="first-name-icon"
														name="kategori">
													<div class="form-control-icon">
														<i class="bi bi-dash"></i>
													</div>
													<?= form_error('kategori', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
												</div>
											</div>
										</div>
										<div class="col-12 d-flex justify-content-end">
											<button type="submit" class="btn btn-success me-1 mb-1">Add</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-7 col-10">
				<div class="card">
					<div class="card-body">
						<table class="table table-striped" id="table1">
							<thead>
								<tr>
									<th>No</th>
									<th>Kategori</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $n = 1;
								foreach ($kategori as $sr) : ?>
									<tr>
										<td><?= $n ?></td>
										<td><?= $sr['kategori']; ?></td>
										<td>
											<a href="<?= site_url('kategori/delete/') . $sr['id_kategori'] ?>"
												class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
											<button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
												data-bs-target="#small<?= $sr['id_kategori'] ?>"><i
													class="bi bi-pen"></i></button>
										</td>
									</tr>
								<?php $n++;
								endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="me-1 mb-1 d-inline-block">
	<!-- Button trigger for small size modal modal -->
	<?php foreach ($kategori as $mboh) : ?>
		<!--small size modal -->
		<div class="modal fade text-left" id="small<?= $mboh['id_kategori'] ?>" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel19" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel19">Edit Kategori</h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<i data-feather="x"></i>
						</button>
					</div>
					<form action="<?= site_url('kategori/update'); ?>" method="post">
						<div class="modal-body">
							<div class="form-group has-icon-left">
								<input type="hidden" name="id_kategori" value="<?= $mboh['id_kategori']; ?>">
								<label for="first-name-icon mt-2">Nama Kategori</label>
								<div class="position-relative">
									<input type="text" class="form-control" placeholder="Categories book.."
										id="first-name-icon" onkeypress="validateTextInput(event)" name="kategori" value="<?= $mboh['kategori']; ?>" required>
									<div class="form-control-icon">
										<i class="bi bi-pen"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
								<i class="bx bx-x d-block d-sm-none"></i>
								<span class="d-sm-block d-none">Close</span>
							</button>
							<button type="submit" class="btn btn-primary ml-1 btn-sm">
								<i class="bx bx-check d-block d-sm-none"></i>
								<span class="d-sm-block d-none">Update</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
<?php endforeach; ?>
