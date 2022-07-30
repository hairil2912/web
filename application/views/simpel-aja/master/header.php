<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SIMPEL AJA</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>plugins/timepicker/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/alertify.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/alertifyjs/css/themes/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/pasien/plugins/nprogress/nprogress.css') ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/pasien/') ?>dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/style.purple.css') ?>">
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<?= stack('css'); ?>
	<noscript>
		<style type="text/css">
			body {
				display: none;
			}
		</style>
		<meta http-equiv="refresh" content="0; url=<?= site_url('noscript') ?>">
	</noscript>
	<script>
		var site_url = '<?= site_url() ?>';
		var tokenName = '<?= $this->security->get_csrf_token_name() ?>';
		var segment1 = '<?= $this->uri->segment(1) ?>';
		var segment2 = '<?= $this->uri->segment(2) ?>';
		var segment3 = '<?= $this->uri->segment(3) ?>';
		var segment4 = '<?= $this->uri->segment(4) ?>';
	</script>
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">
	<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">

		</div>
	</div>

	<div class="wrapper">
		<header class="main-header">
			<a href="<?= site_url('simpel-aja/home') ?>" class="logo">
				<span class="logo-mini"><b>SIM</b></span>
				<span class="logo-lg"><b>SIMPEL AJA</b></span>
			</a>

			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">

								<i class="fa fa-bell-o" style="font-size: 20px; font-weight: bold;"></i>
								<span class="label label-warning notification-badge hide">0</span>
							</a>
							<ul class="dropdown-menu" style="width: 350px;">
								<li class="header"></li>
								<li>
									<ul class="menu notification-list">

									</ul>
								</li>
								<li class="footer"><a href="#">View all</a></li>
							</ul>
						</li>
						<?php
						$data['user'] = json_decode($_COOKIE['user']);
						?>
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php if ($user->id_jk == '1') : ?>
									<img src="<?= base_url('assets/static-image/user.png') ?>" class="user-image" alt="User Image">
								<?php else : ?>
									<img src="<?= base_url('assets/static-image/user-female.png') ?>" class="user-image" alt="User Image">
								<?php endif; ?>
								<span class="hidden-xs">
									<?= @$user->nama_lengkap ?>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<?php if ($user->id_jk == '1') : ?>
										<img src="<?= base_url('assets/static-image/user.png') ?>" class="img-circle" alt="User Image">
									<?php else : ?>
										<img src="<?= base_url('assets/static-image/user-female.png') ?>" class="img-circle" alt="User Image">
									<?php endif; ?>
									<p>
										<?= @$user->nama_lengkap ?>
									</p>
								</li>
								<li class="user-footer">
									<ul class="list-group">
										<li class="list-group-item"><a style="color: #004248;" href="<?= site_url('pendaftaran/login/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>