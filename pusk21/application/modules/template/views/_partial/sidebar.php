
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="index3.html" class="brand-link">
					<img src="<?php echo base_url(LOGO); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light"><?php echo SHORT_NAME; ?></span>
				</a>

				<!-- Sidebar -->
				<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url('dist/img/avatar5.png'); ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<p class="text-white"><?php echo ucfirst($this->session->userdata('jabatan')); ?></p>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
							with font-awesome or any other icon font library -->
						<!-- <li class="nav-item">
							<a href="<?php echo site_url('../home'); ?>" class="nav-link">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Home
								</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo site_url('../arsip'); ?>" class="nav-link">
								<i class="nav-icon fas fa-envelope-open"></i>
								<p>
									Arsip
								</p>
							</a>
						</li>
						<?php
							if($this->session->userdata('level') == '2' && $this->session->userdata('posisi') == '1'){
						?>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-database"></i>
								<p>
									Data Master
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo site_url('../pegawai'); ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Pegawai</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('../user'); ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Akun User</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('../surat'); ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Jenis Surat</p>
									</a>
								</li>
							</ul>
						</li>
						<?php
							}
						?>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>