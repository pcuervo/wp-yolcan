<?php
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

wc_print_notices(); ?>

<div class="[ clearfix ]"></div>
<div class="[ container padding--sides--xsm ][ margin-top-bottom--large ]"><!-- end in my-address -->
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<p class="myaccount_user">
				<?php
				printf(
					__( 'Hello <strong class="[ color-primary ]">%1$s</strong> (not %1$s? <a class="[ color-secondary ][ underline ]" href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
					$current_user->display_name,
					wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
				);

				printf( __( '<p>Desde su cuenta podrá ver sus pedidos recientes, administrar sus direcciones de envío y facturación y <a class="[ color-secondary ][ underline ]" href="%s">editar su contraseña y los detalles de su cuenta</a>.<p>', 'woocommerce' ),
					wc_customer_edit_account_url()
				);
				?>
			</p>

			<?php do_action( 'woocommerce_before_my_account' ); ?>

			<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

			<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

			<?php wc_get_template( 'myaccount/my-address.php' ); ?>

			<?php do_action( 'woocommerce_after_my_account' ); ?>


		<!-- HTML mi cuenta-->
		<div class="[ container ]" >
			<div class="[ margin-bottom ]">
				<div class="[ row ]">

					<section class="[ hidden-xs ][ col-sm-3 ][ bg-gray-lighter ][ margin ].height-50 height-1200">
						<div class="[ col-sm-10 col-sm-offset-1 ][ inline-block align-middle ][ margin-top-bottom ][ padding ]">
							<img class="[ img-user img-responsive ]" src="img/profile.png" >
						</div>
						<div class="[ col-sm-10 col-sm-offset-1 ][ inline-block align-middle ][ margin-bottom ]">
							<h2><strong>Daniela Morfín</strong></h2>
							<a href="#" class="[ underline ][ color-secondary ]"><em>editar</em></a>
							<a href="#" class="[ underline ][ color-secondary ][ margin-left--xsmall ]"><em>salir</em></a>
						</div>
					</section>

					<section class="[ visible-xs ]">
						<div class="[ row ][ border-bottom ][ margin-sides--small ]">
							<div class="[ col-xs-4 ][ inline-block align-middle ][ margin-top-bottom ]">
							<img class="[ img-user img-responsive ]" src="img/profile.png">
							</div>
							<div class="[ col-xs-8 ][ inline-block align-middle ][ margin-bottom ]">
								<h2><strong>Daniela Morfín</strong></h2>
								<a href="perfil-edit.html" class="[ underline ][ color-secondary ]"><em>editar</em></a>
								<a href="#" class="[ underline ][ color-secondary ]"><em>salir</em></a>
							</div>
						</div>
					</section>

					<div class="[ col-xs-12 col-sm-8 ]">
						<div class="[ border-bottom ][ margin-top  ]">
							<h4>Tu cuenta</h4>
							<p>Tu saldo es de <strong>$600.00</strong></p>
							<p>Equivale a <strong>2 y media canastas</strong></p>
							<div class="[ text-center ]">
								<a href="#" class="[ btn btn-secondary btn-small ][ margin-bottom ]">agrega saldo a tu cuenta</a>
								<a href="#" class="[ btn btn-secondary btn-small ][ margin-bottom ]">programa tu pago</a>
							</div>
						</div>

					</div>

					<div class="[ col-xs-12 col-sm-8 ][ margin-top-bottom ]">
						<div class="[ border-bottom ]">
							<h4>Tu próxima canasta</h4>
							<p>Media canasta para el 12 de mayo:</p>
							<ul class="[ list-style-none ][ padding--left ]">
								<li>Mix de ensalada</li>
								<li>Kale</li>
								<li>Quelite</li>
								<li>Calabaza</li>
								<li>Pepino</li>
								<li>Mantequilla</li>
								<li>Zanahoria</li>
							</ul>
							<div class="[ margin-bottom ]">
								<a href="#" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
							</div>
						</div>

					</div>

					<div class="[ col-xs-12 col-sm-8 ]">
						<h4>Agrega productos</h4>
						<p>Selecciona los productos que deseas agregar a tu canasta:</p>
						<form>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#huevo" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Huevo</p>
								</a>
								<div id="huevo" class="[ panel-collapse collapse in ][ padding--top ]">
									<p class="[ color-gray-xlight ]">Cantidad</p>
									<div class="[ row ]">
										<div class="[ col-xs-3 padding--right--small ]">
											<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
										</div>
										<div class="[ col-xs-5 no-padding ]">
											<div>
												<input type="radio" id="option1" name="cc">
												<label for="option1"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
											</div>
											<div>
												<input type="radio" id="option2" name="cc">
												<label for="option2"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
											</div>
											<div>
												<input type="radio" id="option3" name="cc">
												<label for="option3"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>

										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary ][ padding--xsmall margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#queso" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Queso</p>
								</a>
								<div id="queso" class="[ panel-collapse collapse ][ padding--top ]">
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
											<div>
												<input type="radio" id="option13" name="cc">
												<label for="option13"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>

										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#tortilla-azul" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Tortilla azul</p>
								</a>
								<div id="tortilla-azul" class="[ panel-collapse collapse ][ padding--top ]">
									<p class="[ color-gray-xlight ]">Cantidad</p>
									<div class="[ row ]">
										<div class="[ col-xs-3 padding--right--small ]">
											<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
										</div>
										<div class="[ col-xs-5 no-padding ]">
											<div>
												<input type="radio" id="option21" name="cc">
												<label for="option21"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
											</div>
											<div>
												<input type="radio" id="option22" name="cc">
												<label for="option22"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
											</div>
											<div>
												<input type="radio" id="option23" name="cc">
												<label for="option23"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>

										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#tortilla-blanca" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Tortilla blanca</p>
								</a>
								<div id="tortilla-blanca" class="[ panel-collapse collapse ][ padding--top ]">
									<p class="[ color-gray-xlight ]">Cantidad</p>
									<div class="[ row ]">
										<div class="[ col-xs-3 padding--right--small ]">
											<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
										</div>
										<div class="[ col-xs-5 no-padding ]">
											<div>
												<input type="radio" id="option31" name="cc">
												<label for="option31"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
											</div>
											<div>
												<input type="radio" id="option32" name="cc">
												<label for="option32"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
											</div>
											<div>
												<input type="radio" id="option33" name="cc">
												<label for="option33"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>

										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#cafe" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Café</p>
								</a>
								<div id="cafe" class="[ panel-collapse collapse ][ padding--top ]">
									<p class="[ color-gray-xlight ]">Cantidad</p>
									<div class="[ row ]">
										<div class="[ col-xs-3 padding--right--small ]">
											<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
										</div>
										<div class="[ col-xs-5 no-padding ]">
											<div>
												<input type="radio" id="option41" name="cc">
												<label for="option41"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
											</div>
											<div>
												<input type="radio" id="option42" name="cc">
												<label for="option42"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
											</div>
											<div>
												<input type="radio" id="option43" name="cc">
												<label for="option43"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>

										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
							<div class="[ margin-bottom ]">
								<a data-toggle="collapse" href="#miel" class="[ no-decoration color-dark color-dark-hover ]">
									<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
									<p class="[ inline-block align-middle ][ no-margin ]">Miel de abeja</p>
								</a>
								<div id="miel" class="[ panel-collapse collapse ][ padding--top ]">
									<p class="[ color-gray-xlight ]">Cantidad</p>
									<div class="[ row ]">
										<div class="[ col-xs-3 padding--right--small ]">
											<input type="number" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
										</div>
										<div class="[ col-xs-5 no-padding ]">
											<div>
												<input type="radio" id="option51" name="cc">
												<label for="option51"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
											</div>
											<div>
												<input type="radio" id="option52" name="cc">
												<label for="option52"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
											</div>
											<div>
												<input type="radio" id="option53" name="cc">
												<label for="option53"><span class="[ margin-right--xxsmall ]"></span>Cada 15 días</label>
											</div>
										</div>
										<div class="[ col-xs-4 padding--left--small ]">
											<button type="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]">agregar</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div> <!-- /forms -->

				</div> <!-- /row -->

			</div>

		</div>
