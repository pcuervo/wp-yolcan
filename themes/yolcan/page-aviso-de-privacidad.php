<?php get_header();
the_post(); ?>
	<section class="[ container ]">
		<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
		<div class="">
			<?php
				the_content();
			?>
		</div>
	</section>


<?php get_footer(); ?>