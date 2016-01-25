<?php get_header(); ?>

<div class="[ container ]">
	<!-- video	-->
	<div class="[ row ]"></div>
	<div class="[ row ][ margin-top ]">
		<div class="[ col-xs-12 col-sm-8 col-sm-offset-2 ]">
			<div class="[ js-video-wrapper ]">
				<iframe class="[ embed-responsive-item ]" src="https://www.youtube.com/embed/HCj_EUKAis4" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>

	<div class="[ row ]">
		<div class="[ col-xs-12 ]">
			<h2 class="[ text-center ][ margin-top-bottom ][ ff-bree-serif ]"><em>Calidad de origen chinampero</em></h2>
		</div>
	</div>

	<div class="[ row ][ visible-xs ]">
		<!-- banner	movil-->
		<div class="[ col-sm-6 ][ bg-image rectangle ][ padding ][ color-light text-shadow ]" style="background-image: url('<?php echo THEMEPATH; ?>images/IMG_1023.jpg');">
			<h2 class="[ no-margin ]">Canastas de verduras y frutas organicas a domicilio</h2>
			<div class="[ btn-absolute-bottom ]">
				<div class="[ text-center ]" >
					<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ]">únete</button></a>
					<a href="nuestros-productos.html" ><button class="[ btn btn-primary-darken ]">¿cómo funciona?</button></a>
				</div>
			</div>
		</div>
		<div class="[ col-sm-6 ][ bg-image rectangle ][ padding ][ color-light text-shadow ][ margin-top ]" style="background-image: url('<?php echo THEMEPATH; ?>images/_DSC0010.jpg');">
			<h2 class="[ no-margin ]">Conoce como se cosechan nuestros productos y a quienes los producen</h2>
			<div class="[ text-center ]" >
				<div class="[ btn-absolute-bottom ]">
					<a href="<?php echo site_url('/visitanos/'); ?>" ><button class="[ btn btn-secondary ]">visítanos</button></a>
				</div>
			</div>
		</div>
	</div>
	<div class="[ row ][ hidden-xs ]">
		<!-- banner	desktop -->
		<div class="[ col-sm-6 ]">
			<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ][ margin-top ]" style="background-image: url('<?php echo THEMEPATH; ?>images/IMG_1023.jpg');">
				<h2>Canastas de verduras y frutas organicas a domicilio</h2>
				<div class="[ btn-absolute-bottom ]">
					<div class="[ text-center ]" >
						<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ]">únete</button></a>
						<a href="<?php echo site_url('/conocenos/') ?>" ><button class="[ btn btn-primary-darken ]">¿cómo funciona?</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="[ col-sm-6 ]">
			<div class="[ bg-image rectangle ][ padding ][ color-light text-shadow ][ margin-top ]" style="background-image: url('<?php echo THEMEPATH; ?>images/_DSC0010.jpg');">
				<h2>Conoce como se cosechan nuestros productos y a quienes los producen</h2>
				<div class="[ text-center ]" >
					<div class="[ btn-absolute-bottom ]">
						<a href="<?php echo site_url('/visitanos/') ?>" ><button class="[ btn btn-secondary ]">visítanos</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- entradas -->
	<div class="[ row ][ margin-top ]">
		<div class="[ col-xs-12 ][ col-sm-4 ][ margin-top ]">
			<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'post' ), 'orderby' => 'rand' ) );

			if ( $entrada->have_posts() ) :
				while ( $entrada->have_posts() ) : 
					$entrada->the_post();
					$url_img = attachment_image_url($post->ID, 'large'); ?>
					
					<a href="<?php the_permalink() ?>">
						<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
							<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
						</div>
					</a>
				<?php endwhile;
			endif; ?>
			
		</div>
		<div class="[ col-xs-12 ][ col-sm-4 ][ margin-top ]">
			<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'recetas' ), 'orderby' => 'rand' ) );

			if ( $entrada->have_posts() ) :
				while ( $entrada->have_posts() ) : 
					$entrada->the_post();
					$url_img = attachment_image_url($post->ID, 'large'); ?>
					
					<a href="<?php the_permalink() ?>">
						<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
							<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
						</div>
					</a>
				<?php endwhile;
			endif; ?>
			
		</div>
		<div class="[ col-xs-12 ][ col-sm-4 ][ margin-top ]">
			<?php $entrada = new WP_Query( array('posts_per_page' => 1, 'post_type' => array( 'ingredientes' ), 'orderby' => 'rand' ) );

			if ( $entrada->have_posts() ) :
				while ( $entrada->have_posts() ) : 
					$entrada->the_post();
					$url_img = attachment_image_url($post->ID, 'large'); ?>
					
					<a href="<?php echo site_url('/recetas/').'?ingrediente='.$post->post_name;; ?>">
						<div class="[ bg-image rectangle-small ][ color-light text-shadow ]" style="background-image: url('<?php echo $url_img; ?>');">
							<h2 class="[ no-margin ][ center-full ][ width-90 ][ text-center text-xbold ]"><?php the_title(); ?></h2>
						</div>
					</a>
				<?php endwhile;
			endif; ?>
		</div>
	</div>
</div> <!--/container-->

<!-- Consumir local -->
<div class="[ bg-primary-darken ][ margin-top--large ]">
	<div class="[ container ]">
		<div class="[ row ][ color-light ]">
			<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
				<h2>Consumir local</h2>
				<p class="[ lead ]"><i>Comprando productos locales estas apoyando a los productorores de tu comunidad.</i></p>
				<p class="[ margin-bottom--large ]"> Los productos cultivados con métodos de agricultura intensiva son más baratos porque contienen químicos que dañarán tu salud y la de tu familia.</p>
			</div>
			<div class="[ visible-xs ][ margin-bottom--large ]"></div>
			<!-- Charts.js -->
			<div class="[ col-sm-8 ][ text-center ][ margin-bottom ]">
				<div class="[ margin-bottom ]">
					<div class="[ inline-block ][ margin-sides--small ]">
						<canvas id="mycanvas" width="130%" height="130%"></canvas>
						<p class="[ color-tertiary ][ lead ]">$46 Productos locales</p>
					</div>
					<div class="[ inline-block ][ margin-sides--small ]">
						<canvas id="mycanvas1" width="130%" height="130%" class="[ margin-left--small ]"></canvas>
						<p class="[ color-quaternary ][ lead ]">$14 Macro tiendas</p>
					</div>
				</div>
			</div>
			<div class="[ col-sm-4 ][ text-center ][ margin-bottom ]">
				<p class="[ margin-bottom--large ]">Por cada $100 pesos gastados en productos locales, $46 regresan a la comunidad mientras que del consumo de macrotiendas, solamente $14 pesos regresan a la misma.</p>
			</div>
		</div><!--/row-->
	</div>
</div>

<div class="[ container ]">
	<div class="row">
		<div class="[ col-xs-12 ]">
			<h2> Clubes de consumo</h2>
		</div>
		<div class="[ col-xs-12 col-sm-5 ]">
			<div class="[ margin-bottom ]">
				<p> Texto explicativo Qua enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum mellius?</p>
			</div>
			<div class="[  ][ hidden-xs ]">
				<div class="[ text-center ]">
					<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ][ margin-top-bottom padding ]">únete</button></a>
				</div>
				<p>Si quieres armar un nuevo club de consumo, haz
					<a class="[ color-primary-darken ]" href=""><i><u>click aquí</u></i></a>
				</p>
			</div>
		</div>
		<div class="[ col-xs-12 col-sm-7 ]">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120545.72417001169!2d-99.15076015455304!3d19.23648343297052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce038c6de8dea3%3A0x9b79f71fdabd5384!2sXochimilco%2C+D.F.!5e0!3m2!1ses!2smx!4v1450738593739" width="100%" height="215px" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="[ col-xs-12 ][ visible-xs ]">
			<div class="[ text-center ]">
				<a data-toggle="modal" data-target="#unete" ><button class="[ btn btn-secondary ][ margin-top-bottom ]">únete</button></a>
			</div>
			<p class="[ color-gray-xlight ]">Si quieres armar un nuevo club de consumo, haz
				<a class="[ color-gray-xlight ]" href=""><i><u>click aquí</u></i></a>
			</p>
		</div>
	</div>
</div>

<!--Clubes de consumo-->
<div class="[ bg-secondary ][ margin-top ]">
	<div class="[ container ]">
		<div class="[ row ][ color-light ][ padding-bottom--large ]">
			<div class="[ col-xs-12 ]">
				<h2>Beneficios</h2>
			</div>
			<div class="[ col-xs-12  col-sm-3 ]">
				<div class="[ text-center ]">
					<img class="[ margin-top ][ svg icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/apple-1.svg">
					<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i>Productos frescos</i></h3>
				</div>
				<p>Contamos con una frescura inigualable ya que nuestros productos pasan menos de 24 horas desde que se cosechan, hasta que llegan a su destino final.</p>
			</div>
			<div class="[ col-xs-12 col-sm-3 ][ margin-bottom ]">
				<div class="[ text-center ]">
					<img class="[ margin-top ][ svg icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/salt-pepper-.svg">
					<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i>Sabor</i></h3>
				</div>
				<p>El sabor auténtico es la calidad de primera debido a que utilizamos una muestra de sistemas tradicionales de cultivo, con técnicas de agricultura orgánica moderna.</p>
			</div>
			<div class="[ col-xs-12 col-sm-3 ][ margin-bottom ]">
				<div class="[ text-center ]">
					<img class="[ margin-top ][ svg icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]" src="<?php echo THEMEPATH; ?>images/icons/color-contrast-off.svg">
					<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i>Libres de químicos</i></h3>
				</div>
				<p>Contamos con una frescura inigualable ya que nuestros productos pasan menos de 24 horas desde que se cosechan, hasta que llegan a su destino final.</p>
			</div>
			<div class="[ col-xs-12 col-sm-3 ][ margin-bottom ]">
				<div class="[ text-center ]">
					<img class="[ margin-top ][ svg icon--stroke icon--iconed--xxxlarge icon--thickness-1 ][ color-light ]"src="<?php echo THEMEPATH; ?>images/icons/dining-set.svg">
					<h3 class="[ text-center fz-large ][ margin-top-bottom--xsmall ]"><i>Nutrición y Salud</i></h3>
				</div>
				<p>Los alimentos naturales tienen un mayor valor nutritivo (mayores porcentajes de vitaminas y minerales) ya que se producen respetando los tiempos de crecimiento, lo cual permite sintetizar los nutrientes des suelo y los azúcares.</p>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>