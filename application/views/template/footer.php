<footer>
	<div class="footer clearfix mb-0 text-muted">
		<div class="float-start">
			<p>All rights reversed 2024 &copy;</p>
		</div>
		<div class="float-end">
			<p>Author with <span class="text-danger"></i></span> by <a href="#">Ranti-pwr</a></p>
		</div>
	</div>
</footer>
</div>
</div>
</div>
<script src="<?= base_url() ?>sh/mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>sh/mazer/dist/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>sh/mazer/dist/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?= base_url() ?>sh/mazer/dist/assets/js/pages/dashboard.js"></script>

<script src="<?= base_url() ?>sh/mazer/dist/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
	// Simple Datatable
	let table1 = document.querySelector('#table1');
	let dataTable = new simpleDatatables.DataTable(table1, {
		perPageSelect: false // Disable per page dropdown
	});
</script>





<script src="<?= base_url() ?>sh/mazer/dist/assets/js/main.js"></script>
</body>

</html>
