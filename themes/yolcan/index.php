<?php get_header(); ?>

	<div class="[ container ]">
		<!-- video	-->
		<section class="[ row ]">
			<div class="[ col-xs-12 ][ margin-bottom--large ]">
				<div class="[ js-video-wrapper ]">
					<iframe class="[ embed-responsive-item ]" src="https://www.youtube.com/embed/HCj_EUKAis4" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="[ col-xs-12 ]">
				<h2 class="[ text-center ][ no-margin ][ ff-bree-serif ]"><em>Calidad de origen chinampero</em></h2>
			</div>
		</section>

		<section class="[ row ]">
			<!-- banner	desktop -->
			<article class="[ col-sm-6 ]">
				<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ]" style="background-image: url('<?php echo THEMEPATH; ?>images/IMG_1023.jpg');">
					<h2>Canastas de verduras y frutas organicas a domicilio</h2>
					<div class="[ btn-absolute-bottom ]">
						<div class="[ text-center ]" >
							<?php if ( ! is_user_logged_in() ){ ?>
								<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ]">únete</button></a>
							<?php } ?>
							<a href="<?php echo site_url('/conocenos/') ?>" ><button class="[ btn btn-primary-darken ]">¿cómo funciona?</button></a>
						</div>
					</div>
				</div>
			</article>
			<article class="[ col-sm-6 ]">
				<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ]" style="background-image: url('<?php echo THEMEPATH; ?>images/_DSC0010.jpg');">
					<h2>Conoce como se cosechan nuestros productos y a quienes los producen</h2>
					<div class="[ text-center ]" >
						<div class="[ btn-absolute-bottom ]">
							<a href="<?php echo site_url('/visitanos/') ?>" ><button class="[ btn btn-secondary ]">visítanos</button></a>
						</div>
					</div>
				</div>
			</article>
		</section>
		<!-- entradas -->

		<section class="[ row ]">
			<article class="[ col-xs-12 ][ col-sm-4 ]">
				<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'post' ), 'orderby' => 'rand' ) );

				if ( $entrada->have_posts() ) :
					while ( $entrada->have_posts() ) :
						$entrada->the_post();
						$url_img = attachment_image_url($post->ID, 'large'); ?>

						<a href="<?php the_permalink() ?>">
							<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
								<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
							</div>
						</a>
					<?php endwhile;
				endif; ?>

			</article>
			<article class="[ col-xs-12 ][ col-sm-4 ]">
				<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'recetas' ), 'orderby' => 'rand' ) );

				if ( $entrada->have_posts() ) :
					while ( $entrada->have_posts() ) :
						$entrada->the_post();
						$url_img = attachment_image_url($post->ID, 'large'); ?>

						<a href="<?php the_permalink() ?>">
							<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
								<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
							</div>
						</a>
					<?php endwhile;
				endif; ?>

			</article>
			<article class="[ col-xs-12 ][ col-sm-4 ]">
				<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'ingredientes' ), 'orderby' => 'rand' ) );

				if ( $entrada->have_posts() ) :
					while ( $entrada->have_posts() ) :
						$entrada->the_post();
						$url_img = attachment_image_url($post->ID, 'large'); ?>

						<a href="<?php echo site_url('/recetas/').'?ingrediente='.$post->post_name; ?>">
							<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
								<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
							</div>
						</a>
					<?php endwhile;
				endif; ?>
			</article>
		</section>

	</div> <!--/container-->

	<section class="[ container ]">
		<h2 class="[ text-center ][ margin-top margin-bottom--large ]">Estos son los tres sencillos pasos para obtener tu canasta</h2>
		<div class="[ row ]">
			<div class="[ col-xs-12 col-sm-3 ][ margin-bottom--xlarge ]">
				<div class="[ text-center ]">
					<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/tool-gardening.svg">
					<h3 class="[ color-secondary ]">Escoge el club más cercano</h3>
				</div>
				<div class="[ margin-bottom--large ][ text-center ]">
					<h4>Las Lomas - Condesa - Roma - San Miguel Chapultepec - Bosques - Anzures - Polanco - Jardines del Pedregal</h4>
				</div>
				<div class="[ text-center ]">
					<h3 class="[ color-secondary ]">O crea uno en tu casa u oficina</h3>
					<a data-toggle="modal" data-target="#club-consumo" ><button class="[ btn btn-secondary ]">crea un club de consumo</button></a>
				</div>
			</div>
			<div class="[ col-xs-12 col-sm-6 ][ text-center ]">
				<div class="">
					<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/basket.svg">
					<h3 class="[ color-secondary ]">Escoge el tamaño de tu canasta</h3>
				</div>
				<div class="[ row ]">
					<div class="[ col-xs-12 col-md-6 col-md-offset-3 ][ margin-bottom--large ]">
						<h4 class="[ text-center ][ color-primary ]">Media Canasta</h4>
						<p class="[ no-margin ]">3-4.5 KG</p>
						<p>Ensalada Gourmet (200 gr.)</p>
						<p><strong class="[ color-primary ]">$250</strong> semanales</p>
					</div>
					<div class="[ col-xs-12 col-md-6 col-md-offset-3 ][ margin-bottom--large ]">
						<h4 class="[ text-center ][ color-primary ]">Canasta Completa</h4>
						<p class="[ no-margin ]">4.5-6.5 KG</p>
						<p>Ensalada Gourmet (300 gr.)</p>
						<p><strong class="[ color-primary ]">$375</strong> semanales</p>
					</div>
					<div class="[ col-xs-12 col-md-6 col-md-offset-3 ][ margin-bottom ]">
						<h4 class="[ text-center ][ color-primary ]">Canasta Familiar</h4>
						<p class="[ no-margin ]">6.5-8.5 KG</p>
						<p>Ensalada Gourmet (500 gr.)</p>
						<p><strong class="[ color-primary ]">$500</strong> semanales</p>
					</div>
				</div>
			</div>
			<div class="[ col-xs-12 col-sm-3 ][ margin-bottom--large ]">
				<div class="[ text-center ]">
					<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/box-1.svg">
					<h3 class="[ color-secondary ]">Recoge tu canasta y disfruta</h3>
					<a  href="<?php echo site_url('/nuestros-productos/'); ?>" ><button class="[ btn btn-secondary ]">comprar ahora</button></a>
				</div>
			</div>
		</div>
	</section>

	<!-- Consumir local -->
	<?php get_template_part('templates/consumir', 'local'); ?>

	<section class="[ container ]">
		<div class="row">
			<div class="[ col-xs-12 ]">
				<h2>Clubes de consumo</h2>
			</div>
			<div class="[ col-xs-12 col-sm-5 ]">
				<div class="[ margin-bottom ]">
					<?php $cc = get_page_by_path('informacion-clubes-de-consumo');
					echo wpautop($cc->post_content); ?>
				</div>
				<div class="[  ][ hidden-xs ]">
					<?php if ( ! is_user_logged_in() ){ ?>
						<div class="[ text-center ]">
							<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ][ margin-top-bottom padding ]">únete</button></a>
						</div>
					<?php } ?>
					<p>Si quieres armar un nuevo club de consumo, haz
						<a data-toggle="modal" data-target="#club-consumo"  class="[ color-primary-darken ]"><i><u>click aquí</u></i></a>
					</p>
				</div>
			</div>
			<div class="[ col-xs-12 col-sm-7 ]">
				<!-- <div id="map_canvas" class="mapping" style="width: 100%; height: 215px;"></div> -->
				<div class="map-wrap">
					<div class="overlay" onClick="style.pointerEvents='none'"></div><!-- wrap map iframe to turn off mouse scroll and turn it back on on click -->
					<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120545.72417001169!2d-99.15076015455304!3d19.23648343297052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce038c6de8dea3%3A0x9b79f71fdabd5384!2sXochimilco%2C+D.F.!5e0!3m2!1ses!2smx!4v1450738593739" width="100%" height="215px" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				</div>
			<div class="[ col-xs-12 ][ visible-xs ]">
				<?php if ( ! is_user_logged_in() ){ ?>
					<div class="[ text-center ]">
						<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ][ margin-top-bottom ]">únete</button></a>
					</div>
				<?php } ?>
				<p class="[ color-gray-xlight ]">Si quieres armar un nuevo club de consumo, haz
					<a data-toggle="modal" data-target="#club-consumo" class="[ color-gray-xlight ]"><i><u>click aquí</u></i></a>
				</p>
			</div>
		</div>
	</section>
	<!--Clubes de consumo-->


	<section class="[ bg-secondary ][ margin-top ]">
		<div class="[ container ]">
			<div class="[ row ][ color-light ][ padding-bottom--large ]">
				<div class="[ col-xs-12 ]">
					<h2>Beneficios</h2>
				</div>
				<?php $entrada = new WP_Query( array('posts_per_page' => 4, 'post_type' => array( 'beneficios' ) ) );

				if ( $entrada->have_posts() ) :
					while ( $entrada->have_posts() ) :
						$entrada->the_post();
						$url_img = attachment_image_url($post->ID, 'full'); ?>

						<div class="[ col-xs-12 col-md-3 ][ margin-bottom ]">
							<div class="[ text-center ]">
								<img class="[ margin-top ][ icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]" src="<?php echo $url_img; ?>">
								<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i><?php the_title(); ?></i></h3>
							</div>
							<?php the_content(); ?>
						</div>
					<?php endwhile;
				endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>