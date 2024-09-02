            <div class="page-heading">
            	<div class="page-title">
            		<div class="row">
            			<div class="col-12 col-md-6 order-md-1 order-last">
            				<h3>Daftar Data User</h3>
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
            			<div class="card-header">
            				<button class="btn btn-success" data-bs-toggle="modal"
            					data-bs-target="#inlineForm"><strong>+Tambah User</strong></button>
            				<button class="btn btn-primary dropdown-toggle me-1 ms-3" type="button"
            					id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
            					aria-expanded="false">
            					Sortir
            				</button>
            				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            					<a class="dropdown-item" href="<?= site_url('user') ?>">Semua Data</a>
            					<a class="dropdown-item" href="<?= site_url('user/index/petugas') ?>">Petugas</a>
            					<a class="dropdown-item" href="<?= site_url('user/index/anggota') ?>">Anggota</a>
            				</div>
            			</div>
            			<div class="card-body">
            				<table class="table table-striped" id="table1">
            					<thead>
            						<tr>
            							<th>No</th>
            							<th>Name</th>
            							<th>Username</th>
            							<th>Status Role</th>
            							<th>Action</th>
            						</tr>
            					</thead>
            					<tbody>
            						<?php $n= 1; foreach($user as $sr) : ?>
            						<tr>
            							<td><?= $n ?></td>
            							<td><?= html_escape($sr['nama']); ?></td>
            							<td><?= html_escape(strstr($sr['email'], '@', true)); ?></td>
										<!-- <td><?= html_escape(substr($sr['email'], 0, 10)) . '...'; ?></td> -->
										<!-- <td><?= html_escape(strstr($sr['email'], '@')); ?></td> -->

            							<td>
            								<span
            									class="<?= html_escape($sr['role']) == 'Administrator' ? 'badge bg-light-danger' : (html_escape($sr['role']) == 'Petugas' ? 'badge bg-light-success' : 'badge bg-light-info'); ?>">
            									<?= html_escape($sr['role']); ?>
            								</span>

            							</td>
            							<td>
            								<a href="<?= site_url('user/delete/').$sr['id_user'] ?>"
            									class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
            								<button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
            									data-bs-target="#inlineForm1<?= $sr['id_user'] ?>"><i
            										class="bi bi-pen"></i></button>
            							</td>
            						</tr>
            						<?php $n++; endforeach ?>
            					</tbody>
            				</table>
            			</div>
            		</div>

            	</section>
            </div>

            <?php foreach($user as $mbh) : ?>
            <div class="modal fade text-left" id="inlineForm1<?= $mbh['id_user'] ?>" tabindex="-1" role="dialog"
            	aria-labelledby="myModalLabel33" aria-hidden="true">
            	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h4 class="modal-title" id="myModalLabel33">Form Add User </h4>
            				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            					<i data-feather="x"></i>
            				</button>
            			</div>
            			<form action="<?= site_url('user/edit') ?>" method="post">
            				<div class="modal-body">
            					<div class="form-body">
            						<div class="row">
            							<input type="hidden" name="id_user" value="<?= $mbh['id_user'] ?>">
            							<div class="col-md-4">
            								<label>Name</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="text" class="form-control" placeholder="Name"
            											id="first-name-icon" name="nama" value="<?= $mbh['nama'] ?>"
            											required>
            										<div class="form-control-icon">
            											<i class="bi bi-person"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            							<div class="col-md-4">
            								<label>Email</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="email" class="form-control is-valid"
            											placeholder="Email" id="first-name-icon" name="email"
            											value="<?= $mbh['email'] ?>" required>
            										<div class="form-control-icon">
            											<i class="bi bi-envelope"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            							<!-- <div class="col-md-4">
            								<label>Password</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="password" class="form-control" placeholder="Password"
            											name="password" required>
            										<div class="form-control-icon">
            											<i class="bi bi-lock"></i>
            										</div>
            									</div>
            								</div>
            							</div> -->
            							<div class="col-md-4 ">
            								<label class="input-group-text" for="inputGroupSelect01">Role</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<select class="form-select" id="inputGroupSelect01" name="role"
            											required>
            											<!-- <option selected>Choose...</option> -->
            											<option value="Petugas"
            												<?= $mbh['role'] == 'Petugas' ? 'selected' : '' ?>>Petugas
            											</option>
            											<option value="Anggota"
            												<?= $mbh['role'] == 'Anggota' ? 'selected' : '' ?>>Anggota
            											</option>
            											<option value="Administrator"
            												<?= $mbh['role'] == 'Administrator' ? 'selected' : '' ?>>
            												Administrator
            											</option>
            										</select>
            										<!-- <input type="number" class="form-control" placeholder="Mobile"> -->
            										<!-- <div class="form-control-icon">
            											<i class="bi bi-phone"></i>
            										</div> -->
            									</div>
            								</div>
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="modal-footer">
            					<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            						<i class="bx bx-x d-block d-sm-none"></i>
            						<span class="d-none d-sm-block">Close</span>
            					</button>
            					<button type="submit" class="btn btn-primary ml-1">
            						<i class="bx bx-check d-block d-sm-none"></i>
            						<span class="d-none d-sm-block">Update</span>
            					</button>
            				</div>
            			</form>
            		</div>
            	</div>
            </div>
            <?php endforeach ?>


            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
            	aria-labelledby="myModalLabel33" aria-hidden="true">
            	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h4 class="modal-title" id="myModalLabel33">Form Add User </h4>
            				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            					<i data-feather="x"></i>
            				</button>
            			</div>
            			<form action="<?= site_url('user/tambah') ?>" method="post">
            				<div class="modal-body">
            					<div class="form-body">
            						<div class="row">
            							<div class="col-md-4">
            								<label>Name</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="text" class="form-control" placeholder="Name"
            											id="first-name-icon" name="nama" required>
            										<div class="form-control-icon">
            											<i class="bi bi-person"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            							<div class="col-md-4">
            								<label>Email</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="email" class="form-control" placeholder="Email"
            											id="first-name-icon" name="email" required>
            										<div class="form-control-icon">
            											<i class="bi bi-envelope"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            							<div class="col-md-4">
            								<label>Password</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<input type="password" class="form-control" placeholder="Password"
            											name="password" required>
            										<div class="form-control-icon">
            											<i class="bi bi-lock"></i>
            										</div>
            									</div>
            								</div>
            							</div>
            							<div class="col-md-4 ">
            								<label class="input-group-text" for="inputGroupSelect01">Role</label>
            							</div>
            							<div class="col-md-8">
            								<div class="form-group has-icon-left">
            									<div class="position-relative">
            										<select class="form-select" id="inputGroupSelect01" name="role"
            											required>
            											<option selected>Choose...</option>
            											<option value="Petugas">Petugas</option>
            											<option value="Anggota">Anggota</option>
            											<option value="Administrator">Admin</option>
            										</select>
            										<!-- <input type="number" class="form-control" placeholder="Mobile"> -->
            										<!-- <div class="form-control-icon">
            											<i class="bi bi-phone"></i>
            										</div> -->
            									</div>
            								</div>
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="modal-footer">
            					<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            						<i class="bx bx-x d-block d-sm-none"></i>
            						<span class="d-none d-sm-block">Close</span>
            					</button>
            					<button type="submit" class="btn btn-primary ml-1">
            						<i class="bx bx-check d-block d-sm-none"></i>
            						<span class="d-none d-sm-block">Add</span>
            					</button>
            				</div>
            			</form>
            		</div>
            	</div>
            </div>
