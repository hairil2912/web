<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= (!empty(@$post->title)) ? $post->title : get_site_setting('site_name') ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/owl.carousel.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/animate.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/slick.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/slick-theme.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/fonts/flaticon.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/rsmenu-main.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/rsmenu-transitions.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/off-canvas.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/rsanimations.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/rs-spaceing.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/style.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/newsite/css/responsive.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/site/css/jquery-ui.min.css') ?>" />
</head>

<body>
	<style>
		.rs-toolbar-part {
			background: <?= '#', get_site_setting('color') ?> !important;
		}
		.rs-toolbar-part .logo-part img {
			max-height: 500px;
		}

		.rs-menu a {
			margin-left: 16px !important;
		}

		.ui-dialog .ui-dialog-content {
			position: relative;
			border: 0;
			padding: .5em 1em;
			background: none;
			overflow: auto;
		}

		.full-width-header.personal-head .rs-header {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-icon-slider-part.part3.style2 .rs-services-wrap .serviecs-item-part {
			background: <?= '#', get_site_setting('color') ?> !important;
		}

		#scrollUp {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-quality-services-part .item-services:after {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-icon-slider-part.part3.style2 .rs-services-wrap .serviecs-item-part .services-desc .title-part a {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-medvill-medical-part .rs-services-part .content-part .best-part {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.sec-title .title {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-our-services-part.part2 .item .item-services .services-desc .title-upper a {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.owl-carousel .owl-dots button.owl-dot.active {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.owl-carousel .owl-dots button.owl-dot {
			border: 2px solid <?= '#', get_site_setting('color_2') ?> !important;
		}

		.secondary-color {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-our-qualified-doctor .item .team-inner:hover {
			background: <?= '#', get_site_setting('color') ?> !important;
		}

		#medvill-load {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-our-patients-part3.part4 .item {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-footer-bottom {
			background: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-footer-inner {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-footer-inner .footer-section .btn-part form input[type='submit'] {
			background: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-footer-inner .footer-section .btn-part form input[type='email'] {
			border: 1px solid <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-footer-inner .footer-section .social-icon i {
			border: 1px solid <?= '#', get_site_setting('color_3') ?> !important;
			background: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-single-shop .tab-area ul.nav-tabs li a:hover,
		.rs-single-shop .tab-area ul.nav-tabs li a.active {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.alert-success {
			background-color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-footer-inner .footer-section .social-icon i:hover {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-inner-blog-part .widget-area .title-widget .title-part:before {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-inner-blog-part .widget-area .search-wrap button:hover {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		a:hover {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-inner-blog-part .widget-area .wap-column-part .chevron-right-icon li:after {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-team-inner-part-find-doctor-part .item-team-part .item-team-inner .normal-text .person-name a {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.full-width-header.personal-head .rs-header .menu-area.menu-sticky.sticky {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-menu .nav-menu>li>a {
			color: #f2faf0 !important;
		}

		.full-width-header .rs-header .menu-area .main-menu .rs-menu {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.full-width-header .rs-header .menu-area .main-menu .rs-menu .nav-menu li a {
			border-color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.full-width-header.personal-head .rs-header .menu-area .main-menu .rs-menu ul li a:hover,
		.full-width-header.personal-head .rs-header .menu-area .main-menu .rs-menu ul li.active a,
		.full-width-header.personal-head .rs-header .menu-area .main-menu .rs-menu ul li.current-menu-item>a {
			color: #ffffff !important;
		}

		.rs-menu ul ul {
			position: absolute;
			top: 100%;
			background-color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.full-width-header .rs-header .menu-area .main-menu .rs-menu .nav-menu li a {
			font-size: 16px;
			text-transform: uppercase;
			padding: 50px 0;
			font-weight: 500;
			color: #ffffff;
			transition: all 0.3s ease 0s;
		}

		.rs-menu ul ul li {
			border-bottom: 1px solid #fff;
		}

		button.btn.btn-success {
			color: white;
			background: <?= '#', get_site_setting('color_2') ?> !important;
			border-color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		.rs-portfolio-Detail.part3 .Appointment-table-wrap {
			padding: 40px 40px 44px;
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-portfolio-Detail.part3 .inner-images .ps-informations .single-title {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		span.rs-menu-parent {
			background: <?= '#', get_site_setting('color_2') ?> !important;
		}

		i.fa.fa-angle-up {
			color: white !important;
		}

		i.fa.fa-angle-down {
			color: white !important;
		}

		.rs-latest-part .item .blog-item .blog-full .blog-meta .title a:hover {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.klik-form {
			width: 96%;
			padding: 2px 5px;
		}

		a.link {
			color: <?= '#', get_site_setting('color_2') ?> !important;
		}

		.rs-portfolio-Detail.part3 .inner-images .ps-information2 .social-icon li a {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		/* Title Spesialis yang tersedia */
		.rs-quality-services-part .item-services .item .content-part .title a {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		/* NamaDokter */
		.rs-meet-with-doctor-part .item .team-inner .team-content .team-name a {
			color: <?= '#', get_site_setting('color_3') ?> !important;
		}

		/* Icon Bag Dokter */
		.rs-meet-with-doctor-part .item .team-inner .img-part .social-icon {
			background: <?= '#', get_site_setting('color_3') ?> !important;
			
		}

		/* Icon Social Dokter */
		.rs-meet-with-doctor-part .item .team-inner .img-part .social-icon a i {
			background: <?= '#', get_site_setting('color_3') ?> !important;
		}

		/* Logo Header Mobile */
		.full-width-header .rs-header .menu-area .main-menu .mobile-logo-part img {
			max-height: 100%;
		}

		thead {
			background: <?= '#', get_site_setting('color')?> !important;
		}

		/* Paernet color */
		.rs-partner-part.part1 {
			background:  <?= '#', get_site_setting('color')?> !important;
		}

		.rs-partner-part .images-part {
			background:  <?= '#', get_site_setting('color')?> !important;
		}

	</style>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "WebSite",
			"mainEntityOfPage": {
				"@type": "WebPage",
				"@id": "<?= current_url() ?>"
			},
			"headline": "<?= (!empty(@$post->title)) ? $post->title : get_site_setting('site_name') ?>",
			"image": {
				"@type": "ImageObject",
				"url": "<?= !(empty(@$post->img)) ? site_url('assets/uploads/' . $post->img) : base_url('assets/uploads/' . get_site_setting('site_icon')) ?>",
				"height": 800,
				"width": 800
			},
			"datePublished": "<?= !empty(@$post->created_on) ? date('c', strtotime(@$post->created_on)) : date('c') ?>",
			"dateModified": "<?= !empty(@$post->created_on) ? date('c', strtotime(@$post->created_on)) : date('c') ?>",
			"author": {
				"@type": "Person",
				"name": "<?= !empty(@$post->author) ? @$post->author : 'admin' ?>"
			},
			"publisher": {
				"@type": "Organization",
				"name": "<?= get_site_setting('site_name') ?>",
				"logo": {
					"@type": "ImageObject",
					"url": "<?= base_url('assets/uploads/' . get_site_setting('site_icon')) ?>",
					"width": 600,
					"height": 60
				}
			},
			"description": "<?= (!empty(@$post->content)) ? clear_string(@$post->content, 300) : get_site_setting('site_description'); ?>"
		}
	</script>

	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-K5GXD9X');
	</script>
	<div id="medvill-load">
		<div class="medvill-loader la-2x">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<div class="full-width-header personal-head">
		<div id="myModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<img src="<?= base_url('assets/site/yoosa/images/docsad.jpg') ?>" width="200px">
				<p class="text-warning-not-available" style="font-weight: bold;">Maaf, layanan ini belum tersedia</p>
				<p class="text-warning-not-available" style="line-height: 28px;">Karena belum terintegrasi dengan SIMRS KLIK Hospital</p>
			</div>
		</div>
		<div class="rs-toolbar-part">
			<div class="container">
				<div class="row rs-vertical-middle">
					<div class="col-lg-2 col-sm-3 col-md-4">
						<div class="logo-part">
							<a href="<?= site_url() ?>"><img src="<?= base_url('assets/uploads/' . get_site_setting('site_icon')) ?>" alt="logo"></a>
						</div>
					</div>
					<div class="col-lg-10 col-sm-9 col-md-8 mobile-menu-area">
						<ul class="rs-contact-info">
							<li class="contact-part">
								<i class="flaticon-call"></i>
								<span class="contact-info">
									<span>phone</span>
									<a style="color:black !important;" href="#"><?= get_site_setting('site_contact') ?></a>
								</span>
							</li>
							<li class="contact-part">
								<i class="flaticon-email"></i>
								<span class="contact-info">
									<span>E-mail</span>
									<a style="color:black !important;" href="#"> <?= get_site_setting('site_email') ?></a>
								</span>
							</li>
							<li class="contact-part">
								<i class="flaticon-location"></i>
								<span class="contact-info">
									<span>address</span>
									<?= substr(strip_tags(get_site_setting('site_address')), 0, 25) ?>
								</span>
							</li>
							<li class="contact-part no-border">
								<i class="flaticon-clock"></i>
								<span class="contact-info">
									<span>Opening Hours</span>
									<?= get_site_setting('site_open') ?>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<header id="rs-header" class="rs-header">
			<div class="menu-area menu-sticky" style="width: 100%; position: relativ; top: 0px; z-index: 2;">
				<div class="container">
					<div class="row rs-vertical-middle">
						<div class="col-lg-12">
							<div class="main-menu">
								<div class="mobile-logo-part">
									<img  style="width: 233px; height:66px;" src="<?= base_url('assets/uploads/' . get_site_setting('site_icon')) ?>" alt="logo">
								</div>
								<div class="mobile-menu">
									<a class="rs-menu-toggle"><i class="fa fa-bars"></i></a>
								</div>
								<nav class="rs-menu left-align-menu small-width">
									<ul class="nav-menu">
										<?= get_site_menus() ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>