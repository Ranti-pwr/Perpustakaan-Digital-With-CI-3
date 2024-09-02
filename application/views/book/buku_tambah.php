<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Tambahkan Data Buku</h3>
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

	<section id="multiple-column-form">
		<div class="row match-height">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Multiple Column</h4>
					</div>
					<div class="card-content">
						<div class="card-body">
							<form class="form" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="first-name-column">Judul</label>
											<input type="text" id="first-name-column" class="form-control"
												placeholder="Title book..." name="judul">
											<?= form_error('judul', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="last-name-column">Penerbit</label>
											<input type="text" id="last-name-column" class="form-control mt-1"
												placeholder="penerbit" name="penerbit">
											<?= form_error('penerbit', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="city-column">pengarang</label>
											<input type="text" id="city-column" class="form-control mt-1"
												placeholder="City" name="pengarang">
											<?= form_error('pengarang', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="country-floating">Tahun terbit</label>
											<input type="date" id="country-floating" class="form-control mt-1"
												name="thn_terbit" placeholder="Country">
											<?= form_error('thn_terbit', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="company-column">Stock</label>
											<input type="number" id="company-column" class="form-control mt-1"
												name="stok" placeholder="stok">
											<?= form_error('stok', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>') ?>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="email-id-column">Kategori</label>
											<?php foreach ($kategori as $kat): ?>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="kategori[]"
														value="<?= $kat['id_kategori']; ?>">
													<label class="form-check-label"><?= $kat['kategori']; ?></label>
												</div>
											<?php endforeach; ?>
											<?= form_error('kategori[]', '<small class="form-text text-danger pl-3"><strong>', '</strong></small>'); ?>
											<!-- <div class="position-relative">
												<select class="form-select" id="inputGroupSelect01" name="id_kategori">
													<option selected>Choose...</option>
													<?php foreach ($kategori as $kat) : ?>
													<option value="<?= $kat['id_kategori']; ?>">
														<?= $kat['kategori']; ?></option>
													<?php endforeach; ?>
												</select>
											</div> -->
										</div>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="email-id-column">Cover / Sampul Buku (opsional)</label>
										<input type="file" id="email-id-column" class="form-control mt-1" name="cover"
											accept="image/*">
									</div>
								</div>
								<div class="col-12 d-flex justify-content-end mt-3">
									<button type="reset" class="btn btn-light-secondary me-3 mb-1">Kembali</button>
									<button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
								</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- // Basic multiple Column Form section end -->
