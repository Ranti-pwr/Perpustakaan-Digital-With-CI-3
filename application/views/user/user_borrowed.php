<div class="card-body">
	<h5 class="mt-3 text-center">My Borrowed Books</h5>
	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Category</th>
				<th>Publisher</th>
				<th>Borrowed Date</th>
				<th>Return Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $n = 1;
			foreach ($borrowed_books as $book) : ?>
				<tr>
					<td><?= $n++ ?></td>
					<td><?= html_escape($book['judul']); ?></td>
					<td><?= html_escape($book['kategori']); ?></td>
					<td><?= html_escape($book['penerbit']); ?></td>
					<td><?= date('d F Y', strtotime($book['tgl_pinjam'])) ?></td>
					<td><?= date('d F Y', strtotime($book['tgl_kembali'])) ?></td>
					<td>
						<?php if ($book['status'] == 'Dikembalikan') : ?>
							<a href="<?= base_url('user/bookDetail/' . $book['id_buku']) ?>" class="btn btn-primary btn-sm">Review</a>
						<?php else : ?>
							<span class="text-muted">Not Returned</span>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
