<?php get_header();
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$post_page = 8;
$offset = $post_page * ($pagina - 1);
$blog = new WP_Query( array('posts_per_page' => $post_page, 'post_type' => array( 'post' ), 'offset' => $offset ) );?>

	<section class="[ container ]">
		<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
		<div class="[ row ][ margin-bottom--large ]">
			<!--  Entradas Blog -->

			<?php
			if ( $blog->have_posts() ) :
				while ( $blog->have_posts() ) :
					$blog->the_post();
					$url_img = attachment_image_url($post->ID, 'img_blog'); ?>

					<article class="[ col-xs-12 col-sm-6 col-md-3 ]">
						<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
						<a href="<?php the_permalink() ?>"><img class="[ img-responsive ]" src="<?php echo $url_img; ?>"></a>
						<hr>
						<p><?php echo wp_trim_words( get_the_excerpt(), 25 ) ?></p>
						<div class="[ padding--bottom ][ text-right ]">
							<a href="<?php the_permalink() ?>" class="[ color-secondary ][ ]"><em>Leer más >></em></a>
						</div>
					</article>

				<?php endwhile;
			endif; ?>

		</div><!-- /row -->

	</section> <!-- /container -->

	<!-- pagination -->
	<div class="[ bg-gray ][ text-center ][ padding--top-bottom ]">
		<?php if($blog->max_num_pages > 1):
			$url = site_url('/blog/');
			pagenavi($pagina,$blog->max_num_pages, $url, true, '?', 'pagina');

		else: ?>
			<div class="no-pagination">pag 1 de 1</div>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>