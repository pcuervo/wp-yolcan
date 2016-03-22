<?php $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$post_page = 10;
$offset = ($pagina - 1) * $post_page;
$max_num_pages = recipesBySearchCount($_GET['search'], $post_page);

$recetas = recipesBySearch($_GET['search'], $post_page, $offset); ?>

<section class="[ container ][ margin-bottom ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<h4 class="[ inline-block ]">Resultados de busqueda:
				<span class="[ inline-block ][ color-primary ]"><?php echo $_GET['search']; ?></span>
			</h4>
		</div>
	</div>
</section>


<div id="content">
	<?php if (! empty($recetas) ): 
	
		foreach ($recetas as $post): 
		 	$url_img = attachment_image_url($post->ID, 'medium'); ?>

			<div class="[ box-content ]">
				<a href="<?php echo get_permalink($post->ID) ?>">
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php echo get_the_title($post->ID); ?></p>
				</a>
			</div>

		<?php endforeach;
	else:
		echo '<p>No se encontraron recetas con ese ingrediente</p>';
	endif; ?>
	
</div>
	

<!-- pagination -->
<section class="[ bg-gray ][ text-center ]">
	<?php if($max_num_pages > 1):
		$url = site_url('/recetas/?search='.$_GET['search']);
		pagenavi($pagina, $max_num_pages, $url, true, '&', 'pagina'); 
	else: ?>
		<div class="no-pagination">pag 1 de 1</div>
	<?php endif; ?>

</section>