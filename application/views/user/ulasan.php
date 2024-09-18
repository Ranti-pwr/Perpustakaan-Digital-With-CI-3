	<h2><?= $book['judul'] ?></h2>
	<p>By <?= $book['pengarang'] ?></p>

	<h3>Ulasan Buku</h3>
	<?php if (count($rating) > 0): ?>
		<?php foreach ($rating as $review): ?>
			<div class="review">
				<strong>Rating: <?= $review['rating'] ?>/5</strong>
				<p><?= $review['review'] ?></p>
				<small>Diulas pada <?= date('d M Y', strtotime($review['review_date'])) ?></small>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<p>No reviews yet.</p>
	<?php endif; ?>

	<h3 class="mt-3">Tinggalkan Ulasan Anda</h3>
	<form action="<?= site_url('user/submit_review') ?>" method="post">
		<input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
		<input type="hidden" name="book_id" value="<?= $book['id_buku'] ?>">

		<div class="form-group">
			<label for="rating">Rating (out of 5):</label>
			<select name="rating" id="rating" class="form-control" required>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		</div>

		<div class="form-group">
			<label for="review">Ulasan Anda:</label>
			<textarea name="review" id="review" class="form-control" rows="5" required></textarea>
		</div>

		<button type="submit" class="btn btn-primary">Kirim Ulasan</button>
	</form>
