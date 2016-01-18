<?php get_header(); ?>

<section class="[ container ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<h2><strong>Recetas</strong></h2>
			<p class="[ fz-medium ]">Ideas para nuestros ingredientes</p>
		</div>
	</div>
</section>
<section class="[ bg-gray ][  ][ padding--top-bottom--small ]">
	<div class="[ container ]">
		<div class="[ row  ]">
			<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
				<div class="input-group">
					<input type="text" class="[ form-control ][ input-search ][  ]">
					<span class="[ input-group-btn ][  ]">
						<button class="[ input-search--button ][ btn-secondary ][ no-margin padding--small ]" type="submit">
							<img class="[ svg icon--iconed--large icon--stroke icon--responsive ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/search.svg">
						</button>
					</span>
				</div>
			</div>
		</div>

	</div>

</section>

<div class="[ container ]">
	<div class="[ row ][ margin-bottom ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<p>Esta temporada cocinamos con: <a href="#" class="[ color-secondary ][ underline ]">kale</a>, <a href="#" class="[ color-secondary ][ underline ]">nabo</a>, <a href="#" class="[ color-secondary ][ underline ]">jitomate</a>, <a href="#" class="[ color-secondary ][ underline ]">acelgas</a>, <a href="#" class="[ color-secondary ][ underline ]">durazno</a></p>
		</div>
	</div>
</div>

<div>
	<!-- Push Wrapper -->
	<div id="mp-pusher" class="[ mp-pusher ]">
		<!-- mp-menu -->

		<div class="[ content-wrapper ]"><!-- this is for emulating position fixed of the nav -->
			<div class="[ content ]">
				<div class="[ main-wrapper ] [ margin-bottom ]" >
					<div class="[ main ]">
						<section class="[ filters ] [ margin-bottom--small ]">
							<div class="[ filters__tabs ] [ clearfix ]">
								<a class="[ tab-filter ] [ text-center ] [ col-xs-4 ]" data-filter="ingredientes">ingredientes</a>
								<a class="[ tab-filter ] [ text-center ] [ col-xs-4 ]" data-filter="temporada">temporada</a>
								<a class="[ tab-filter ] [ text-center ] [ col-xs-4 ]" data-filter="platillo">tipo de platillo</a>
							</div><!-- filters__tabs -->
							<div class="[ filters__content ][ border-bottom--secondary--small ]">
								<div class="[ filter-ingredientes ]">
									<div class="[ row ]">
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c1" name="cc">
												<label for="c1"><span></span>desayuno</label>
											</div>
											<div>
												<input type="checkbox" id="c2" name="cc">
												<label for="c2"><span></span>botana</label>
											</div>
											<div>
												<input type="checkbox" id="c3" name="cc">
												<label for="c3"><span></span>plato fuerte</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c4" name="cc">
												<label for="c4"><span></span>sopa</label>
											</div>
											<div>
												<input type="checkbox" id="c5" name="cc">
												<label for="c5"><span></span>entrada</label>
											</div>
											<div>
												<input type="checkbox" id="c6" name="cc">
												<label for="c6"><span></span>cena</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c7" name="cc">
												<label for="c7"><span></span>sandwich</label>
											</div>
											<div>
												<input type="checkbox" id="c8" name="cc">
												<label for="c8"><span></span>guarnición</label>
											</div>
											<div>
												<input type="checkbox" id="c9" name="cc">
												<label for="c9"><span></span>postre</label>
											</div>
										</div>
									</div>
								</div><!-- .filter-colecciones -->
								<div class="[ filter-temporada ][ border-bottom--secondary--small ]">
									<div class="[ row ]">
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c11" name="cc">
												<label for="c11"><span></span>desayuno</label>
											</div>
											<div>
												<input type="checkbox" id="c12" name="cc">
												<label for="c12"><span></span>botana</label>
											</div>
											<div>
												<input type="checkbox" id="c13" name="cc">
												<label for="c13"><span></span>plato fuerte</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c14" name="cc">
												<label for="c14"><span></span>sopa</label>
											</div>
											<div>
												<input type="checkbox" id="c15" name="cc">
												<label for="c15"><span></span>entrada</label>
											</div>
											<div>
												<input type="checkbox" id="c16" name="cc">
												<label for="c16"><span></span>cena</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c17" name="cc">
												<label for="c17"><span></span>sandwich</label>
											</div>
											<div>
												<input type="checkbox" id="c18" name="cc">
												<label for="c18"><span></span>guarnición</label>
											</div>
											<div>
												<input type="checkbox" id="c19" name="cc">
												<label for="c19"><span></span>postre</label>
											</div>
										</div>
									</div>
								</div><!-- .filter-fotografos -->
								<div class="[ filter-platillo ][ border-bottom--secondary--small ]">
									<div class="[ row ]">
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c21" name="cc">
												<label for="c21"><span></span>desayuno</label>
											</div>
											<div>
												<input type="checkbox" id="c22" name="cc">
												<label for="c22"><span></span>botana</label>
											</div>
											<div>
												<input type="checkbox" id="c23" name="cc">
												<label for="c23"><span></span>plato fuerte</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c24" name="cc">
												<label for="c24"><span></span>sopa</label>
											</div>
											<div>
												<input type="checkbox" id="c25" name="cc">
												<label for="c25"><span></span>entrada</label>
											</div>
											<div>
												<input type="checkbox" id="c26" name="cc">
												<label for="c26"><span></span>cena</label>
											</div>
										</div>
										<div class="[ col-xs-4 ][ padding--sides--xsmall ]">
											<div>
												<input type="checkbox" id="c27" name="cc">
												<label for="c27"><span></span>sandwich</label>
											</div>
											<div>
												<input type="checkbox" id="c28" name="cc">
												<label for="c28"><span></span>guarnición</label>
											</div>
											<div>
												<input type="checkbox" id="c29" name="cc">
												<label for="c29"><span></span>postre</label>
											</div>
										</div>
									</div>
								</div><!-- .filter-decada -->
							</div><!-- filters__content -->
						</section><!-- .filters -->
					</div> <!-- .main -->
				</div> <!-- .main-wrapper -->

			</div><!-- /content -->
		</div><!-- /content-wrapper -->
	</div><!-- /pusher -->
</div><!-- /container -->


<section class="[ container ][ margin-bottom ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<h4 class="[ inline-block ]">Recetas con con:
				<span class="[ inline-block ][ color-primary ]">Kale</span>
			</h4>
		</div>
	</div>
</section>
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

<?php get_footer(); ?>