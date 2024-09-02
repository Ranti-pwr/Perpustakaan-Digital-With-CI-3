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

				<div class="col-md-5">
					<form action="<?= base_url() ?>pengembalian/screturn" method="post" class="row ms-2">
						<div class="col-md-5">
							<select class="form-control" id="bulan" name="bulan">
								<?php
                                        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        if ($this->session->userdata('bulan2')) { 
											//jika session bulan ada maka tampilkan, jika tidak tampilkan bulan saat ini
                                            $bln = $this->session->userdata('bulan2') - 1; //kurang 1 index karena dimulai dari 0
                                            $temp = $this->session->userdata('bulan2');
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
                                        if ($this->session->userdata('tahun2')) {
                                            $j = $this->session->userdata('tahun2');
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
				<a href="<?= site_url('pengembalian/tranPdf') ?>" target="_blank"
					class="btn btn-outline-success">PDF</a>
				<h5 class="mt-3 text-center">- Data Semua Pengembalian -</h5>
				<table class="table table-striped" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Pinjam</th>
							<th>Kembali</th>
							<th>Status</th>
							<th>Denda</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $n= 1; foreach($peminjaman as $sr) : ?>
						<tr>
							<td><?= $n++ ?></td>
							<td><?= $sr['nama']; ?></td>
							<td><?= date('d-m-Y', strtotime($sr['tgl_pinjam'])) ?></td>
							<td><?= date('d-m-Y', strtotime($sr['tgl_kembali'])) ?></td>
							<td><span class="badge bg-success"><?= $sr['status'] ?></span>
								<br>
								<small>Dikembalikan pada: <?= date('d-m-Y', strtotime($sr['balik'])) ?></small>
							</td>
							<td><?= isset($sr['denda']) ? 'Rp ' . number_format($sr['denda'], 0, ',', '.') : 'Tidak ada denda' ?>
								<!-- else jika nilai null or 0 maka keluaran menetapkan 'Tidak ada denda' -->
							</td>
							<td>
								<a href="<?= site_url('pengembalian/delete/').$sr['id_pinjam'] ?>"
									class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
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
