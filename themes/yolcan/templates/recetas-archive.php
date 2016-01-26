<?php global $wp_query; 
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;?>
<div id="content">
	<?php if ( have_posts() ) : 
		while( have_posts() ) : the_post(); 
		 	$url_img = attachment_image_url($post->ID, 'medium'); ?>

			<div class="[ box-content ]">
				<a href="<?php the_permalink() ?>">
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php the_title(); ?></p>
				</a>
			</div>

		<?php endwhile;
	endif; ?>
	
</div>

<!-- pagination -->
<section class="[ bg-gray ][ text-center ]">
	<?php if($wp_query->max_num_pages > 1):
		$url = site_url('/recetas/');
		pagenavi('', $wp_query->max_num_pages, $url, true); 
	else: ?>
		<div class="no-pagination">pag 1 de 1</div>
	<?php endif; ?>

</section>