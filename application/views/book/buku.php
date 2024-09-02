<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Daftar Data Buku</h3>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<?= create_breadcrumb(); ?>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<?php if ($this->session->userdata('role')  == 'Administrator') : ?>
					<a class="btn btn-success" href="<?= site_url('buku/tambah') ?>"><strong>+Tambah Buku</strong></a>
				<?php endif; ?>
				<a class="btn btn-info" target="_blank" href="<?= site_url('buku/buku_pdf') ?>">Print List Buku</a>
				<!-- Sort Category by A.I -->
				<form action="<?= site_url('buku'); ?>" method="get" class="d-flex">
					<select name="kategori" class="form-select me-2">
						<option value="">All Categories</option>
						<?php foreach ($kategori as $kat): ?>
							<option value="<?= $kat['id_kategori']; ?>"
								<?= isset($_GET['kategori']) && $_GET['kategori'] == $kat['id_kategori'] ? 'selected' : '' ?>>
								<?= $kat['kategori']; ?>
							</option>
						<?php endforeach; ?>
					</select>
					<button class="btn btn-primary" type="submit">Sort</button>
				</form>
			</div>
			<div class="card-body">
				<table class="table table-striped" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul</th>
							<th>Cover</th>
							<th>Kategori</th>
							<th>Penerbit</th>
							<th>Pengarang</th>
							<th>Tahun Terbit</th>
							<th>Stok</th>
							<th>Status Pinjam</th>
							<?php if ($this->session->userdata('role')  == 'Administrator') : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1;
						foreach ($buku as $sr) : ?>
							<tr>
								<td><?= $n ?></td>
								<td><?= $sr['judul']; ?></td>
								<td><button class="btn" data-bs-toggle="modal" data-bs-target="#small<?= $sr['id_buku'] ?>">
										<i class="bi bi-journal-richtext"></i>
									</button></td>
								<td><?= $sr['kategori']; ?></td>
								<td><?= $sr['penerbit']; ?></td>
								<td><?= $sr['pengarang']; ?></td>
								<td><?= date('d F Y', strtotime($sr['thn_terbit'])) ?></td>
								<td><?= $sr['stok']; ?></td>
								<td><?= $sr['pinjam'] > 0 ? $sr['pinjam'] . ' (Dipinjam)' : 'Tersedia' ?></td>
								<?php if ($this->session->userdata('role')  == 'Administrator') : ?>
									<td>
										<a href="<?= site_url('buku/delete/') . $sr['id_buku'] ?>"
											class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
										<a href="<?= site_url('buku/edit/') . $sr['id_buku'] ?>"
											class="btn btn-sm btn-outline-warning"><i class="bi bi-pen"></i></a>
									</td>
								<?php endif; ?>
							</tr>
						<?php $n++;
						endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>



<!-- Button trigger for small size modal modal -->
<?php foreach ($buku as $mboh) : ?>
	<!--small size modal -->
	<div class="modal fade text-left" id="small<?= $mboh['id_buku'] ?>" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel19" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel19">Detail Cover Buku <?= $mboh['judul'] ?></h4>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<div class="modal-body">
					<img src="<?= base_url('sh/buku/cover/' . $mboh['cover'])
								?>" alt="Cover Buku" class="img-responsive"
						style="max-width: 100%; max-height: 100%; display: block; margin: 0 auto; border-radius:5px;">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary ml-1 btn-sm" data-bs-dismiss="modal">
						<i class="bx bx-check d-block d-sm-none"></i>
						<span class="d-sm-block d-none">Close</span>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
