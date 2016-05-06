<?php get_header();
the_post(); ?>

	<section class="">
		<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
		<div class="[ container ][ text-center ]">
			<h3 class=""><em>Calidad de origen chinampero</em></h3>
			<div class="[ row ]">
				<article class="[ visible-md visible-lg ][ col-md-1 col-lg-1 ]"></article>
				<article class="[ col-xs-6 col-sm-4 col-md-2 ]">
					<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/sign-reuse.svg">
					<h5 class="[  text-semibold ]">Agricultura sustentable</h5>
				</article>
				<article class="[ col-xs-6 col-sm-4 col-md-2 ]">
					<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke icon--thickness-05 icon--fill ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/network-cash.svg">
					<h5 class="[  text-semibold ]">Economía local</h5>
					<div class="[ visible-xs ][ margin-bottom--large ]"></div>
				</article>
				<article class="[ col-xs-6 col-sm-4 col-md-2 ]">
					<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/eco-tag.svg">
					<h5 class="[  text-semibold ]">Consumo ecológicamente responsable</h5>
				</article>
				<article class="[ col-xs-6 col-sm-4 col-sm-offset-1  col-md-2 col-md-offset-0 ]">
					<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/sign-recycle.svg">
					<h5 class="[  text-semibold ]">Rescate de la reserva de Cuemanco, Xochimilco</h5>
					<div class="[ visible-xs ][ margin-bottom--large ]"></div>
				</article>
				<article class="[ col-xs-10 col-xs-offset-1  col-sm-4 col-sm-offset-1  col-md-2 col-md-offset-0 ]">
					<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/tool-gardening.svg">
					<h5 class="[  text-semibold ]">Comercio justo y apoyo a los agricultores locales</h5>
				</article>
			</div>
		</div>
	</section>

	<section class="[ container ][ text-center ]">
		<h3 class=""><em>¿Qué ofrecemos?</em></h3>
		<div class="[ row ]">
			<article class="[ col-xs-12 col-sm-6 col-md-4 col-md-offset-2 ]">
				<img class="[ svg icon--iconed--xxxlarge icon--thickness-1 icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/basket.svg">
				<p class="[ text-left ]">Canastas con productos orgánicos de temporada. son frutas y verduras orgánicas, producidos por Yolcan y su red de pequeños productores.</p>
				<a data-toggle="modal" data-target="#unete" class="[ btn btn-secondary ][ margin-bottom ]">únete</a>
			</article>
			<article class="[ col-xs-12 col-sm-6 col-md-4 ]">
				<img class="[ svg icon--iconed--xxxlarge icon--thickness-1 icon--stoke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/chinampa.svg">
				<p class="[ text-left ]">Canastas con productos orgánicos de temporada. son frutas y verduras orgánicas, producidos por Yolcan y su red de pequeños productores.</p>
				<div class="[ col-xs-12 ]">
					<a href="<?php echo site_url('/visitanos/') ?>" class="[ btn btn-secondary ][ margin-bottom ]">visítanos</a>
				</div>
			</article>
		</div>
	</section>

	<!-- Consumir local -->
	<?php get_template_part('templates/consumir', 'local');

get_footer(); ?>