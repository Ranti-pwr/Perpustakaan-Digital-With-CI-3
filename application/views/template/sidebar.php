<body>
	<div id="app">
		<div id="sidebar" class="<?= $this->uri->segment(1) != 'buku' ? 'active' : '' ?>">
			<div class="sidebar-wrapper active">
				<div class="sidebar-header">
					<div class="d-flex justify-content-between">
						<div class="logo">
							<a href="#"><img src="<?= base_url() ?>sh/mazer/dist/assets/images/logo/logo.png" alt="Logo"
									srcset=""></a>
						</div>
						<div class="toggler">
							<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
						</div>
					</div>
				</div>
				<div class="sidebar-menu">
					<ul class="menu">
						<li class="sidebar-title">Main Navigation</li>


						<?php if ($this->session->userdata('role') == 'Anggota') : ?>
							<li class="sidebar-item <?= $this->uri->segment(1) == 'userpi' ? 'active' : '' ?>">
								<a href="<?= base_url('userpi') ?>" class='sidebar-link'>
									<i class="bi bi-grid-fill"></i>
									<span>List Books Available</span>
								</a>
							</li>
							<li class="sidebar-item <?= $this->uri->segment(2) == 'userpi/user_pinjam' ? 'active' : '' ?>">
								<a href="<?= base_url('userpi/user_pinjam') ?>" class='sidebar-link'>
									<i class="bi bi-grid-fill"></i>
									<span>My Borrowed Books</span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ($this->session->userdata('role') != 'Anggota') : ?>
							<li class="sidebar-item <?= $this->uri->segment(1) == 'home' ? 'active' : '' ?>">
								<a href="<?= base_url('home') ?>" class='sidebar-link'>
									<i class="bi bi-grid-fill"></i>
									<span>Dashboard</span>
								</a>
							</li>

							<li class="sidebar-item <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
								<a href="<?= base_url('user') ?>" class='sidebar-link'>
									<i class="bi bi-person-fill"></i>
									<span>Pengguna</span>
								</a>
							</li>

							<li class="sidebar-item <?= $this->uri->segment(1) == 'buku' || $this->uri->segment(1) == 'kategori' ? 'active' : '' ?> has-sub">
								<a href="#" class='sidebar-link'>
									<i class="bi bi-book-half"></i>
									<span>Data Book</span>
								</a>
								<ul class="submenu <?= $this->uri->segment(1) == 'buku' || $this->uri->segment(1) == 'kategori' ? 'active' : '' ?>">
									<li class="submenu-item <?= $this->uri->segment(1) == 'buku' ? 'active' : '' ?>">
										<a href="<?= site_url('buku') ?>">Book</a>
									</li>
									<?php if ($this->session->userdata('role')  == 'Administrator') : ?>
										<li class="submenu-item <?= $this->uri->segment(1) == 'kategori' ? 'active' : '' ?>">
											<a href="<?= site_url('kategori') ?>">Categories</a>
										</li>
									<?php endif; ?>
								</ul>
							</li>


							<li class="sidebar-item <?= $this->uri->segment(1) == 'transaksi' || $this->uri->segment(1) == 'pengembalian' ? 'active' : '' ?> has-sub">
								<a href="#" class='sidebar-link'>
									<i class="bi bi-stack"></i>
									<span>Transaction</span>
								</a>
								<ul class="submenu <?= $this->uri->segment(1) == 'transaksi' || $this->uri->segment(1) == 'pengembalian' ? 'active' : '' ?>">
									<li class="submenu-item <?= $this->uri->segment(1) == 'transaksi' ? 'active' : '' ?>">
										<a href="<?= site_url('transaksi') ?>">Borrowing</a>
									</li>
									<li class="submenu-item <?= $this->uri->segment(1) == 'pengembalian' ? 'active' : '' ?>">
										<a href="<?= site_url('pengembalian') ?>">Returned</a>
									</li>
								</ul>
							</li>

							<!-- <li class="sidebar-item <?= $this->uri->segment(1) == '#' ? 'active' : '' ?>">
							<a href="<?= base_url('#') ?>" class='sidebar-link'>
								<i class="bi bi-cash"></i>
								<span>Fine</span>
							</a>
						</li> -->

							<li class="sidebar-title">Example</li>
							<li class="sidebar-item  has-sub">
								<a href="#" class='sidebar-link'>
									<i class="bi bi-person-badge-fill"></i>
									<span>Authentication</span>
								</a>
								<ul class="submenu ">
									<li class="submenu-item ">
										<a href="auth-login.html">Login</a>
									</li>
									<li class="submenu-item ">
										<a href="auth-register.html">Register</a>
									</li>
									<li class="submenu-item ">
										<a href="auth-forgot-password.html">Forgot Password</a>
									</li>
								</ul>
							</li>

						<?php endif; ?>
					</ul>
				</div>
				<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
			</div>
		</div>
		<div id="main" class='layout-navbar'>
			<header class='mb-3'>
				<nav class="navbar navbar-expand navbar-light ">
					<div class="container-fluid">
						<a href="#" class="burger-btn d-block">
							<i class="bi bi-justify fs-3"></i>
						</a>

						<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
							data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
							aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
								<li class="nav-item dropdown me-3">
								</li>
							</ul>
							<div class="dropdown">
								<a href="#" data-bs-toggle="dropdown" aria-expanded="false">
									<div class="user-menu d-flex">
										<div class="user-name text-end me-3">
											<h6 class="mb-0 text-gray-600"><?= $users->nama; ?></h6>
											<p class="mb-0 text-sm text-gray-600"><?= $users->role; ?></p>
										</div>
										<div class="user-img d-flex align-items-center">
											<div class="avatar avatar-md">
												<img src="<?= base_url() ?>sh/mazer/dist/assets/images/faces/1.jpg">
												<span class="avatar-status bg-success"></span>
											</div>
										</div>
									</div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
									<li>
										<h6 class="dropdown-header">Hello, <?= $users->nama; ?></h6>
									</li>
									<li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
											Profile</a></li>
									<li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
											Settings</a></li>
									<li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
											Wallet</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i
												class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
								</ul>
							</div>
						</div>
					</div>
				</nav>
			</header>
			<div id="main-content" class="content">
