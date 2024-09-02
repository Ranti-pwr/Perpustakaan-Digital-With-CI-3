<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Daftar Data Buku</h3>
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
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<!-- <button class="btn btn-success" data-bs-toggle="modal"
            					data-bs-target="#inlineForm"><strong>+Tambah Pinjam</strong></button> -->
				<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#large">
					<strong>+Tambah
						Pinjam</strong>
				</button>

				<div class="col-md-5">
					<form action="<?= base_url() ?>transaksi/scbroww" method="post" class="row ms-2">
						<div class="col-md-5">
							<select class="form-control" id="bulan" name="bulan">
								<?php
                                        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        if ($this->session->userdata('bulan1')) { 
											//jika session bulan ada maka tampilkan, jika tidak tampilkan bulan saat ini
                                            $bln = $this->session->userdata('bulan1') - 1; //kurang 1 index karena dimulai dari 0
                                            $temp = $this->session->userdata('bulan1');
                                        } else {
                                            $bln = date('n') - 1; //kurang 1 karena index array dimulai dari 0
                                            $temp = date('n'); //nilai numerik dari array
                                        }
										// var_dump($temp); die;
                                        echo "<option value = $temp> $bulan[$bln] </option>";// $bulan[$bln] nilai string dari array

                                        $nilai = count($bulan); //perhitungan jumlah bulan 
                                        for ($i = 0; $i < $nilai; $i += 1) {
                                            $j = $i + 1;
                                            if ($bulan[$i] != $bulan[$bln]) {
                                                echo "<option value= $j> $bulan[$i] </option>";
                                            }
                                        }

										
                                        ?>
							</select>
						</div>
						<div class="col-md-5">
							<select class="form-control" id="tahun" name="tahun" title="Pilih Tahun">
								<?php
                                        if ($this->session->userdata('tahun')) {
                                            $j = $this->session->userdata('tahun');
                                        } else {
                                            $j = date('Y');
                                        }
                                        echo "<option value = $j > $j </option>";
                                        for ($i = 2021; $i <= date('Y') + 10; $i += 1) {
                                            if ($i != $j) {//pengecualian untuk str $j
                                                echo "<option value='$i'> $i </option>";
                                            }
                                        }
                                        ?>
							</select>
						</div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-primary">Cari</button>
						</div>
					</form>
				</div>
			</div>

			<div class="card-body">
				<a href="<?= site_url('transaksi/tranPdf') ?>" target="_blank" class="btn btn-outline-success">PDF</a>

					<h5 class="mt-3 text-center">- Data Semua Peminjaman -</h5>
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Pinjam</th>
								<th>Kembali</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $n= 1; foreach($peminjaman as $sr) : ?>
							<tr>
								<td><?= $n++ ?></td>
								<td><?= $sr['nama']; ?></td>
								<td><?= date('d F Y', strtotime($sr['tgl_pinjam'])) ?></td>
								<td><?= date('d F Y', strtotime($sr['tgl_kembali'])) ?></td>
								<td><span class="badge bg-success"><?= $sr['status'] ?></span></td>
								<td>
									<?php if ($sr['status'] == 'Dipinjam'): ?>
									<form action="<?= site_url('transaksi/kembalikan_buku') ?>" method="post">
										<input type="hidden" name="id_pinjam" value="<?= $sr['id_pinjam'] ?>">
										<button type="submit" class="btn btn-warning btn-sm">Kembalikan</button>
									</form>
									<?php else: ?>
									<span class="badge bg-success">Dikembalikan</span>
									<br>
									<small>Dikembalikan pada: <?= date('d-m-Y', strtotime($sr['balik'])) ?></small>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
			</div>
		</div>
	</section>
</div>

<!--large size Modal -->
<!-- Modal for adding a new loan -->
<div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel17">Tambah Peminjaman</h4>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<i data-feather="x"></i>
				</button>
			</div>
			<div class="modal-body">
				<form id="transactionForm" action="<?= site_url('transaksi/tambah_pinjam') ?>"
					class="form form-horizontal" method="post">
					<div class="form-body">
						<div class="row">
							<!-- Tanggal Pinjam -->
							<div class="col-md-4">
								<label for="tanggal">Tanggal</label>
							</div>
							<div class="col-md-8 form-group">
								<input type="date" id="tanggal" class="form-control" name="tgl_pinjam" required>
							</div>

							<!-- Peminjam -->
							<div class="col-md-4">
								<label for="peminjam">Peminjam</label>
							</div>
							<div class="col-md-8 form-group">
								<select id="peminjam" class="form-control" name="id_user" required>
									<option value="" disabled selected>Pilih Peminjam</option>
									<?php foreach($user as $u): ?>
									<option value="<?= $u['id_user'] ?>"><?= $u['nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<!-- Lama Pinjam -->
							<div class="col-md-4">
								<label for="lama_pinjam">Lama Pinjam (Hari)</label>
							</div>
							<div class="col-md-8 form-group">
								<input type="number" id="lama_pinjam" class="form-control" name="lama_pinjam" min="1"
									placeholder="Masukkan lama pinjam" required>
							</div>

							<!-- Buku yang ingin dipinjam -->
							<div class="col-md-4">
								<label for="books">Buku yang Ingin Dipinjam</label>
							</div>
							<div class="col-md-8 form-group">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal"
									data-bs-target="#bookModal">
									Pilih Buku
								</button>
								<table class="table mt-3" id="selectedBooksTable">
									<thead>
										<tr>
											<th>No</th>
											<th>Judul Buku</th>
											<th>Jumlah</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="selectedBooks">
										<!-- Buku yang dipilih -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
					<i class="bx bx-x d-block d-sm-none"></i>
					<span class="d-none d-sm-block">Tutup</span>
				</button>
				<button type="button" class="btn btn-primary ml-1" id="confirmBorrower">
					<i class="bx bx-check d-block d-sm-none"></i>
					<span class="d-none d-sm-block">Simpan</span>
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk memilih buku -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="bookModalLabel">Pilih Buku</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Pilih</th>
							<th>Judul</th>
							<th>Kategori</th>
							<th>Penerbit</th>
							<th>Tahun</th>
							<th>Stok</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($buku as $bk) : ?>
						<tr>
							<td>
								<input type="checkbox" class="selectBook" data-id="<?= $bk['id_buku'] ?>"
									data-judul="<?= $bk['judul'] ?>" data-kategori="<?= $bk['kategori'] ?>"
									data-penerbit="<?= $bk['penerbit'] ?>" data-tahun="<?= $bk['thn_terbit'] ?>"
									data-stok="<?= $bk['stok'] ?>">
							</td>
							<td><?= $bk['judul'] ?></td>
							<td><?= $bk['kategori'] ?></td>
							<td><?= $bk['penerbit'] ?></td>
							<td><?= $bk['thn_terbit'] ?></td>
							<td><?= $bk['stok'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="addBooks">Tambahkan Buku</button>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		let selectedBooks = []; // Array to store selected book IDs and quantities

		// Add books to the table
		document.getElementById('addBooks').addEventListener('click', function () {
			const checkboxes = document.querySelectorAll('.selectBook:checked');
			let selectedHTML = '';
			let bookIds = [];
			let quantities = [];

			checkboxes.forEach((checkbox, index) => {
				const bookId = checkbox.getAttribute('data-id');
				const judul = checkbox.getAttribute('data-judul');
				const stok = checkbox.getAttribute('data-stok');
				const quantity = 1

				if (quantity > 0 && quantity <= stok) {
					selectedBooks.push({
						id: bookId,
						quantity: quantity
					});

					selectedHTML += `
                <tr data-id="${bookId}">
                    <td>${index + 1}</td>
                    <td>${judul}</td>
                    <td>${quantity}</td>
                    <td><button type="button" class="btn btn-danger btn-sm removeBook">Hapus</button></td>
                </tr>
				<input type="hidden" name="id_buku[]" value="${bookId}">
				`;

					bookIds.push(bookId);
					quantities.push(quantity);
				} else {
					alert(`Jumlah tidak valid untuk buku "${judul}"`);
				}
			});

			// Update table and hidden inputs
			document.getElementById('selectedBooks').innerHTML = selectedHTML;
			document.getElementById('selectedBooksInput').value = JSON.stringify(bookIds);
			document.getElementById('quantitiesInput').value = JSON.stringify(quantities);

			$('#bookModal').modal('hide');
		});

		document.getElementById('selectedBooks').addEventListener('click', function (e) {
			if (e.target.classList.contains('removeBook')) {
				const row = e.target.closest('tr');
				const bookId = row.getAttribute('data-id');
				selectedBooks = selectedBooks.filter(book => book.id !== bookId);
				row.remove();
			}
		});

		// Submit form and handle selected books
		document.getElementById('confirmBorrower').addEventListener('click', function () {
			if (selectedBooks.length === 0) {
				alert('Pilih buku terlebih dahulu!');
				return;
			}

			document.getElementById('transactionForm').submit(); // Submit form if books are selected
		});
	});
</script>
