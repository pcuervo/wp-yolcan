<?php global $procesoRegistro; ?>
		<footer class="[ bg-primary-darken ][ color-gray-xxlight ]">
			<div class="[ container ]">
				<section class="[ row ]">
					<article class="[ col-sm-3 ]">
						<h3><em>Contacto</em></h3>
						<!-- Contacto: social-media -->
						<?php $contactanos = get_page_by_path('contactanos');
						$telefono = get_post_meta($contactanos->ID, 'telefono_c', true);
						$whatsapp = get_post_meta($contactanos->ID, 'whatsapp_c', true);?>
						<a target="_blank" class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="tel:+<?php echo $telefono; ?>5">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/phone-5.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ][ color-light ]"><?php echo $telefono; ?></span>
						</a>
						<a target="_blank" class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/logo-whatsapp.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ][ color-light ]"><?php echo $whatsapp; ?></span>
						</a>
						<a class="[ social-media ][ color-light color-secondary--hover no-decoration ][ link-email ][ cursor-pointer ]">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/email.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">contacto<span>@</span>yolcan.com</span>
						</a>
						<a target="_blank" class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.facebook.com/yolcanmexico/">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">/yolcanmexico</span>
						</a>
						<a target="_blank" class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://twitter.com/michinampa">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/twitter.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@michinampa</span>
						</a>
						<a target="_blank" class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.instagram.com/yolcan_mx/">
							<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/logo-instagram.svg" alt="icono redes">
							<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@yolcan_mx</span>
						</a>
					</article>
					<article class="[ col-sm-4 col-md-3 ]">
						<h3><em>Únete</em></h3>
						<div class="[ margin-bottom ]">
							<?php if ( ! is_user_logged_in() ){ ?>
								<a data-toggle="modal" data-target="#unete" class="[ inline-block align-middle ][ btn btn-secondary margin-top--small ]">registrate</a>
							<?php } ?>
							<a href="<?php echo site_url('/visitanos/'); ?>#agenda" class="[ inline-block align-middle ][ btn btn-secondary ][ margin-top--small ]">agenda una cita</a>
						</div>
					</article>
					<article class="[ col-sm-2 col-md-3 ]">
						<h3><em>Métodos de pago</em></h3>
						<div class="[ row ]">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/visa.svg" alt="método de pago">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/paypal.svg" alt="método de pago">
							<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>icons/mastercard.svg" alt="método de pago">
						</div>
						<br />
						<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=lBl12PcwCPqUVcodhdKf44j7WEgn1JdmzpFG9BANtnEgldPt5VzwCTknfCtJ"></script></span>
					</article>
					<article class="[ col-sm-3 ]">
						<h3><em>Newsletter</em></h3>
						<div class="[ text-left ]">
							<p>Recibe las últimas noticias y ofertas antes que nadie, déjanos tu correo.</p>
							<form class="[ margin-bottom ][ hidden-xs ] form-news">
								<div class="[ form-group ]">
									<label class="[ hide ]" for="yolcan-news"></label>
									<input id="yolcan-news" type="text" class="[ form-control ][ no-border-radius ][ margin-bottom--small ] mail-news">
									<label class="[ hide ]" for="yolcan-news-send"></label>
									<input id="yolcan-news-send" class="[ btn btn-secondary ][ no-margin ]" type="submit" value="suscribirme">
								</div>
							</form>
						</div>
						<!-- input inline -->
						<div class="[ visible-xs ]">
							<form class="[ input-group ] form-news-2">
								<label class="[ hide ]" for="yolcan-news"></label>
								<input type="text" class="[ form-control ][ no-border-radius ] mail-news">
								<span class="[ input-group-btn ]">
									<label class="[ hide ]" for="yolcan-news-send"></label>
									<input class="[ input-search--button ][ btn btn-secondary ]" type="submit" value="suscribirme">
								</span>
							</form>
						</div>
					</article>
				</section>
				<p class="[ color-gray-xlight ][ text-center ]">Yolcan 2017. Todos los derechos reservados | <a class="[ color-light ]" href="<?php echo site_url('/aviso-de-privacidad/') ?>">Aviso de Privacidad</a></p>
			</div>
		</footer>
	</div><!-- end main -->

		<!-- modal ingresa -->
		<div id="ingresa" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body ][ color-light ]">

						<div class="[ bg-primary-darken width-bg margin-auto ][ padding--top-bottom--large ]">
							<button type="button" class="[ close ][ pull-right relative left--20 z-index--100 ]" data-dismiss="modal">
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]" src="<?php echo THEMEPATH; ?>icons/close.svg" alt="icono close">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">Ingresa en tu cuenta de <span class=" [ text-uppercase ]">yolcan</span></p>
									<?php if(isset($_GET['login_error'])): ?>
										<p class="color-light text-center [ border-top--danger--medium border-bottom--danger--medium ][ margin-bottom ][ padding--top-bottom ]">El <strong>Email</strong> o <strong>Contraseña</strong> son incorrectos.</p>
									<?php endif; ?>
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
											<input type="submit" class="button btn btn-lg [ input-btn-secondary ][ margin-bottom--small ]" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
										</p>
										<p class="lost_password [ text-center ]">
											<a class="[ link-light ][ color-light ][ small ]" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
										</p>
										<p class="[ text-center ]">
											<a data-toggle="modal" data-target="#unete" class="[ margin-bottom--small ][ inline-block align-middle ][ btn btn-secondary margin-top--small ]">registrate</a>
										</p>

										<?php do_action( 'woocommerce_login_form_end' ); ?>
									</form>
									<div class="[ text-center ]">
										<p class="[ small sans-serif  ][ color-light ][ inline-block align-middle no-margin ]">Ingresa con</p>
										<button type="submit" class="bt-login-fb [ btn btn-facebook ][ inline-block align-middle margin-left--small ]">
											<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg" alt="icono redes">
											<span class="[ color-light ][ inline-block align-middle ]">Facebook</span>
										</button>
									</div>
								</div>
							</div>
						</div><!-- end bg-primary -->
					</div><!-- end modal-body -->
				</div><!-- end modal-content -->
			</div><!-- end modal-dialog -->
		</div><!-- end modal -->

		<!-- modal unete -->
		<div id="unete" class="[ modal fade ]" role="dialog">
			<?php $nombreCliente = isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '';
			$emailCliente = isset($_POST['emailCliente']) ? $_POST['emailCliente'] : ''; ?>
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body ][ color-light ]">
						<div class="[ bg-primary-darken width-bg margin-auto ][ padding--top-bottom ]">
							<button type="button" class="[ close ][ pull-right relative left--20 z-index--100   ]" data-dismiss="modal">
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]" src="<?php echo THEMEPATH; ?>icons/close.svg"  alt="icono close">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">Ingresa tus datos y comienza a formar parte de la comunidad <span class=" [ text-uppercase ]">yolcan</span></p>
									<?php if(isset($procesoRegistro['error'])): ?>
										<p class="text-danger"><?php echo $procesoRegistro['error']; ?></p>
									<?php endif; ?>
									<form id="form-unete" method="post" class="[ border-bottom--primary--medium ][ margin-bottom ][ text-left ]" data-parsley-validate>
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Nombre</label>
											<input type="text" name="nombreCliente" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-error-message="El nombre es obligatorio." value="<?php echo $nombreCliente ?>">
										</div>
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Correo</label>
											<input type="email" name="emailCliente" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-type-message="La dirección de correo es inválida." data-parsley-required-message="El correo es obligatorio." value="<?php echo $emailCliente ?>">
										</div>
										<div class="[ form-group ]">
											<label class="[ sans-serif ][ no-margin ]">Contraseña</label>
											<input id="password" name="passwordCliente" type="password" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-required-message="Favor de ingresar una contraseña.">
										</div>
										<input type="hidden" name="action" value="create-client">
										<div class="[ text-center ]">
											<input type="submit" class="[ btn btn-lg btn-secondary padding--top-bottom--xsmall ][ margin-bottom ]" value="únete">
										</div>
									</form>
									<div class="[ text-center ]">
										<p class="[ small sans-serif  ][ color-light ][ inline-block align-middle no-margin ]">Ingresa con</p>
										<button type="submit" class="bt-login-fb [ btn btn-facebook ][ inline-block align-middle margin-left--small ]">
											<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>icons/facebook.svg"  alt="icono redes">
											<span class="[ color-light ][ inline-block align-middle ]">Facebook</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- modal ingredientes canastas -->
		<div id="ingredientes" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body modal--horizontal ][ bg-light ][ padding--top-bottom--xxlarge ][ color-light ]">
						<button type="button" class="[ close ][ pull-right relative left--20 z-index--100 ]" data-dismiss="modal">
							<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]" src="<?php echo THEMEPATH; ?>icons/close.svg"  alt="icono close">
						</button>
						<div id="content-ingredientes-canasta">


						</div>

					</div><!-- end modal-body -->
				</div><!-- end modal-content -->
			</div><!-- end modal-dialog -->
		</div><!-- end modal -->

		<!-- modal club de consumo -->
		<div id="club-consumo" class="[ modal fade ]" role="dialog">
			<div class="[ modal-dialog ]">
				<div class="[ modal-content ]">
					<div class="[ modal-body ][ color-light ]">
						<div class="[ bg-primary-darken width-bg margin-auto ][ padding--top-bottom ]">
							<button type="button" class="[ close ][ pull-right relative left--20 z-index--100   ]" data-dismiss="modal">
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]" src="<?php echo THEMEPATH; ?>icons/close.svg"  alt="icono close">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">¿Te interesa crear un club de consumo? Déjanos tus datos y te contactaremos </p>
									<form id="form-club" method="POST" class="[ text-left ]" data-parsley-validate>
										<div class="[ form-group ]">
											<label for="form-crear-club-name" class="[ sans-serif ][ no-margin ]">Nombre</label>
											<input type="text" id="form-crear-club-name" name="form-crear-club-name" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-error-message="El nombre es obligatorio.">
										</div>
										<div class="[ form-group ]">
											<label for="form-crear-club-email" class="[ sans-serif ][ no-margin ]">Correo</label>
											<input type="email" id="form-crear-club-email" name="form-crear-club-email" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-type-message="La dirección de correo es inválida." data-parsley-required-message="El correo es obligatorio.">
										</div>
										<div class="[ form-group ]">
											<label for="form-crear-club-telefono" class="[ sans-serif ][ no-margin ]">Teléfono</label>
											<input type="text" id="form-crear-club-telefono" name="form-crear-club-telefono" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-type="digits" data-parsley-required-message="El teléfono es obligatorio." data-parsley-type-message="Este campo debe ser númerico.">
										</div>
										<div class="[ form-group ]">
											<label for="form-crear-club-ubicacion" class="[ sans-serif ][ no-margin ]">Ubicación del club a crear</label>
											<input type="text" id="form-crear-club-ubicacion" name="form-crear-club-ubicacion" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-error-message="La ubicación es obligatoria.">
										</div>
										<div class="[ form-group ]">
											<label for="form-crear-club-mensaje" class="[ sans-serif ][ no-margin ]">Mensaje</label>
											<textarea id="form-crear-club-mensaje" name="form-crear-club-mensaje" class="[ form-control no-border-radius color-gray-xlight height-30 ]" required data-parsley-required-message="El mensaje es obligatorio."></textarea>
										</div>
										<div class="[ text-center ]">
											<input type="hidden" name="action" value="form-create-club">
											<button type="submit" href="#" class="[ btn btn-lg btn-secondary padding--top-bottom--xsmall ]">enviar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php wp_footer();
		if(isset($_GET['login_error'])) echo "<script> jQuery('#ingresa').modal('show'); </script>";
		if(isset($procesoRegistro['error'])) echo "<script> jQuery('#unete').modal('show'); </script>"; ?>
	</body>
</html>