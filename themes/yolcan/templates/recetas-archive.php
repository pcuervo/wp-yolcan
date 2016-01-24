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
		<?php

		if(has_previous_posts()): ?><div class="left"><?php previous_posts_link( '< Anteriores' ); ?> </div><?php endif;
		if(get_next_post()): ?><div class="right"> <?php next_posts_link( 'Siguientes >' ); ?></div> <?php endif; ?>

		<!-- <ul class="[ pagination ][ no-margin ]">

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
	</ul> -->
</section>