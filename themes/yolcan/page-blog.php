<?php get_header();  ?>

<div class="[ container ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 ]">
			<h2>Blog</h2>
		</div>
	</div>
	<div class="[ row ][ margin-bottom--large ]">
		<!--  Entradas Blog -->

		<?php $blog = new WP_Query( array('posts_per_page' => 8, 'post_type' => array( 'post' )) );

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

<?php get_footer(); ?>