<?php $kode_seksi = $this->session->userdata("kode_seksi"); ?>
<?php $kode_bidang = $this->session->userdata("kode_bidang"); ?>
<?php $nama = $this->session->userdata("nama"); ?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
	<div class="container">

		<a href="<?php echo site_url('../'); ?>" class="navbar-brand">
			<img src="<?php echo base_url(LOGO); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<!-- <span class="brand-text font-weigonclick="modalDefault('Ubah Sandi', 'ubahSandi')"ht-light"><?php echo SITE_NAME; ?></span> -->
		</a>

		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="<?php echo site_url('../'); ?>" class="nav-link">Beranda</a>
				</li>
				<!-- SPJ -->
				<?php if ($kode_bidang != "XXXX") : ?>
					<li class="nav-item dropdown">
						<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">SPJ</a>
						<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
							<?php if ($kode_seksi != "XXXX" && $kode_bidang != "DK005") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../rok'); ?>" class="dropdown-item">Pendaftaran ROK</a>
								</li>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../spj'); ?>" class="dropdown-item">Pendaftaran SPJ</a>
								</li>
							<?php elseif ($kode_bidang != "DK005") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../verifikasi'); ?>" class="dropdown-item">Verifikasi SPJ</a>
								</li>
							<?php elseif ($kode_bidang == "DK005") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../spj'); ?>" class="dropdown-item">Pencatatan SPJ</a>
								</li>
							<?php endif; ?>
							<?php if ($kode_bidang == "DK001" && $kode_seksi == "XXXX") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../pembukuan'); ?>" class="dropdown-item">Pembukuan SPJ</a>
								</li>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../transfer'); ?>" class="dropdown-item">Transfer SPJ</a>
								</li>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../up'); ?>" class="dropdown-item">Uang Persediaan</a>
								</li>
							<?php endif; ?>
						</ul>
					</li>
				<?php endif; ?>
				<!-- LAPORAN -->
				<?php if ($kode_seksi == "XXXX") : ?>
					<li class="nav-item dropdown">
						<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan</a>
						<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
							<li>
								<a tabindex="-1" href="<?php echo site_url('../realisasi-rok'); ?>" class="dropdown-item">Realisasi ROK</a>
							</li>
							<?php //if ($kode_bidang == "XXXX") : 
							?>
							<li class="dropdown-submenu dropdown-hover">
								<a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SPJ</a>
								<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
									<li>
										<a tabindex="-1" href="<?php echo site_url('../verifikasi-spj'); ?>" class="dropdown-item">Verifikasi</a>
									</li>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../pembukuan-spj'); ?>" class="dropdown-item">Pembukuan</a>
									</li>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../transfer-spj'); ?>" class="dropdown-item">Transfer</a>
									</li>
								</ul>
							</li>
							<?php //endif; 
							?>
							<li class="dropdown-submenu dropdown-hover">
								<a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Buku Kas</a>
								<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
									<li>
										<a tabindex="-1" href="<?php echo site_url('../bk-0'); ?>" class="dropdown-item">Umum Standar</a>
									</li>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../bk-1'); ?>" class="dropdown-item">Per Sub Kegiatan</a>
									</li>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../bk-2'); ?>" class="dropdown-item">Per Rekening</a>
									</li>
								</ul>
							</li>
							<!-- <li>
								<a tabindex="-1" href="<?php echo site_url('../laporan-rak'); ?>" class="dropdown-item">Laporan RAK</a>
							</li>
							<li>
								<a tabindex="-1" href="<?php echo site_url('../laporan-rok'); ?>" class="dropdown-item">Laporan ROK</a>
							</li> -->
							<li>
								<a tabindex="-1" href="<?php echo site_url('../laporan-kinerja'); ?>" class="dropdown-item">Laporan Kinerja</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<!-- RAK -->
				<?php //if ($kode_seksi != "XXXX") : 
				?>
				<li class="nav-item">
					<a href="<?php echo site_url('../rak'); ?>" class="nav-link">RAK</a>
				</li>
				<?php //endif; 
				?>
				<!-- PENGATURAN -->
				<?php if ($nama == "super" || $kode_seksi == "DJ001" || $kode_bidang == "DK005") : ?>
					<li class="nav-item dropdown">
						<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pengaturan</a>
						<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
							<!-- Level two dropdown-->
							<?php if ($kode_seksi == "DJ001" || $nama == "super") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../user'); ?>" class="dropdown-item">Pengguna</a>
								</li>
							<?php endif; ?>
							<?php if ($kode_bidang == "DK005") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../kegiatan'); ?>" class="dropdown-item">Kegiatan</a>
								</li>
							<?php endif; ?>
							<?php if ($kode_seksi == "XXXX") : ?>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../kegiatan'); ?>" class="dropdown-item">Kegiatan</a>
								</li>
								<li>
									<a tabindex="-1" href="<?php echo site_url('../pegawai'); ?>" class="dropdown-item">Pegawai</a>
								</li>
								<?php if ($nama == "super") : ?>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../pulihkan-spj'); ?>" class="dropdown-item">Pulihkan SPJ</a>
									</li>
									<li>
										<a tabindex="-1" href="<?php echo site_url('../lain'); ?>" class="dropdown-item">Lain-lain</a>
									</li>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</li>
				<?php endif; ?>

				<!-- CONTOH -->
				<!-- <li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu</a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<li class="dropdown-submenu dropdown-hover">
							<a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sub Menu</a>
							<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

								<li class="dropdown-submenu dropdown-hover">
									<a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Sub Sub Menu</a>
									<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
										<li>
											<a tabindex="-1" href="<?php echo site_url('../'); ?>" class="dropdown-item">Sub Sub Sub Menu</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li> -->
			</ul>
		</div>

		<!-- Right navbar links -->
		<ul class="order-1 order-md-3 navbar-nav ml-auto navbar-no-expand">
			<li class="nav-item">
				<a href="#" class="nav-link" onclick="return false;">
					Hallo, <?php echo $this->session->userdata("nama"); ?>
				</a>
			</li>
			<li class="nav-item">
				<a href="java" onclick="modalDefault('Ubah Sandi', 'ubahSandi'); return false;" class="nav-link" title="Ubah Sandi">
					<i class="fa fa-unlock"></i>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo site_url('../logout') ?>" class="nav-link" title="Keluar">
					<i class="fa fa-sign-out-alt"></i>
				</a>
			</li>
		</ul>
	</div>
</nav>
<!-- /.navbar -->