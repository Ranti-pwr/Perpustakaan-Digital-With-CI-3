<!DOCTYPE html>
<html>

<head>
	<title>Data Pembelian</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			/* background-image: url('https://i.pinimg.com/originals/c9/82/53/c982534a1acdccee1e5e13baf00afcda.jpg'); */
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;
			color: #333;
		}

		.content {
			background-color: rgba(255, 255, 255, 0.9);
			padding: 20px;
			margin: 50px auto;
			max-width: 900px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		h1 {
			text-align: center;
			color: #333;
			text-transform: uppercase;
			font-weight: 400;
			margin-top: 10px;
		}

		p {
			color: #333;
			font-weight: 400;
			text-align: center;
		}

		table {
			width: 100%;
			margin-top: 20px;
			border-collapse: collapse;
			background: #fff;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		th,
		td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: center;
		}

		th {
			background-color: #6777EF;
			color: white;
			padding-top: 12px;
			padding-bottom: 12px;
		}

		img {
			width: 100px;
            height: 110px;
            object-fit: cover;
            border-radius: 5px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.text {
			font-size: 18px;
			color: #555;
		}

		.harga {
			font-size: 24px;
			font-weight: bold;
			color: #3498db;
		}
	</style>
</head>

<body>
	<div class="content">
		<h1>Data Daftar List Buku</h1>
		<!-- <p class="bulan"><?= $bulan; ?> <?= $tahun ?></p> -->
		<table>
			<tr>
				<th>No</th>
				<th>Cover</th>
				<th>Judul</th>
				<th>Kategori</th>
				<th>Penerbit</th>
				<th>Pengarang</th>
				<th>Tahun Terbit</th>
				<th>Stock</th>
			</tr>
			<?php $start = 0; ?>
			<?php foreach ($laporan as $lp) : ?>
			<tr>
				<td><?= $start + 1; ?></td>
				<td><img src="<?= base_url('sh/buku/cover/'.$lp['cover'])
										?>" alt="Cover Buku" class="img-responsive"></td>
				<td><?= $lp['judul']; ?></td>
				<td><?= $lp['kategori']; ?></td>
				<td><?= $lp['penerbit']; ?></td>
				<td><?= $lp['pengarang']; ?></td>
				<td><?= date('d F Y', strtotime($lp['thn_terbit'])) ?></td>
				<td><?= $lp['stok']; ?></td>
			</tr>
			<?php $start++; ?>
			<?php endforeach; ?>
		</table>
	</div>
</body>

</html>
