<div class="card-body">
	<h5 class="mt-3 text-center">My Borrowed Books</h5>
	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Category</th>
				<th>Publisher</th>
				<th>Author</th>
				<th>Borrowed Date</th>
				<th>Return Date</th>
				<!-- <th>User Fines</th> -->
			</tr>
		</thead>
		<tbody>
			<?php $n= 1; foreach($borrowed_books as $book) : ?>
			<tr>
				<td><?= $n++ ?></td>
				<td><?= html_escape($book['judul']); ?></td>
				<td><?= html_escape($book['kategori']); ?></td>
				<td><?= html_escape($book['penerbit']); ?></td>
				<td><?= html_escape($book['pengarang']); ?></td>
				<td><?= date('d F Y', strtotime($book['tgl_pinjam'])) ?></td>
				<td><?= date('d F Y', strtotime($book['tgl_kembali'])) ?></td>
				<!-- <td><?= isset($sr['denda']) ? 'Rp ' . number_format($sr['denda'], 0, ',', '.') : 'Tidak ada denda' ?> -->
					<!-- else jika nilai null or 0 maka keluaran menetapkan 'Tidak ada denda' -->
				<!-- </td> -->
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
