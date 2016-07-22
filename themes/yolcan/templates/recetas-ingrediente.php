<?php $args = array('name' => $_GET['ingrediente'], 'post_type' => 'ingredientes', 'post_status' => 'publish', 'numberposts' => 1);

$my_posts = get_posts($args);
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if( $my_posts ) :
	$post_page = 1;
	$offset = ($pagina - 1) * $post_page;
	$max_num_pages = recipesByIngredientCount($my_posts[0]->ID, $post_page);
	$recetas = recipesByIngredient($my_posts[0]->ID, $post_page, $offset ); ?>

	<section class="[ container ][ margin-bottom ]">
		<div class="[ row ]">
			<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
				<h4 class="[ inline-block ]">Recetas con:
					<span class="[ inline-block ][ color-primary ]"><?php echo $my_posts[0]->post_title; ?></span>
				</h4>
			</div>
		</div>
	</section>


	<div id="content">
        <div class="[ container ]">
            <div class="[ row ]">
		<?php if (! empty($recetas) ):
			foreach ($recetas as $post):
			 	$url_img = attachment_image_url($post->ID, 'medium'); ?>

				<div>
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
        </div>
	</div>

<?php else:
	echo '<p>No se encontraron recetas con ese ingrediente</p>';
endif; ?>