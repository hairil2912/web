<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
	<title><?= get_site_setting('site_name') ?></title>
	<!-- <link rel="shortcut icon" href="images/favicon.png"> -->
	<link href="<?= site_url() ?>assets/admin/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/node_modules/alertifyjs/build/css/alertify.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/node_modules/alertifyjs/build/css/themes/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/admin/src/css/style.css" rel="stylesheet">

	<?php asset_css(); ?>

	<style type="text/css">
		.alertify .ajs-header {
			margin: -24px;
			margin-bottom: 0;
			padding: 7px 13px;
			background-color: #fff;
		}

		.alertify .ajs-body .ajs-content {
			padding: 16px 24px 2px 0px;
		}

		.alertify .ajs-dialog {
			max-width: 450px;
		}

		.alertify .ajs-footer {
			background-color: #fff;
			padding: 7px;
			border-top: 1px solid #e5e5e5;
			border-radius: 0 0 6px 6px;
		}

		.alertify .ajs-commands button {
			padding: 5px 0px;
		}

		.alertify .ajs-footer .ajs-buttons .ajs-button {
			min-width: 80px;
			min-height: 30px;
		}

		.pagination-sm li a {
			padding: .25rem .5rem;
			line-height: 1.5;
			font-size: 0.76563rem;
		}

		thead {
			background: #026082;
			color: #fff;
		}

		.app-header.navbar .navbar-brand {
			background-image: url('');
		}
	</style>

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
	<header class="app-header navbar">
		<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
		<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="nav navbar-nav ml-auto">

			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="<?= base_url() ?>assets/static-image/user.png" class="img-avatar" alt="admin@bootstrapmaster.com">
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="<?= site_url('admin/home/logout') ?>"><i class="fa fa-lock"></i> Logout</a>
				</div>
			</li>
		</ul>
	</header>