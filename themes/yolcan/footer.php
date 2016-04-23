		<footer class="[ bg-primary-darken ][ text-center ][ color-gray-xxlight ]">
			<div class="[ container ]">
				<div class="[ row ]">
					<div class="[ col-sm-3 no-padding--right no-padding--left ]">
						<h3><em>Contacto</em></h3>
						<!-- Contacto: social-media -->
						<?php $contactanos = get_page_by_path('contactanos');
						$telefono = get_post_meta($contactanos->ID, 'telefono_c', true);
						$whatsapp = get_post_meta($contactanos->ID, 'whatsapp_c', true);?>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]"  href="tel:+525552555555">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/phone-5.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]"><?php echo $telefono; ?></span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href=""><!-- whatsapp://send?abid=username&text=Hola --><!-- href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share" -->
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/logo-whatsapp.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]"><?php echo $whatsapp; ?></span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="mailto:contacto@yolcan.com">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/email.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">contacto@yolcan.com</span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.facebook.com/Yolcan-190099034343351/">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">/yolcan</span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://twitter.com/michinampa">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/twitter.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@yolcan</span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.instagram.com/yolcan/">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/logo-instagram.svg">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@yolcan</span>
						</a>
					</div>
					<div class="[ col-sm-4 col-md-3 ]">
						<h3><em>Únete</em></h3>
						<div class="[ margin-bottom ]">
							<a data-toggle="modal" data-target="#unete" class="[ inline-block align-middle ][ btn btn-secondary margin-top--small ]">registrate</a>
							<a href="<?php echo site_url('/visitanos/'); ?>#agenda" class="[ inline-block align-middle ][ btn btn-secondary ][ margin-top--small ]">agenda una cita</a>
						</div>
					</div>
					<div class="[ col-sm-2 col-md-3 ]">
						<h3><em>Métodos de pago</em></h3>
						<div class="[ row ]">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/visa.svg" alt="">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/paypal.svg" alt="">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/mastercard.svg" alt="">
						</div>
					</div>
					<div class="[ col-sm-3 ]">
						<h3><em>Newsletter</em></h3>
						<div class="[ text-left ]">
							<p>Recibe las últimas noticias y ofertas antes que nadie, déjanos tu correo.</p>
							<form class="[ margin-bottom ][ hidden-xs ] form-news">
								<div class="[ form-group ]">
									<input type="text" class="[ form-control ][ no-border-radius ][ margin-bottom--small ] mail-news">
									<input class="[ btn btn-secondary ][ no-margin ]" type="submit" value="suscribirme">
								</div>
							</form>
						</div>
						<!-- input inline -->
						<div class="[ visible-xs ]">
							<form class="[ input-group ] form-news-2">
								<input type="text" class="[ form-control ][ no-border-radius ] mail-news">
								<span class="[ input-group-btn ]">
									<input class="[ input-search--button ][ btn btn-secondary ]" type="submit" value="suscribirme">
								</span>
							</form>
						</div>
					</div>
				</div>
				<div class="[ row ]">
					<div class="[ col-xs-12 ][ margin-top-bottom ]">
						<p class="[ color-gray-xlight ]">Content copyright 2015. Yolcan. All right reserved.</p>
					</div>
				</div>
			</div>
		</footer>

		<!-- modal unete -->
		<div id="unete" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body ][ color-light ]">
						<div class="[ bg-primary-darken width-bg margin-auto ][ padding--top-bottom ]">
							<button type="button" class="[ close ][ pull-right relative left--20 z-index--100   ]" data-dismiss="modal">
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]"src="<?php echo THEMEPATH; ?>icons/close.svg">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">Ingresa tus datos y comienza a formar parte de la comunidad <span class=" [ text-uppercase ]">yolcan</span></p>
									<form class="[ border-bottom--primary--medium ][ margin-bottom ][ text-left ]">
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Nombre</label>
											<input type="text" class="[ form-control no-border-radius color-gray-xlight height-30 ]">
										</div>
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Correo</label>
											<input type="email" class="[ form-control no-border-radius color-gray-xlight height-30 ]">
										</div>
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Teléfono</label>
											<input type="text" class="[ form-control no-border-radius color-gray-xlight height-30 ]">
										</div>
										<div class="[ text-center ]">
											<button type="submit" href="#" class="[ btn btn-secondary padding--top-bottom--xsmall ][ margin-bottom ]">únete</button>
										</div>
									</form>
									<div class="[ text-center ]">
										<a href="https://www.facebook.com">
											<p class="[ small sans-serif  ][ color-light ][ inline-block align-middle no-margin ]">Ingresa con</p>
											<button type="submit" href="#" class="[ btn btn-facebook ][ inline-block align-middle margin-left--small ]">
												<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg">
												<span class="[ color-light ][ inline-block align-middle ]">Facebook</span>
											</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- modal ingresa -->
		<div id="ingresa" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body ][ color-light ]">
						<div class="[ bg-primary-darken width-bg margin-auto ][ padding--top-bottom--large ]">
							<button type="button" class="[ close ][ pull-right relative left--20 z-index--100 ]" data-dismiss="modal">
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]"src="<?php echo THEMEPATH; ?>icons/close.svg">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">Ingresa en tu cuenta de <span class=" [ text-uppercase ]">yolcan</span></p>
									<form method="post" class="[ border-bottom--primary--medium ][ margin-bottom ][ text-left ]">
										<?php do_action( 'woocommerce_login_form_start' ); ?>

										<p class="form-row form-row-wide">
											<label class="[ sans-serif ]" for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
											<input type="text" class="input-text [ form-control no-border-radius color-gray-xlight height-30 bg-light ] " name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
										</p>
										<p class="form-row form-row-wide">
											<label class="[ sans-serif ]" for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
											<input class="input-text [ form-control no-border-radius color-gray-xlight height-30 bg-light ]" type="password" name="password" id="password" />
										</p>

										<?php do_action( 'woocommerce_login_form' ); ?>
										<p class="form-row [ text-center ]">
											<?php wp_nonce_field( 'woocommerce-login' ); ?>
											<input type="submit" class="button [ input-btn-secondary ]" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
											<label for="rememberme" class="inline [ margin-bottom ]">
												<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
											</label>
										</p>
										<p class="lost_password [ text-center ]">
											<a class="[ color-light ]" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
										</p>

										<?php do_action( 'woocommerce_login_form_end' ); ?>
									</form>
									<div class="[ text-center ]">
										<a href="https://www.facebook.com">
											<p class="[ small sans-serif  ][ color-light ][ inline-block align-middle no-margin ]">Ingresa con</p>
											<button type="submit" href="#" class="[ btn btn-facebook ][ inline-block align-middle margin-left--small ]">
												<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg">
												<span class="[ color-light ][ inline-block align-middle ]">Facebook</span>
											</button>
										</a>
									</div>
								</div>
							</div>
						</div><!-- end bg-primary -->
					</div><!-- end modal-body -->
				</div><!-- end modal-content -->
			</div><!-- end modal-dialog -->
		</div><!-- end modal -->


		<!-- modal ingredientes canastas -->
		<div id="ingredientes" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body modal--horizontal ][ bg-light ][ padding--top-bottom--xxlarge ][ color-light ]">
						<button type="button" class="[ close ][ pull-right relative left--20 z-index--100 ]" data-dismiss="modal">
							<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]"src="<?php echo THEMEPATH; ?>icons/close.svg">
						</button>
						<h2 class="[ text-center color-dark ][ no-margin--top ]">Canasta mediana</h2>
						<div class="[ row ]">
							<?php $ingredientes = new WP_Query( array('posts_per_page' => 10, 'post_type' => array( 'ingredientes' ), 'orderby' => 'rand' ) );
							if ( $ingredientes->have_posts() ) :
								while ( $ingredientes->have_posts() ) :
									$ingredientes->the_post();?>
									<div class="[ col-xs-3 col-md-2 ]">
										<a class="[ box-content ]" href="<?php echo site_url('/recetas/').'?ingrediente='.$post->post_name; ?>">
											<?php $url_img = attachment_image_url($post->ID, 'medium'); ?>
											<img class="[ image-responsive ]" alt="" src="<?php echo $url_img; ?>">
											<p class="[ text-center ]"><?php the_title(); ?></p>
										</a>
									</div>
								<?php endwhile;
							endif; ?>
						</div>
						<div class="[ card__radio-options ][ text-center color-dark ]">
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
						<form class="[ card__form ][ text-center ]" action="">
							<button type="submit" class="[ btn btn-secondary ]">Seleccionar</button>
						</form>
					</div><!-- end modal-body -->
				</div><!-- end modal-content -->
			</div><!-- end modal-dialog -->
		</div><!-- end modal -->

		<?php wp_footer(); ?>

	</body>
</html>