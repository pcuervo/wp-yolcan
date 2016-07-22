<?php 
global $wp_query;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;?>

<?php if ( have_posts() ) : ?>
	<div class="[ row ]">
		<?php while( have_posts() ) : the_post();
		 	$url_img = attachment_image_url($post->ID, 'medium'); ?>

			<div class="[ box-content ][ col-xs-6 col-sm-4 col-lg-3 ]">
				<a href="<?php the_permalink() ?>">
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php the_title(); ?></p>
                                        <p>Ingredientes:</p>
                                        
                                        
                                        <?php
                                        
                                        $ingredientes = new WP_Query( ['post_type' => 'ingredientes', 'posts_per_page' => -1] );
                                        if ( ! empty($ingredientes->posts) ) :
                                                $activitisShip = orderIndexObject(getIngredientsShip($post->ID));
                                                foreach ($ingredientes->posts as $ingrediente):
                                                        $checked = isset( $activitisShip[$ingrediente->ID] ) ? 'checked' : '';?>

                                                        <input type="checkbox" name="ingredientes[]" id="ingredientes[]" value="<?php echo $ingrediente->ID ?>" <?php echo $checked; ?> /> <?php echo $ingrediente->post_title; ?><br><br>

                                                <?php endforeach;
                                        endif;
                                       
                                        ?>
                                        
                                        
                                        
				</a>
			</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>