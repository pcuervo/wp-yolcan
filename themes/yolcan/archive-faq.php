<?php get_header(); ?>

	<div class="[ container ]">
		<section class="[ margin-bottom ]">
			<h1 class="[ h2 text-center ]">Preguntas frecuentes</h1>
			<div class="[ row ]">
				<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
					<?php if ( have_posts() ) :
						$count = 1;
						while( have_posts() ) : the_post();
						 	$url_img = attachment_image_url($post->ID, 'medium');
						 	$open = $count == 1 ? 'in' : ''; ?>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#collapse<?php echo $count; ?>" class="[ no-decoration ][ color-dark ]"><h3 class="[ no-margin ][ color-primary-darken--hover ]"><span class="[ color-primary ]"><strong><?php echo $count; ?>.</strong></span><?php the_title(); ?></h3></a>
								<div id="collapse<?php echo $count; ?>" class="[ panel-collapse collapse <?php echo $open; ?> ][ padding--top--small ]"><?php the_content(); ?></div>
							</div>
							<?php $count++;
						endwhile;
					endif; ?>

				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>