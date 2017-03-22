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
                    'posts_per_page' => 12,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => 'puntos',
                        ),
                    )
                );
                $productos = new WP_Query( $args );

                if ( $productos->have_posts() ):

                    while ( $productos->have_posts() ) : $productos->the_post();
                        $imagen = attachment_image_url(get_the_ID(), 'img_productos');
                        $addToCart = site_url('/mi-carrito/?add-to-cart=').get_the_ID(); ?>
                        <article class="[ col-xs-12 col-sm-4 ]">
                            <div class="[ card ]">
                                <div class="[ card__header ][ no-padding--bottom ]">
                                    <img class="[ img-responsive margin-auto ][ margin-bottom ]" src="<?php echo THEMEPATH; ?>images/coins-1.png">
                                    <h3 class="[ card__title ][ no-margin ]"><?php the_title(); ?></h3>
                                </div>

                                <div class="[ card__footer ]">
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
		</div>
	</section>

<?php get_footer(); ?>