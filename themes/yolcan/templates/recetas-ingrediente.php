<?php $args = array('name' => $_GET['ingrediente'], 'post_type' => 'ingredientes', 'post_status' => 'publish', 'numberposts' => 1);

$my_posts = get_posts($args);
if( $my_posts ) :
	$recetas = recipesByIngredient($my_posts[0]->ID); ?>

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
		<ul class="[ pagination ][ no-margin ]">

			<li>
				<a href="#">
					<img class="[ svg icon--iconed--small icon--stoke icon--thickness-3 ][ color-dark ]" src="<?php echo THEMEPATH; ?>images/icons/arrow-left-12.svg">
				</a>
			</li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">...</a></li>
			<li><a href="#">11</a></li>
			<li><a href="#">12</a></li>
			<li><a href="#">13</a></li>
			<li>
				<a href="#">
					<img class="[ svg icon--iconed--small icon--stoke icon--thickness-3 ][ color-dark ]" src="<?php echo THEMEPATH; ?>images/icons/arrow-right-12.svg">
				</a>
			</li>
		</ul>
	</section>
<?php else:
	echo '<p>No se encontraron recetas con ese ingrediente</p>';
endif; ?>