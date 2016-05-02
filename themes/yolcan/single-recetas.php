<?php
get_header();
the_post();
$no_id = $post->ID;
?>

<section class="[ container ]">
	<div class="[ margin-top ]">
		<a href="<?php echo site_url('/recetas/'); ?>" class="[ underline ][ color-secondary ]"><em>ver todas las recetas</em></a>
	</div>
	<div class="[ row ][ margin-bottom ]">
		<div class="[ col-xs-12 col-sm-8 col-sm-offset-2 ]">
			<h2 class=""><strong><?php the_title(); ?></strong></h2>
			<?php $url_img = attachment_image_url($post->ID, 'large'); ?>
			<img class="[ img-responsive ][ margin-bottom ]" src="<?php echo $url_img; ?>">
			<div class="[ row ]">
				<div class="[ col-xs-4 padding--right--small ][ text-center ]">
					<div class="[ bg-gray-dark ][ padding--top-bottom--small ]">
						<img class="[ svg icon--stroke icon--iconed--xlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/alarm-clock.svg">
					</div>
					<div class="[ bg-gray ][ padding--top-bottom--small ][ fact fz-18 ]"><?php echo get_post_meta($post->ID, 'tiempo_preparacion', true); ?></div>
				</div>
				<div class="[ col-xs-4 padding--sides--xsmall ][ text-center ]">
					<div class="[ bg-gray-dark ][ padding--top-bottom--small ]">
						<img class="[ svg icon--stroke icon--iconed--xlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/food-dome.svg">
					</div>
					<div class="[ bg-gray ][ padding--top-bottom--small ][ fact fz-18 ]"><?php echo get_post_meta($post->ID, 'numero_personas', true); ?></div>
				</div>
				<div class="[ col-xs-4 padding--left--small ][ text-center ]">
					<div class="[ bg-gray-dark ][ padding--top-bottom--small ]">
						<img class="[ svg icon--stroke icon--iconed--xlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/phone-signal-high.svg">
					</div>
					<div class="[ bg-gray ][ padding--top-bottom--small ][ fact fz-18 ]"><?php echo get_post_meta($post->ID, 'nivel_de_preparacion', true); ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-6 ]">
			<p class="[ fz-large ][ text-center ][ margin-top ]"><em><strong>Ingredientes</strong></em></p>
			<?php the_content(); ?>
		</div>

		<div class="[ col-xs-12 col-sm-6 ]">
			<p class="[ fz-large ][ text-center ][ margin-top ]"><em><strong>Preparación</strong></em></p>
			<?php echo get_post_meta($post->ID, 'pasos_preparacion', true); ?>
		</div>
	</div>

	<?php
	$recetas = new WP_Query( array('posts_per_page' => 5, 'post_type' => array( 'recetas' ), 'post__not_in' => array($no_id),'orderby' => 'rand' ) );
	if ( $recetas->have_posts() ) :
	?>
		<div class="[ row ]">
			<div class="[ col-xs-12 ]">
				<p class="[ fz-large ][ text-center ][ margin-top ]"><em><strong>Más recetas para ti</strong></em></p>
				<div id="content">

					<?php while ( $recetas->have_posts() ) :
						$recetas->the_post();
						$url_img = attachment_image_url($post->ID, 'medium');?>
						<div class="[ box-content ]">
							<a href="<?php the_permalink() ?>">
								<img alt="" src="<?php echo $url_img; ?>">
								<p class=""><?php the_title(); ?></p>
							</a>
						</div>

					<?php endwhile; ?>


				</div>
			</div>
		</div>
	<?php endif; ?>
</section>

<?php get_footer(); ?>