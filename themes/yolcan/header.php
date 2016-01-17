<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<!-- Sets initial viewport load and disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SEO -->
		<meta name="keywords" content="">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<!-- Compatibility -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">
		<!-- Favicon - generated with http://www.favicomatic.com/ -->
		<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>images/favicon.ico">
		<!-- CSS -->
		<!-- Google font(s) -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
		<!-- Font awesome -->
		<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

		<?php wp_head(); ?>

		<!-- Typekit -->
		<script src="https://use.typekit.net/upn0scl.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
	</head>

	<body>
		<header class="[ bg-light ]">
			<div class=" [ container ] ">
				<div class="[ row ]">
					<div class="[ col-xs-6 ]">
						<h1 class="[ no-margin-top-bottom ]">
							<a title="Yolcan" href="<?php echo site_url('/'); ?>" id="logo">
								<span class="[ hidden ]">Yolcan</span>
								<img class="[ width-logo ]" alt="Yolcan" src="<?php echo THEMEPATH; ?>images/logo.svg">
							</a>
						</h1>
					</div>
					<div class="[ col-xs-6 inherit ][ visible-xs ][ margin-top--small ][ text-right ]">
						<div class="[ inline-block ]">
							<a data-toggle="modal" data-target="#menu-info">
								<img class="[ svg ][ icon icon--iconed--large icon--stroke ][ color-primary ]"src="<?php echo THEMEPATH; ?>images/icons/infomation-circle.svg">
							</a>
							<div id="menu-info" class="[ modal fade ]" role="dialog">
								<div class="[ modal-dialog ]">

									<div class="[ modal-content height-auto ][ color-light ]">
										<div class="modal-header">
											<button type="button" class="[ close ][ relative top-23 right-55 ]" data-dismiss="modal">
												<img class="[ svg ][ icon icon--iconed--medium icon--stroke ][ color-primary ]"src="<?php echo THEMEPATH; ?>images/icons/close.svg">
											</button>
										</div>
										<div class="[ no-margin ][ modal-body ][ bg-ligth ][ padding--top--large ][ text-center ]">
											<ul class="[ no-padding ]">
												<li><a data-toggle="modal" data-target="#ingresa">ingresa</a></li>
												<li><a href="perfil.html">tu perfil</a></li>
												<li><a href="cuenta.html">tu suscripción</a></li>
												<li><a href="faq.html">faq</a></li>
												<li><a href="blog.html">blog</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="[ inline-block relative top-3 ][ margin-left--xsmall ]">
							<a data-toggle="modal" data-target="#main-menu">
								<img class="[ svg ][ icon icon--iconed--large icon--stroke ][ color-primary ]"src="<?php echo THEMEPATH; ?>images/icons/navigation.svg">
							</a>
							<div id="main-menu" class="[ modal fade ]" role="dialog">
								<div class="[ modal-dialog ]">
									<div class="[ modal-content height-auto ][ color-light ]">
										<div class="modal-header">
											<button type="button" class="[ close ][ relative top-23 right-14 ]" data-dismiss="modal">
												<img class="[ svg ][ icon icon--iconed--medium icon--stroke ][ color-primary ]"src="<?php echo THEMEPATH; ?>images/icons/close.svg">
											</button>
										</div>
										<div class="[ no-margin ][ modal-body ][ bg-ligth ][ padding--top--large ][ text-center ]">
											<ul class="[ padding ]">
												<li><a class="[ margin-bottom ][ text-uppercase ][ border-bottom--orange ]" href="<?php echo site_url('/nuestros-productos/'); ?>"><strong>Productos</strong></a></li>
												<li><a class="[ margin-bottom ][ text-uppercase ][ border-bottom--green ]" href="<?php echo site_url('/conocenos/'); ?>"><strong>Conócenos</strong></a></li>
												<li><a class="[ margin-bottom ][ text-uppercase ][ border-bottom--blue ]" href="recetas.html"><strong>Recetas</strong></a></li>
												<li><a class="[ margin-bottom ][ text-uppercase ][ border-bottom--pink ]" href="visitanos.html"><strong>Visitas</strong></a></li>
												<li><a class="[ margin-bottom ][ text-uppercase ][ border-bottom--secondary ]" href="contactanos.html"><strong>Contáctanos</strong></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- info-menu desktop -->
					<div class="[ pull-right ][ hidden-xs ][ margin-top ][ padding--sides--xsmall ]">
						<a class="[ color-primary-darken ][ info-menu ]" data-toggle="modal" data-target="#ingresa">ingresa</a>
						<a class="[ color-primary-darken ][ info-menu ]" href="perfil.html">tu perfil</a>
						<a class="[ color-primary-darken ][ info-menu ]" href="cuenta.html">tu suscripción</a>
						<a class="[ color-primary-darken ][ info-menu ]" href="faq.html">faq</a>
						<a class="[ color-primary-darken ][ info-menu ]" href="blog.html">blog</a>
					</div>
				</div>
				<!-- menu desktop -->
				<nav class="[ row ][ hidden-xs ]" >
					<div class="[ col-sm-12 ]">
						<a class="[ color-primary-darken ][ width-20 ][ padding--right--xsmall ][ text-uppercase ][  ][ inline-block ]" href="<?php echo site_url('/nuestros-productos/'); ?>"><div class="[ border-bottom--orange ]">Productos</div>
						</a><a class="[ color-primary-darken ][ width-20 ][ padding--right--xsmall ][ text-uppercase ][ inline-block ]" href="<?php echo site_url('/conocenos/'); ?>"><div class="[ border-bottom--green ]">Conócenos</div>
						</a><a class="[ color-primary-darken ][ width-20 ][ padding--right--xsmall ][ text-uppercase ][ inline-block ]" href="recetas.html"><div class="[ border-bottom--blue ]">Recetas</div>
						</a><a class="[ color-primary-darken ][ width-20 ][ padding--right--xsmall ][ text-uppercase ][ inline-block ]" href="visitanos.html"><div class="[ border-bottom--pink ]">Visitas</div>
						</a><a class="[ color-primary-darken ][ width-20 ][ text-uppercase ][ inline-block ]" href="contactanos.html"><div class="[ border-bottom--secondary ]">Contáctanos</div></a>
					</div>
				</nav>
			</div> <!-- /container -->
		</header>