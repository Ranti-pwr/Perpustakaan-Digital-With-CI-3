<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perpus | <?= $title ?></title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url(); ?>sh/mazer/dist/assets/css/bootstrap.css">

	<link rel="stylesheet" href="<?= base_url(); ?>sh/mazer/dist/assets/vendors/iconly/bold.css">

	<link rel="stylesheet"
		href="<?= base_url(); ?>sh/mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="<?= base_url(); ?>sh/mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="<?= base_url(); ?>sh/mazer/dist/assets/css/app.css">
	<link rel="shortcut icon" href="<?= base_url(); ?>sh/mazer/dist/assets/images/favicon.svg" type="image/x-icon">

	<script>
        function validateTextInput(event) {
            // Mengambil karakter yang dimasukkan
            const char = String.fromCharCode(event.which);
            // Cek apakah karakter adalah huruf atau spasi
            if (!/[A-Za-z\s]/.test(char)) {
                event.preventDefault(); // Mencegah karakter selain huruf atau spasi
            }
        }


    </script>
</head>
