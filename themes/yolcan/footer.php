<footer class="[ bg-primary-darken ][ text-center ][ color-gray-xxlight ]">
			<div class="[ container ]">
				<div class="[ row ]">
						<div class="[ col-sm-3 no-padding--right no-padding--left ]">
							<h3><em>Contacto</em></h3>
							<!-- Contacto: social-media -->
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]"  href="tel:+525552555555">
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/phone-5.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">555555-5555</span>
							</a>
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href=""><!-- whatsapp://send?abid=username&text=Hola --><!-- href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share" -->
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/logo-whatsapp.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">555555-5555</span>
							</a>
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="mailto:contacto@yolcan.com">
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/email.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">contacto@yolcan.com</span>
							</a>
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.facebook.com/Yolcan-190099034343351/">
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/facebook.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">/yolcan</span>
							</a>
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://twitter.com/michinampa">
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/twitter.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@yolcan</span>
							</a>
							<a class="[ social-media ][ color-light color-secondary--hover no-decoration ]" href="https://www.instagram.com/yolcan/">
								<img class="[ svg icon icon--iconed--xlarge icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/logo-instagram.svg">
								<span class="[ hidden-xs ][ margin-left--small ][ inline-block align-middle ]">@yolcan</span>
							</a>
						</div>
						<div class="[ col-sm-4 col-md-3 ]">
							<h3><em>Únete</em></h3>
							<div class="[ margin-bottom ]">
								<a data-toggle="modal" data-target="#unete" class="[ inline-block align-middle ][ btn btn-secondary margin-top--small ]">registrate</a>
								<a href="visitanos.html#agenda" class="[ inline-block align-middle ][ btn btn-secondary ][ margin-top--small ]">agenda una cita</a>
							</div>
						</div>
						<div class="[ col-sm-2 col-md-3 ]">
							<h3><em>Métodos de pago</em></h3>
							<div class="[ row ]">
								<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>images/icons/visa.svg" alt="">
								<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>images/icons/paypal.svg" alt="">
								<img class="[ icon icon--iconed--xxxlarge ][ margin-sides--small ]" src="<?php echo THEMEPATH; ?>images/icons/mastercard.svg" alt="">
							</div>
						</div>
						<div class="[ col-sm-3 ]">
							<h3><em>Newsletter</em></h3>
							<div class="[ text-left ]">
								<p>Recibe las últimas noticias y ofertas antes que nadie, déjanos tu correo.</p>
								<form class="[ margin-bottom ][ hidden-xs ]">
									<div class="[ form-group ]">
										<input type="text" class="[ form-control ][ no-border-radius ][ margin-bottom--small ]">
										<button type="submit" href="#" class="[ btn btn-secondary ][ no-margin ]">suscribirme</button>
									</div>
								</form>
							</div>
							<!-- input inline -->
							<div class="[ visible-xs ]">
								<form class="[ input-group ]">
									<input type="text" class="[ form-control ][ no-border-radius ]">
									<span class="[ input-group-btn ]">
										<button class="[ input-search--button ][ btn btn-secondary ]" type="submit">
											suscribirme
										</button>
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
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]"src="<?php echo THEMEPATH; ?>images/icons/close.svg">
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
												<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/facebook.svg">
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
								<img class="[ svg ][ icon icon--iconed--normal icon--stroke icon--thickness-2 ][ color-secondary ][ absolute right-25 ]"src="<?php echo THEMEPATH; ?>images/icons/close.svg">
							</button>
							<div class="[ row ]">
								<div class="[ col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 ]">
									<h2 class="[ text-center ][ no-margin--top ]">¡Bienvenido!</h2>
									<p class="[ text-center ]">Ingresa en tu cuenta de <span class=" [ text-uppercase ]">yolcan</span></p>
									<form class="[ border-bottom--primary--medium ][ margin-bottom ][ text-left ]">
										<div class="[ form-group ]">
											<label class="[ sans-serif ]">Usuario</label>
											<input type="text" class="[ form-control no-border-radius color-gray-xlight height-30 ]">
										</div>
										<div class="[ form-group ]">
											<label class="[ sans-serif ]">Contraseña</label>
											<input type="password" class="[ form-control no-border-radius color-gray-xlight height-30 ]">
										</div>
										<div class="[ text-center ][ margin-bottom ]">
											<button type="submit" href="#" class="[ btn btn-secondary padding--top-bottom--xsmall ]">ingresa</button>
										</div>
										<p class="[ text-center ][ margin-bottom ][ small sans-serif ]">¿Olvidaste tu contraseña?</p>
										<div class="[ text-center ]">
											<button type="submit" href="#" class="[ btn btn-secondary padding--top-bottom--xsmall ][ margin-bottom ]">crear cuenta</button>
										</div>
									</form>
									<div class="[ text-center ]">
										<a href="https://www.facebook.com">
											<p class="[ small sans-serif  ][ color-light ][ inline-block align-middle no-margin ]">Ingresa con</p>
											<button type="submit" href="#" class="[ btn btn-facebook ][ inline-block align-middle margin-left--small ]">
												<img class="[ svg icon icon--iconed--normal icon--thickness-3 icon--fill ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/facebook.svg">
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

		<?php wp_footer(); ?>

	</body>
</html>