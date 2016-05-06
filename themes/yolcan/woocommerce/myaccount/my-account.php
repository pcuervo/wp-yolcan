<?php $saldo = 6700;
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

if (class_exists('CanastaController')) $canasta = new CanastaController;  ?>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<div class="[ container ]"><!-- end in my-address -->
	<div class="[ row ]">

		<section class="[ col-sm-3 ][ bg-gray-lighter ]">
			<article>
				<?php
					printf(
						__( '<h2>%1$s</h2> <a href="%2$s" class="[ underline ][ color-secondary ]"><em>salir</em></a>', 'woocommerce' ) . ' ',
						$current_user->display_name,
						wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
					);
					printf( __( '<a class="[ color-secondary ][ underline ]" href="%s"><em>editar</em></a>', 'woocommerce' ),
						wc_customer_edit_account_url()
					);
				?>
			</article>

			<article>
				<?php wc_get_template( 'myaccount/my-address.php' ); ?>
			</article>

		</section>

		<section class="[ col-xs-12 col-sm-8 ]">

			<article class="[ padding-bottom border-bottom margin-bottom ]">
				<h4>Tu cuenta</h4>
				<p>Tu saldo es de <strong>$<?php echo $saldo; ?></strong></p>
				<p>Equivale a <strong>2 y media canastas</strong></p>
				<div class="[ text-center ]">
					<a href="<?php echo site_url('nuestros-productos/'); ?>" class="[ btn btn-secondary btn-small ][ margin-bottom ]">agrega saldo a tu cuenta</a>
				</div>
			</article>

			<article class="[ padding--bottom border-bottom margin-bottom ]">
				<h4>Tu próxima canasta - <span class="[ color-primary ]">$3,000</span></h4>
				<p>Media canasta para el 12 de mayo:</p>
				<?php $ingredientes = array();
				if (isset($canasta->actualizacion)):
					if ($canasta->actualizacion->valor_puntos_completa < $saldo) $ingredientes = $canasta->getCanastaCompleta();
					if ($canasta->actualizacion->valor_puntos_completa > $saldo AND $canasta->actualizacion->valor_puntos_mitad < $saldo) $ingredientes = $canasta->getMediaCanasta();
				endif; ?>
				<ul class="[ list-style-none ][ padding--left ]">
					<?php if (!empty($ingredientes)):
						foreach ($ingredientes as $key => $ingrediente): ?>
							<li><?php echo $ingrediente->nombre_ingrediente; ?></li>
						<?php endforeach;
					else:
						echo '<p>Saldo insuficiente</p>';
					endif; ?>
				</ul>

				<h5>Productos agregados:</h5>
				<div>
					<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">-</button>
					<span>Jitomate 100gr - $20</span>
				</div>
				<div>
					<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">-</button>
					<span>Jitomate 100gr - $20</span>
				</div>
				<div>
					<span>Jitomate 100gr - $20</span> <a class="[ underline ][ color-secondary ]" href="#">eliminar</a>
				</div>
				<ul>
					<li> Jitomate 100gr - $20 <a class="[ underline ][ color-secondary ]" href="#">eliminar</a></li>
				</ul>

				<a href="#" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
			</article>

			<article class="">
				<h4>Agrega productos</h4>
				<p>Selecciona los productos que deseas agregar a tu canasta:</p>
				<form>

					<div class="[ margin-bottom ]">
						<a data-toggle="collapse" href="#jitomate" class="[ no-decoration color-dark color-dark-hover ]">
							<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
							<p class="[ inline-block align-middle ][ no-margin ]">Jitomate 100gr - $15</p>
						</a>
						<div id="jitomate" class="[ panel-collapse collapse ]">
							<p class="[ color-gray-xlight ][ padding--top ]">Cantidad <small>(en gramos)</small></p>
							<div class="[ row ]">
								<div class="[ col-xs-3 padding--right--small ]">
									<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
								</div>
								<div class="[ col-xs-5 no-padding ]">
									<div class="[ custom-radio ]">
										<input type="radio" id="option11" name="cc">
										<label for="option11"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocasión</label>
									</div>
									<div class="[ custom-radio ]">
										<input type="radio" id="option12" name="cc">
										<label for="option12"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
									</div>
								</div>
								<div class="[ col-xs-4 padding--left--small ]">
									<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
								</div>
							</div>
						</div>
					</div>

					<?php /* if (! empty($canasta) AND method_exists($canasta, 'getIngredientesAdicionales')) :
						$adicionales = $canasta->getIngredientesAdicionales();
						if ( ! empty($adicionales) ):
							foreach($adicionales as $data_ingrediente):
								$ingrediente = get_post($data_ingrediente->ingrediente_id);?>
								<div class="[ margin-bottom ]">
									<a data-toggle="collapse" href="#<?php echo $ingrediente->post_name; ?>" class="[ no-decoration color-dark color-dark-hover ]">
										<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
										<p class="[ inline-block align-middle ][ no-margin ]"><?php echo $ingrediente->post_title; ?></p>
									</a>
									<div id="<?php echo $ingrediente->post_name; ?>" class="[ panel-collapse collapse ][ padding--top ]">
										<p class="[ color-gray-xlight ]">Cantidad</p>
										<div class="[ row ]">
											<div class="[ col-xs-3 padding--right--small ]">
												<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
											</div>
											<div class="[ col-xs-5 no-padding ]">
												<div>
													<input type="radio" id="option11" name="cc">
													<label for="option11"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
												</div>
												<div>
													<input type="radio" id="option12" name="cc">
													<label for="option12"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
												</div>
											</div>
											<div class="[ col-xs-4 padding--left--small ]">
												<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach;
						endif;
					endif; */ ?>

				</form>
			</article> <!-- /forms -->

			<?php //wc_get_template( 'myaccount/my-downloads.php' ); ?>
			<?php //wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

		</section>
	</div>
</div>

<?php do_action( 'woocommerce_after_my_account' ); ?>