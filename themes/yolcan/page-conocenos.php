<?php get_header(); 
the_post(); ?>

<div class="[ container ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 ]">
			<h2><strong><?php the_title(); ?></strong></h2>
			<?php the_content(); ?>
		</div>
	</div>
</div>

<section class="[ border-bottom ][ margin-bottom ]">
	<div class="[ container ][ text-center ]">
		<div class="[ row ]">
			<div class="[ col-xs-12 ]">
				<p class="[ fz-xlarge ][ margin-top-bottom ]"><em>Calidad de origen chinampero</em></p>
			</div>
		</div>
		<div class="[ row ]">
			<div class="[ visible-md visible-lg ][ col-md-1 col-lg-1 ]"></div>
			<div class="[ col-xs-6 col-sm-4 col-md-2 ]">
				<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/sign-reuse.svg">
				<h5 class="[  text-semibold ]">Agricultura sustentable</h5>
			</div>
			<div class="[ col-xs-6 col-sm-4 col-md-2 ]">
				<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke icon--thickness-05 icon--fill ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/network-cash.svg">
				<h5 class="[  text-semibold ]">Economía local</h5>
				<div class="[ visible-xs ][ margin-bottom--large ]"></div>
			</div>
			<div class="[ col-xs-6 col-sm-4 col-md-2 ]">
				<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/eco-tag.svg">
				<h5 class="[  text-semibold ]">Consumo ecológicamente responsable</h5>
			</div>
			<div class="[ col-xs-6 col-sm-4 col-sm-offset-1  col-md-2 col-md-offset-0 ]">
				<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/sign-recycle.svg">
				<h5 class="[  text-semibold ]">Rescate de la reserva de Cuemanco, Xochimilco</h5>
				<div class="[ visible-xs ][ margin-bottom--large ]"></div>
			</div>
			<div class="[ visible-sm ][ col-sm-1 ]"></div>
			<div class="[ col-xs-10 col-xs-offset-1  col-sm-4 col-sm-offset-1  col-md-2 col-md-offset-0 ]">
				<img class="[ svg ][ icon icon--iconed--xxlarge icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/tool-gardening.svg">
				<h5 class="[  text-semibold ]">Comercio justo y apoyo a los agricultores locales</h5>
			</div>
		</div>
	</div>
</section>

<section class="[ container ][ text-center ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-6 col-md-4 col-md-offset-1 ]">
			<img class="[ svg icon--iconed--xxxlarge icon--thickness-1 icon--stroke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/basket.svg">
			<p class="[ text-left ]">Ofrecemos canastas con productos orgánicos de temporada. son frutas y verduras orgánicas, producidos por Yolcan y su red de pequeños productores.</p>
			<a data-toggle="modal" data-target="#unete" class="[ btn btn-secondary ][ margin-bottom ]">únete</a>
		</div>
		<div class="[ col-xs-12 col-sm-6 col-md-4 col-md-offset-1 ]">
			<img class="[ svg icon--iconed--xxxlarge icon--thickness-1 icon--stoke ][ color-secondary ]" src="<?php echo THEMEPATH; ?>images/icons/chinampa.svg">
			<p class="[ text-left ]">Ofrecemos canastas con productos orgánicos de temporada. son frutas y verduras orgánicas, producidos por Yolcan y su red de pequeños productores.</p>
			<div class="[ col-xs-12 ]">
				<a href="visitanos-html" class="[ btn btn-secondary ][ margin-bottom ]">visítanos</a>
			</div>
		</div>
	</div>
</section>

<!-- Consumir local -->
<div class="[ bg-primary-darken ][ margin-top--large margin-bottom ]">
	<div class="[ container ]">
		<div class="[ row ][ color-light ]">
			<div class="[ col-xs-12 ]">
				<h2>Consumir local</h2>
				<p>En <span class="[ text-uppercase ]">Yolcan</span> somos partidarios del comercio local, ya que se beneficia la economía de la comunidad, se generan empleos y se reactiva la actividad agrícola en el distrito Federal.</p>
				<div class="[ hidden-xs ][ margin-bottom--large ]"></div>
			</div>
			<!-- Charts.js -->
			<div class="[ col-sm-7 col-lg-6 ][ text-center ][ margin-bottom ]">
				<p class="[ margin-bottom--large ]"> Los productos cultivaddos con métodos de agricultura intensiva son más baratos porque contienen químicos que dañarán tu salud y la de tu familia.</p>
				<div class="[ margin-bottom ]">
					<div class="[ inline-block ][ margin-sides--small ]">
						<canvas id="mycanvas" width="150%" height="150%"></canvas>
						<p class="[ color-tertiary ][ fz-medium ]">$46 Productos locales</p>
					</div>
					<div class="[ inline-block ][ margin-sides--small ]">
						<canvas id="mycanvas1" width="150%" height="150%" class="[ margin-left--small ]"></canvas>
						<p class="[ color-quaternary ][ fz-medium ]">$14 Macro tiendas</p>
					</div>
				</div>
			</div>
			<div class="[ col-xs-12 col-sm-5 col-lg-4 col-lg-offset-1 ] ">
				<ul class="[ no-padding--left ][ list-inside ]">
					<li class="[ margin-bottom ]">Comprando productos locales estás apoyando a los productores de tu comunidad.</li>
					<li class="[ margin-bottom ]">Los productos cultivados cin étodos de agricultura intensiva son más baratos, pero contienen químicos que dañarán tu salud y la de tu familia</li>
					<li class="[ margin-bottom ]">Estudios revelan que por cada $1oo pesos gastados en productos locales, $46 regresan a la comunidad, mientras que del consumo de macro tiendas, solamente $14 pesos regresan a la misma.</li>
				</ul>
			</div>
		</div><!--/row-->
	</div>
</div>
		

<?php get_footer(); ?>