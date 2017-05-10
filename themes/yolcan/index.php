<?php get_header();

if( isset( $result['success'] ) ): ?>
	<br>
	<br>
	<br>
	<div class="[ bg-success btn-lg text-center ]"><?php echo $result['success']; ?></div>
<?php endif;  ?>

	<div class="[ container ]">
		<!-- video	-->
		<div id="home-slider" class="carousel slide [ margin-bottom--large margin-top ]" data-ride="carousel" >
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="<?php echo THEMEPATH; ?>images/4.jpeg" alt="imagen slider">
				</div>
				<div class="item">
					<img src="<?php echo THEMEPATH; ?>images/2.jpg" alt="imagen slider">
				</div>
				<div class="item">
					<div class="embed-responsive embed-responsive-4by3">
						<iframe id="video-slider" src="//www.youtube.com/embed/HCj_EUKAis4?rel=0" frameborder="0" allowfullscreen></iframe>
						<a id="play-video" href="#"></a>
					</div>
				</div>
			</div>


			<!-- Left and right controls -->
			<a class="left carousel-control" href="#home-slider" role="button" data-slide="prev">
				<img class="[ svg ][ icon icon--iconed icon--stroke icon--thickness-3 ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/arrow-left-12.svg" alt="icono izquierda">
			</a>
			<a class="right carousel-control" href="#home-slider" role="button" data-slide="next">
				<img class="[ svg ][ icon icon--iconed icon--stroke icon--thickness-3 ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/arrow-right-12.svg" alt="derecha">
			</a>
		</div>

		<section class="[ row ]">

			<?php
				$CTACanastas = get_page_by_path('cta-canastas');
				$CTAVisitanos = get_page_by_path('cta-visitanos');

				$CTACanastasID = $CTACanastas->ID;
				$CTAVisitanosID = $CTAVisitanos->ID;

				$CTACanastasIMGID = get_post_thumbnail_id($CTACanastasID);
				$CTAVisitanosIMGID = get_post_thumbnail_id($CTAVisitanosID);

				$CTACanastasURL = wp_get_attachment_url( $CTACanastasIMGID, 'full' );
				$CTAVisitanosURL = wp_get_attachment_url( $CTAVisitanosIMGID, 'full' );

			?>

			<!-- banner	desktop -->
			<article class="[ col-sm-6 ]">
				<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ]" style="background-image: url('<?php echo $CTACanastasURL; ?>');">
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
				<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ]" style="background-image: url('<?php echo $CTAVisitanosURL; ?>');">
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

	<section class="[ bg-gray-lighter ]">
		<div class="[ container ]">
			<h2 class="[ text-center ][ margin-top margin-bottom--large ]">Estos son los tres sencillos pasos para obtener tu canasta</h2>
			<div class="[ row ]">
				<div class="[ col-xs-12 col-sm-3 ][ margin-bottom--xlarge ]">
					<div class="[ text-center ]">
						<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/tool-gardening.svg"  alt="icono jardinería">
						<h3 class="[ color-secondary ]">Escoge el club más cercano</h3>
					</div>
					<div class="[ margin-bottom--large ][ text-center ]">
						<h4>
							<?php $clubes = getClubesDeConsumo();
							if (!empty($clubes)):
								$total = count($clubes) - 1;
								foreach ($clubes as $key => $club) :
									echo $total == $key ? $club->post_title : $club->post_title.' - ';
								endforeach;
							endif;?>

						</h4>
					</div>
					<div class="[ text-center ]">
						<h3 class="[ color-secondary ]">O crea uno en tu casa u oficina</h3>
						<button data-toggle="modal" data-target="#club-consumo" class="[ btn btn-secondary ][ normal-wrap ]">crea un club de consumo</button>
					</div>
				</div>
				<div class="[ col-xs-12 col-sm-6 ][ text-center ]">
					<div class="">
						<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/basket.svg"  alt="icono canasta">
						<h3 class="[ color-secondary ]">Escoge el tamaño de tu canasta</h3>
					</div>
					<div class="[ row ]">
						<?php $args = array(
	                        'post_type' => 'product',
	                        'posts_per_page' => 12,
	                        'tax_query' => array(
		                        array(
		                            'taxonomy' => 'product_cat',
		                            'field'    => 'slug',
		                            'terms'    => 'canastas',
		                        ),
		                    ),
		                    'orderby' => 'date',
	                        'order' => 'ASC'
	                    );
                		$productos = new WP_Query( $args );

		                if ( $productos->have_posts() ):

		                    while ( $productos->have_posts() ) : $productos->the_post(); ?>
								<div class="[ card ][ col-xs-12 ][ margin-bottom ]">
									<div class="[ card__header ]">
										<h4 class="[ text-center ][ color-primary ]"><?php the_title(); ?></h4>
										<p class="[ no-margin ]"><?php echo get_post_meta($post->ID, 'approximate_weight', true); ?></p>
										<?php echo $post->post_excerpt; ?>
									</div>
								</div>
							<?php endwhile;

		                else:
		                        echo __( 'No hay canastas' );
		                endif;
		                wp_reset_postdata();?>
					</div>
				</div>
				<div class="[ col-xs-12 col-sm-3 ][ margin-bottom--large ]">
					<div class="[ text-center ]">
						<img class="[ margin-bottom--large ][ svg ][ icon icon--iconed--xxxlarge icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/box-1.svg"  alt="icono caja">
						<h3 class="[ color-secondary ]">Recoge tu canasta y disfruta</h3>
						<a  href="<?php echo site_url('/nuestros-productos/'); ?>" ><button class="[ btn btn-secondary ]">comprar ahora</button></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="[ container ]">

		<div class="row">
			<div class="[ col-xs-12 ]">
				<h2>Instagram</h2>
			</div>
			<div class="[ col-xs-12 ]">
				<div class="row">
					<?php $feed = feedInstagram('yolcan', 3);
					if (!empty($feed)):
						foreach ($feed as $key => $data): ?>
							<div class="[ col-sm-3 ]">
								<img src="<?php echo $data['media']; ?>" alt="imagen destacada" class="img-thumbnail">
								<p class="autor">Por: <?php echo $data['user_name']; ?></p>
								<p><?php echo $data['text']; ?></p>
							</div>
						<?php endforeach;
					endif; ?>
				</div>
			</div>
		</div>
	</section>

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
				<div id="map_canvas" class="mapping" style="width: 100%; height: 215px;"></div>

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
								<img class="[ margin-top ][ icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]" src="<?php echo $url_img; ?>" alt="imagen destacada">
								<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i><?php the_title(); ?></i></h3>
							</div>
							<?php the_content(); ?>
						</div>
					<?php endwhile;
				endif; ?>

			</div>
		</div>
	</section>

	<!-- Consumir local -->
	<?php get_template_part('templates/consumir', 'local'); ?>

<?php get_footer(); ?>