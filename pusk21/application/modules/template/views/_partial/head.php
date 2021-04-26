<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>
	<?php
	// echo strtoupper(SITE_NAME);
	if ($this->uri->segment(1)) {
		$judul = explode('_', $this->uri->segment(1));
		if (isset($judul[1])) {
			$judul2 = $judul[1];
		} else {
			$judul2 = '';
		}
		// echo " - ". ucfirst($judul[0].' '). ucfirst($judul2);
		echo ucfirst($judul[0] . ' ') . ucfirst($judul2);
	}
	?>
</title>
<link rel="shortcut icon" href="<?php echo base_url(LOGO); ?>" type="image/x-icon">


<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css') ?>">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
<!-- JQVMap -->
<link rel="stylesheet" href="<?php echo base_url('plugins/jqvmap/jqvmap.min.css') ?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css') ?>">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo base_url('plugins/summernote/summernote-bs4.css') ?>">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.css') ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css') ?>">

<!-- <script src="<?= site_url("../"); ?>dist/js/echarts.min.js"></script> -->
<!-- jQuery -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
<style>
	th,
	td {
		font-size: 14px;
	}
</style>