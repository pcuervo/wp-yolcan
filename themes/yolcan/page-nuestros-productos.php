<?php get_header();
the_post(); ?>

<div class="[ main ]">
	<section class="[ bg-gray-lighter ]">
		<div class="[ container ]">
			<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
			<div class="[ row ][ margin-bottom--large ]">
				<article class="[ col-xs-12 col-sm-4 ]">
					<div class="[ card ]">
						<div class="[ card__header ]">
							<h3 class="[ card__title ]">Media canasta</h3>
							<h5 class="[ card__subtitle ]">para 1 persona</h5>
						</div>
						<div class="[ card__image ]">
							<img class="[ img-responsive ]" src="https://images.unsplash.com/photo-1423483641154-5411ec9c0ddf?crop=entropy&dpr=2&fit=crop&fm=jpg&h=200&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=300">
						</div>
						<div class="[ card__footer ]">
							<form class="[ card__form ]" action="">
								<div class="[ card__radio-options ][ text-center ]">
									<div class="[ radio-options__label ]">
										Entregas semanales durante:
									</div>
									<label class="[ radio-options__selector__label ]" for="c9_meals">
										<input id="c9_meals" class="[ radio-options__selector ]" type="radio" value="c9"> 1 mes
									</label>
									<label class="[ radio-options__selector__label ]" for="c10_meals">
										<input id="c10_meals" class="[ radio-options__selector ]" type="radio" value="c10"> 3 meses
									</label>
									<label class="[ radio-options__selector__label ]" for="c12_meals">
										<input id="c12_meals" class="[ radio-options__selector ]" type="radio" value="c12" checked=""> 6 meses
									</label>
								</div>
								<div class="[ card__price-table ]">
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio total:</span>
										<span class="[ price-table__value ]">$3,000</span>
									</div>
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio por canasta:</span>
										<span class="[ price-table__value ]">$30</span>
									</div>
								</div>
								<button type="button" data-toggle="modal" data-target="#ingredientes" class="[ btn btn-link ][ width-100 block ]">Ver ingredientes</button>
								<button type="submit" class="[ btn btn-secondary ][ block ][ width-100 ]">Seleccionar</button>
							</form>
						</div>
					</div>
				</article>
				<article class="[ col-xs-12 col-sm-4 ]">
					<div class="[ card ]">
						<div class="[ card__header ]">
							<h3 class="[ card__title ]">Canasta completa</h3>
							<h5 class="[ card__subtitle ]">Para 2 personas</h5>
						</div>
						<div class="[ card__image ]">
							<img class="[ img-responsive ]" src="https://images.unsplash.com/photo-1423483641154-5411ec9c0ddf?crop=entropy&dpr=2&fit=crop&fm=jpg&h=200&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=300">
						</div>
						<div class="[ card__footer ]">
							<form class="[ card__form ]" action="">
								<div class="[ card__radio-options ][ text-center ]">
									<div class="[ radio-options__label ]">
										Entregas semanales durante:
									</div>
									<label class="[ radio-options__selector__label ]" for="c9_meals">
										<input id="c9_meals" class="[ radio-options__selector ]" type="radio" value="c9"> 1 mes
									</label>
									<label class="[ radio-options__selector__label ]" for="c10_meals">
										<input id="c10_meals" class="[ radio-options__selector ]" type="radio" value="c10"> 3 meses
									</label>
									<label class="[ radio-options__selector__label ]" for="c12_meals">
										<input id="c12_meals" class="[ radio-options__selector ]" type="radio" value="c12" checked=""> 6 meses
									</label>
								</div>
								<div class="[ card__price-table ]">
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio total:</span>
										<span class="[ price-table__value ]">$3,000</span>
									</div>
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio por canasta:</span>
										<span class="[ price-table__value ]">$30</span>
									</div>
								</div>
								<button type="button" data-toggle="modal" data-target="#ingredientes" class="[ btn btn-link ][ width-100 block ]">Ver ingredientes</button>
								<button type="submit" class="[ btn btn-secondary ][ block ][ width-100 ]">Seleccionar</button>
							</form>
						</div>
					</div>
				</article>
				<article class="[ col-xs-12 col-sm-4 ]">
					<div class="[ card ]">
						<div class="[ card__header ]">
							<h3 class="[ card__title ]">Canasta familiar</h3>
							<h5 class="[ card__subtitle ]">Para 2 adultos y 2 niños</h5>
						</div>
						<div class="[ card__image ]">
							<img class="[ img-responsive ]" src="https://images.unsplash.com/photo-1423483641154-5411ec9c0ddf?crop=entropy&dpr=2&fit=crop&fm=jpg&h=200&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=300">
						</div>
						<div class="[ card__footer ]">
							<form class="[ card__form ]" action="">
								<div class="[ card__radio-options ][ text-center ]">
									<div class="[ radio-options__label ]">
										Entregas semanales durante:
									</div>
									<label class="[ radio-options__selector__label ]" for="c9_meals">
										<input id="c9_meals" class="[ radio-options__selector ]" type="radio" value="c9"> 1 mes
									</label>
									<label class="[ radio-options__selector__label ]" for="c10_meals">
										<input id="c10_meals" class="[ radio-options__selector ]" type="radio" value="c10"> 3 meses
									</label>
									<label class="[ radio-options__selector__label ]" for="c12_meals">
										<input id="c12_meals" class="[ radio-options__selector ]" type="radio" value="c12" checked=""> 6 meses
									</label>
								</div>
								<div class="[ card__price-table ]">
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio total:</span>
										<span class="[ price-table__value ]">$3,000</span>
									</div>
									<div class="[ price-table__set ][ clearfix ]">
										<span class="[ price-table__text ]">Precio por canasta:</span>
										<span class="[ price-table__value ]">$30</span>
									</div>
								</div>
								<button type="button" data-toggle="modal" data-target="#ingredientes" class="[ btn btn-link ][ width-100 block ]">Ver ingredientes</button>
								<button type="submit" class="[ btn btn-secondary ][ block ][ width-100 ]">Seleccionar</button>
							</form>
						</div>
					</div>
				</article>
			</div>

			<div class="[ row ][ margin-bottom ]">
				<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 ]">
					<div class="[ row ]">
						<div class="[ col-xs-4 ][ feature ]">
							<div class="[ feature__icon ][ icon--iconed--xxlarge icon--rounded ][ color-secondary ][ text-center ]">
								<img class="[ svg ][ icon icon--iconed--large icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/box-1.svg">
							</div>
							<span class="[ feature__text ]">Envio a domicilio semanal gratuito</span>
						</div>
						<div class="[ col-xs-4 ][ feature ]">
							<div class="[ feature__icon ][ icon--iconed--xxlarge icon--rounded ][ color-secondary ][ text-center ]">
								<img class="[ svg ][ icon icon--iconed--large  icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/filter-7.svg">
							</div>
							<span class="[ feature__text ]">Sáltate cualquier semana </span>
						</div>
						<div class="[ col-xs-4 ][ feature ]">
							<div class="[ feature__icon ][ icon--iconed--xxlarge icon--rounded ][ color-secondary ][ text-center ]">
								<img class="[ svg ][ icon icon--iconed--large  icon--stroke icon--thickness-1 ][ color-secondary ]" src="<?php echo THEMEPATH; ?>icons/apple-1.svg">
							</div>
							<span class="[ feature__text ]">Agrega ingredientes a tu canasta</span>
						</div>
					</div>
				</div>
			</div>

			<p class="[ text-center ]">Puedes editar tu orden en la sección de tu cuenta</p>
		</div>
	</section>

	<section class="[ bg-light ]">
		<div class="[ container ]">
			<h2 class="[ text-center ]">¿Preguntas? Aquí tenemos tus respuestas</h2>
			<div class="[ row ][ js-masonry-container ]">
				<article class="[ col-sm-12 col-sm-4 col-md-3 ][ js-masonry-item ]">
					<h4>Can I select the recipes?</h4>
					<p>Quo plebiscito decreta a senatu est consuli quaestio Cn. Ita graviter et severe voluptatem secrevit a bono. Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam. Quid enim possumus hoc agere divinius? Duo Reges: autem in homine praestantissimum atque optimum est, id deseruit. Hinc ceteri particulas arripere conati suam quisque videro voluit afferre sententiam. Si longus, levis;</p>
				</article>
				<article class="[ col-sm-12 col-sm-4 col-md-3 ][ js-masonry-item ]">
					<h4>Can I select the recipes?</h4>
					<p>Yes! Each week, 10 days before your delivery day, you’ll receive an email with meal choices. If you'd like to swap recipes, you can do so under "My Account."</p>
				</article>
				<article class="[ col-sm-12 col-sm-4 col-md-3 ][ js-masonry-item ]">
					<h4>Can I select the recipes?</h4>
					<p>Itaque hic ipse iam pridem est reiectus; Sed ad bona praeterita redeamus. Ego quoque, inquit, didicerim libentius si quid attuleris, quam te reprehenderim. Duo Reges: constructio interrete.</p>
				</article>
				<article class="[ col-sm-12 col-sm-4 col-md-3 ][ js-masonry-item ]">
					<h4>Can I select the recipes?</h4>
					<p>Hoc loco tenere se Triarius non potuit. Ita relinquet duas, de quibus etiam atque etiam consideret. Hoc loco tenere se Triarius non potuit. Nunc agendum est subtilius. Itaque rursus eadem ratione, qua sum paulo ante usus, haerebitis. Et harum quidem rerum facilis est et expedita distinctio. Duo Reges: iure in vestris auribus commentatus?</p>
				</article>
			</div>
		</div>
	</section>


<?php get_footer(); ?>