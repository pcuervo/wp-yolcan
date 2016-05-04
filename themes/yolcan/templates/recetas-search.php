<?php $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$post_page = 10;
$offset = ($pagina - 1) * $post_page;
$max_num_pages = recipesBySearchCount($_GET['search'], $post_page);
$recetas = recipesBySearch($_GET['search'], $post_page, $offset); ?>

<h4>Resultados de busqueda: <span class="[ inline-block ][ color-primary ]"><?php echo $_GET['search']; ?></span></h4>

<?php if (! empty($recetas) ): ?>
	<div class="[ row ]">
		<?php foreach ($recetas as $post):
		 	$url_img = attachment_image_url($post->ID, 'medium'); ?>

			<div class="[ box-content ][ box-content ][ col-xs-6 col-sm-4 col-lg-3 ]">
				<a href="<?php echo get_permalink($post->ID) ?>">
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php echo get_the_title($post->ID); ?></p>
				</a>
			</div>

		<?php endforeach; ?>
	</div>
<?php else:
	echo '<p>No se encontraron recetas con ese ingrediente</p>';
endif; ?>