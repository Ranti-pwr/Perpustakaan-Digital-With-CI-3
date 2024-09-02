<div class="card-body">
	<h5 class="mt-3 text-center">Buku Tersedia</h5>
	<table class="table table-striped" id="table1">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Cover</th>
				<th>Category</th>
				<th>Publisher</th>
				<th>Author</th>
				<!-- <th>Year</th> -->
				<th>Stock</th>
			</tr>
		</thead>
		<tbody>
			<?php $n= 1; foreach($books as $book) : ?>
			<tr>
				<td><?= $n++ ?></td>
				<td><?= html_escape($book['judul']); ?></td>
				<td><button class="btn" data-bs-toggle="modal" data-bs-target="#small<?= $book['id_buku'] ?>">
						<i class="bi bi-journal-richtext"></i>
					</button></td>
				<td><?= html_escape($book['kategori']); ?></td>
				<td><?= html_escape($book['penerbit']); ?></td>
				<td><?= html_escape($book['pengarang']); ?></td>
				<!-- <td><?= date('d F Y', strtotime($book['thn_terbit'])) ?></td> -->
				<td><?= html_escape($book['stok']); ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>


<!-- Button trigger for small size modal modal -->
<?php foreach ($books as $mboh) : ?>
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
				<img src="<?= base_url('sh/buku/cover/'.$mboh['cover'])
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

