<?php get_header(); 
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 
$post_page = 8;
$offset = $post_page * ($pagina - 1);
$blog = new WP_Query( array('posts_per_page' => $post_page, 'post_type' => array( 'post' ), 'offset' => $offset ) );?>

<div class="[ container ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 ]">
			<h2>Blog</h2>
		</div>
	</div>
	<div class="[ row ][ margin-bottom--large ]">
		<!--  Entradas Blog -->

		<?php 
		if ( $blog->have_posts() ) :
			while ( $blog->have_posts() ) : 
				$blog->the_post();
				$url_img = attachment_image_url($post->ID, 'img_blog'); ?>

				<div class="[ col-xs-12 col-sm-6 col-md-3 ]">
					<div class="[ user-content-blog ]">
						<article>
							<a href="<?php the_permalink() ?>"><h5><?php the_title(); ?></h5></a>
							<a href="<?php the_permalink() ?>"><img src="<?php echo $url_img; ?>"></a>
							<hr>
							<p>
								<?php echo wp_trim_words( get_the_excerpt(), 25 ) ?>
							</p>
							<div class="[ padding--bottom ][ text-right ]">
								<a href="<?php the_permalink() ?>" class="[ color-secondary ][ ]"><em>Leer más >></em></a>
							</div>
						</article>
					</div>
				</div>

			<?php endwhile;
		endif; ?>

	</div><!-- /row -->

</div> <!-- /container -->

<!-- pagination -->
<section class="[ bg-gray ][ text-center ]">
	<?php if($blog->max_num_pages > 1):
		$url = site_url('/blog/');
		pagenavi($pagina,$blog->max_num_pages, $url, true, '?', 'pagina'); 
		
	else: ?>
		<div class="no-pagination">pag 1 de 1</div>
	<?php endif; ?>
</section>

<?php get_footer(); ?>