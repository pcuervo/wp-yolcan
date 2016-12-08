<?php get_header(); ?>


	<section class="">
		<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
		<p class="[ fz-medium text-center ]">Ideas para nuestros ingredientes</p>
		<div class="[ bg-gray ][ padding--top-bottom--small ]">
			<div class="[ container ]">
				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
						<form>
							<div class="input-group">
								<input type="text" name="search" class="[ form-control ][ input-search ][  ]">
								<span class="[ input-group-btn ][  ]">
									<button class="[ input-search--button ][ btn-secondary ][ no-margin padding--small ]" type="submit">
										<img class="[ svg icon--iconed--large icon--stroke icon--responsive ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/search.svg">
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<?php $ingrTemporada = getIngredientsShip(0); ?>
			</div>
		</div>
		<div class="[ container ]">
			<p class="[ no-margin ][ text-center ]">
				Esta temporada cocinamos con:
				<?php if (! empty($ingrTemporada)):
					$TotIng = count($ingrTemporada) - 1;
					foreach ($ingrTemporada as $key => $ingrediente):
						$post_data = get_post($ingrediente->ingrediente_id);
						$coma = $TotIng != $key ? ',' : ''; ?>
						<a href="<?php echo site_url('recetas/?ingrediente=').$post_data->post_name; ?>" class="[ color-secondary ][ underline ]"><?php echo $post_data->post_title; ?></a><?php echo $coma; ?>
					<?php endforeach; ?>

				<?php endif; ?>
			</p>
		</div>
	</section>

	<section class="[ container ]">
		<div class="row">
			<article class="[ col-xs-12 col-md-4 ]">
				<h3 class="">Filtra nuestras recetas</h3>
				<div class="[ filter-ingredientes ]">
					<h4><a class="[ text-center ]" data-filter="ingredientes">Ingredientes</a></h4>
					<div class="[ row ] filters-ingredientes">
						<?php $ingredientes = new WP_Query( array('posts_per_page' => -1, 'post_type' => array( 'ingredientes' ) ) );

						if ( $ingredientes->have_posts() ) :
							while ( $ingredientes->have_posts() ) :
								$ingredientes->the_post(); ?>

								<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
									<input type="checkbox" class="" id="c<?php echo get_the_ID(); ?>" name="cc">
									<label for="c<?php echo get_the_ID(); ?>" class="filter-ingrediente" data-filter=".ingrediente-<?php echo get_the_ID(); ?>"><span></span><?php echo the_title(); ?>  </label>
								</div>
							<?php endwhile;
						endif; ?>
						
					</div>
				</div><!-- .filter-colecciones -->
				<!-- <div class="[ filter-temporada ]">
					<h4><a class="[ text-center ]" data-filter="temporada">Temporada</a></h4>
					<div class="[ row ]">
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c11" name="cc">
							<label for="c11"><span></span>desayuno</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c12" name="cc">
							<label for="c12"><span></span>botana</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c13" name="cc">
							<label for="c13"><span></span>plato fuerte</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c14" name="cc">
							<label for="c14"><span></span>sopa</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c15" name="cc">
							<label for="c15"><span></span>entrada</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c16" name="cc">
							<label for="c16"><span></span>cena</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c17" name="cc">
							<label for="c17"><span></span>sandwich</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c18" name="cc">
							<label for="c18"><span></span>guarnición</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c19" name="cc">
							<label for="c19"><span></span>postre</label>
						</div>
					</div>
				</div>
				<div class="[ filter-tipo-de-platillo ]">
					<h4><a class="[ text-center ]" data-filter="platillo">Tipo de platillo</a></h4>
					<div class="[ row ]">
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c21" name="cc">
							<label for="c21"><span></span>desayuno</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c22" name="cc">
							<label for="c22"><span></span>botana</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c23" name="cc">
							<label for="c23"><span></span>plato fuerte</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c24" name="cc">
							<label for="c24"><span></span>sopa</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c25" name="cc">
							<label for="c25"><span></span>entrada</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c26" name="cc">
							<label for="c26"><span></span>cena</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c27" name="cc">
							<label for="c27"><span></span>sandwich</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c28" name="cc">
							<label for="c28"><span></span>guarnición</label>
						</div>
						<div class="[ col-xs-4 col-sm-3 col-md-6 ]">
							<input type="checkbox" id="c29" name="cc">
							<label for="c29"><span></span>postre</label>
						</div>
					</div>
				</div> -->
			</article>
			<article id="content-recetas-grid" class="[ col-xs-12 col-md-8 ]">
				<?php
				if (isset($_GET['ingrediente']) AND $_GET['ingrediente'] != ''):
					get_template_part('templates/recetas', 'ingrediente');
				elseif(isset($_GET['search']) AND $_GET['search'] != ''):
					get_template_part('templates/recetas', 'search');
				else:
					get_template_part('templates/recetas', 'archive');
				endif;
				?>
			</article>
		</div>
	</section><!-- /container -->

<?php get_footer(); ?>