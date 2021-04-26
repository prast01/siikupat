<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('template/_partial/head.php'); ?>
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<?php $this->load->view('template/_partial/navbar.php'); ?>

		<?php //$this->load->view('template/_partial/sidebar.php'); 
		?>

		<?php echo $content; ?>

		<?php $this->load->view('template/_partial/footer.php'); ?>

		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="body"></div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="modal-xl">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="body"></div>

				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

	</div>
	<!-- ./wrapper -->

	<?php $this->load->view('template/_partial/js.php'); ?>
</body>

</html>