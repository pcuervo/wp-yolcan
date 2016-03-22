<?php get_header(); 
the_post(); 
$no_id = $post->ID; 
$user = get_user_by( 'id', $post->post_author ); ?>

<div class="[ container ]">
    <div class="[ row ]">
    <!--  Entrada single Blog -->
        <div class="[ col-xs-12 col-md-8 ][ user-content ]">
            <article>
                <h5><?php the_title() ?></h5>
                <?php $url_img = attachment_image_url($post->ID, 'large'); ?>
                <img src="<?php echo $url_img; ?>">
                <p><?php echo getDateTransform($post->post_date); ?> By <?php echo $user->user_login; ?></p>
                <hr>
                <?php the_content(); ?>
            </article>
        </div>
        <div class="[ col-xs-12 col-sm-8 col-sm-offset-2 col-md-3 col-md-offset-1 col-lg-2 col-lg-offset-1 ][ margin-top-bottom--large  ]">
            <div class="[ border-bottom ][ text-uppercase ][ margin-top ]">
                <h5 class="[ color-primary ]">Post Relacionados</h5>
            </div>
            <?php $relacionados = new WP_Query( array('posts_per_page' => 4, 'post_type' => array( 'post' ), 'post__not_in' => array($no_id), 'orderby' => 'rand' ) );

			if ( $relacionados->have_posts() ) :
				while ( $relacionados->have_posts() ) : 
					$relacionados->the_post(); ?>
		            <div class="[ margin-top ]">
		                <a href="<?php the_permalink() ?>" class="[ color-secondary ][ underline ]"><?php the_title(); ?></a>
		            </div>
		        <?php endwhile;
		    endif; ?>
           
        </div>
    </div>

</div> <!-- container -->

<?php get_footer(); ?>