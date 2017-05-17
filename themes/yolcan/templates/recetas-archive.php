<?php
global $wp_query;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;?>

<?php if ( have_posts() ) : ?>
	<div class="[ row ] grid">
		<?php while( have_posts() ) : the_post();
			$url_img = attachment_image_url($post->ID, 'medium');
			$class = '';
			 $ingredientes = getIngredientsShip($post->ID);
            if ( ! empty($ingredientes) ) :
                foreach ($ingredientes as $ingrediente):
						$class .= ' ingrediente-'.$ingrediente->ingrediente_id ?>
                <?php endforeach;
            endif; ?>

			<div class="[ box-content ][ col-xs-6 col-sm-4 col-lg-3 ] element-item <?php echo $class; ?>">
				<a href="<?php the_permalink() ?>">
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php the_title(); ?></p>
				</a>
			</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>