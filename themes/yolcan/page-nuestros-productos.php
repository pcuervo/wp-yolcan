<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>


<?php get_header();
the_post(); ?>

	<section class="[ bg-gray-lighter ]">
		<div class="[ container ]">
			<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
			<div class="[ row ][ margin-bottom--large ]">
                 <?php $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12
                        );
                $productos = new WP_Query( $args );

                if ( $productos->have_posts() ):

                    while ( $productos->have_posts() ) : $productos->the_post();
                        $producto = wc_get_product( get_the_ID() );
                        $variations = $producto->get_available_variations(); 
                        $addToCart = '';
                        $costoVariationSemanal = 0;
                        $costoTotal = 0;
                        $imagen = attachment_image_url(get_the_ID(), 'img_productos');
                        $imagen_prod = $imagen != '' ? $imagen : ''; ?>
                        <article class="[ col-xs-12 col-sm-4 ]">
                            <div class="[ card ]">
                                <div class="[ card__header ]">
                                        <h3 class="[ card__title ]"><?php the_title(); ?></h3>
                                        <h5 class="[ card__subtitle ]">para 1 persona</h5>
                                </div>
                                <div class="[ card__image ]">
                                        <img class="[ img-responsive ]" src="<?php echo $imagen; ?>">
                                </div>
                                <div class="[ card__footer ]">

                                    <div class="[ card__radio-options ][ text-center ]">
                                        <div class="[ radio-options__label ]">
                                                Entregas semanales durante:
                                        </div>
                                        <?php if (!empty($variations)):
                                        $count = 1;
                                            foreach($variations as $variation):
                                                $name = getNameVariation($variation['variation_id']);
                                                $check = $count == 1 ? 'checked' : '';
                                                $nombreVariacion = getNameOriginVariation($variation['variation_id']);
                                                $cansatSemanal = getCostoCanastaTemporalidad($nombreVariacion, $variation['display_price']);
                                                if($count == 1): 
                                                    $addToCart = site_url('/mi-carrito/?add-to-cart=').$variation['variation_id'];
                                                    $costoVariationSemanal = $cansatSemanal;
                                                    $costoTotal = $variation['display_price'];
                                                endif; ?>
                                                <label class="[ radio-options__selector__label ]" for="c9_meals-<?php echo $variation['variation_id']; ?>">
                                                    <input 
                                                        id="c9_meals-<?php echo $variation['variation_id']; ?>" 
                                                        data-costo="<?php echo number_format($variation['display_price']); ?>"
                                                        data-producto="<?php echo get_the_ID(); ?>"
                                                        data-variacion="<?php echo $variation['variation_id']; ?>"
                                                        data-semanal="<?php echo $cansatSemanal; ?>"
                                                        class="[ radio-options__selector ][ check-compra ]" 
                                                        type="radio" 
                                                        name="variaciones-<?php echo get_the_ID(); ?>" 
                                                        value="c9"
                                                        <?php echo $check; ?>
                                                    > <?php echo $name; ?>
                                                </label>
                                                <?php $count++; 
                                            endforeach;
                                        endif; ?>
                                       
                                    </div>
                                    <div class="[ card__price-table ]">
                                        <div class="[ price-table__set ][ clearfix ]">
                                            <span class="[ price-table__text ]">Precio total:</span>
                                            <span class="[ price-table__value ][ precio-producto-check-<?php echo get_the_ID(); ?> ]">$<?php echo number_format($costoTotal) ?></span>
                                        </div>
                                        <div class="[ price-table__set ][ clearfix ]">
                                            <span class="[ price-table__text ]">Precio por canasta:</span>
                                            <span class="[ price-table__value ][ precio-semanal-check-<?php echo get_the_ID(); ?> ]">
                                                $<?php echo $costoVariationSemanal ?>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#ingredientes" class="[ btn btn-link ][ width-100 block ]">Ver ingredientes</button>

                                    <?php if ( $product->is_in_stock() ) : ?>
                                    <div class="text-center">
                                        <a class="[ btn btn-secondary ] url-add-cart-product-<?php echo get_the_ID(); ?>" href="<?php echo $addToCart; ?>">Añadir al carrito</a>
                                    </div>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile;

                else:
                        echo __( 'No hay canastas' );
                endif;
                wp_reset_postdata();?>
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