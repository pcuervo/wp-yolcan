<?php get_header(); 
the_post(); 

global $result;

if( isset( $result['success'] ) ): ?>
	<br>
	<br>
	<br>
	<div class="[ bg-success btn-lg text-center ]"><?php echo $result['success']; ?></div>
<?php endif;  ?>

<div class="[ hidden-xs ][ [ margin-bottom--large ]"></div>
<div class="[ container ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 ]">
			<h2 class="[ fz-large ][ margin-bottom ]"><strong>Contáctanos</strong></h2>
		</div>
	</div>

	<section class="[ row ]">
		<form id="formcontacto" name="formcontacto" method="POST" action="" class="[ col-sm-6 ][ margin-bottom--large ]">
			<div class="[ form-group ][ color-gray-xlight ]">
				<label>Nombre</label>
				<input name="nombre_contacto" id="nombre_contacto" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
			</div>
			<div class="[ form-group ][ color-gray-xlight ]">
				<label>Correo</label>
				<input name="correo_contacto" id="correo_contacto" type="email" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
			</div>
			<div class="[ form-group ][ color-gray-xlight ]">
				<label>Teléfono</label>
				<input  name="telefono_contacto" id="telefono_contacto" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
			</div>
			<div class="[ form-group ][ color-gray-xlight ]">
				<label>Mensaje</label>
				<textarea  name="mensaje_contacto" id="mensaje_contacto"  class="[ form-control ][ bg-gray no-border-radius color-gray-xlight ]" rows="4"></textarea>
			</div>
			<input type="hidden" name="action" value="set-contacto">
			<div class="[ text-center ]">
				<button type="submit" href="#" class="[ btn btn-secondary ][ margin-bottom ]">enviar</button>
			</div>
		</form>
		<div class="[ col-sm-6 ]">
			<p class="[ lead ]">Aquí nos ubicamos</p>
			<div class="[ width-100 ][ margin-bottom ] ">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120545.72417001169!2d-99.15076015455304!3d19.23648343297052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce038c6de8dea3%3A0x9b79f71fdabd5384!2sXochimilco%2C+D.F.!5e0!3m2!1ses!2smx!4v1450738593739" width="100%" height="215px" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>