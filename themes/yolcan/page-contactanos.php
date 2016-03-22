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
				<?php $latitud_contacto = get_post_meta($post->ID, 'latitud_contacto', true);
				$longitud_contacto = get_post_meta($post->ID, 'longitud_contacto', true); ?>
				<iframe width="100%" height="215px" frameborder="0" style="border:0" allowfullscreen src="https://maps.google.com/maps?q=<?php echo $latitud_contacto ?>,<?php echo $longitud_contacto ?>&hl=es;z=14&amp;output=embed"></iframe>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>