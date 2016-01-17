<?php get_header(); 
the_post(); ?>

<div class="[ container ]" >
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<h2><strong><?php the_title(); ?></strong></h2>
			<?php the_content(); ?>
		</div>

		<div class="[ col-xs-12 col-sm-6 col-sm-offset-3 ]">
			<p class="[ fz-medium ][ text-center ]"><strong><em>Media canasta</strong></em></p>
			<div class="[ text-center ][ margin-bottom ]">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<p class="[ inline-block align-middle ][ color-secondary ][ fz-xlarge ][ margin-bottom--large margin-sides--xsmall ]"> __ </p>
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
			</div>
			<p class="[ fz-medium ][ text-center ]"><strong><em>Canasta completa</strong></em></p>
			<div class="[ text-center ][ margin-bottom ]">
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
				<p class="[ inline-block align-middle ][ inline-block align-middle ][ color-secondary ][ fz-xlarge ][ margin-bottom--large margin-sides--xsmall ]"> __ </p>
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
				<img class="" src="<?php echo THEMEPATH; ?>/images/person.png">
			</div>
			<p class="[ fz-medium ][ text-center ]"><strong><em>Canasta familiar</strong></em></p>
			<div class="[ text-center ][ margin-bottom ]">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<p class="[ inline-block align-middle ][ color-secondary ][ fz-xlarge ][ margin-bottom--large margin-sides--xsmall ]"> __ </p>
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
				<img src="<?php echo THEMEPATH; ?>/images/person.png">
			</div>
			<p class="[ margin-bottom ]">Nota, adicional a los productos de la canasta, puedes agregar huevo, pollo, carne, tortillas y queso oaxaca a tu pedido.</p>
		</div>
	</div>


	<div class="[ col-xs-12 ][ text-center ]">
		<a data-toggle="modal" data-target="#unete" class="[ btn btn-secondary ][ margin-bottom ]">únete</a>
	</div>
	<p class="[ fz-medium ][ text-center ][ margin-bottom ]"><strong><em>Algunas frutas y verduras que pueden estar en tu canasta</em></strong></p>
	<div id="content">
		<?php $ingredientes = new WP_Query( array('posts_per_page' => 10, 'post_type' => array( 'ingredientes' ), 'orderby' => 'rand' ) );

		if ( $ingredientes->have_posts() ) :
			while ( $ingredientes->have_posts() ) : 
				$ingredientes->the_post();?>
				<div class="[ box-content ]">
					<?php $url_img = attachment_image_url($post->ID, 'medium'); ?>
					<img alt="" src="<?php echo $url_img; ?>">
					<p class=""><?php the_title(); ?></p>
				</div>
			<?php endwhile;
		endif; ?>
	</div>
	<div class="[ col-xs-12 ][ text-center ][ margin-top-bottom--large ]">
		<a data-toggle="modal" data-target="#unete" class="[ btn btn-secondary ][ margin-bottom ]">únete</a>
	</div>
</div>
		

<?php get_footer(); ?>