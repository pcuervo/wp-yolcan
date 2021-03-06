<?php get_header();
the_post();
global $result;

if( isset( $result['success'] ) ): ?>
	<br>
	<br>
	<br>
	<div class="[ bg-success btn-lg text-center ]"><?php echo $result['success']; ?></div>
<?php endif;  ?>

	<section class="[ container ]">
		<h1 class="[ h2 text-center ]"><?php the_title(); ?></h1>
		<h3 class="[ text-center ]"><em>Vive la experiencia chinampera</em></h3>
		<div class="[ user-content--visitas ]">
			<?php
				the_post_thumbnail('large');
				the_content();
			?>
		</div>
		<div class="[ row ]">
			<article class="[ col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 ][ margin-top  ]">
				<div class="[ row ][ text-center ]">
					<div class="[ col-xs-3 padding--sides--xsmall col-sm-4 ]">
						<p class="[ fz-18 ][ no-margin ]"><strong>Costo</strong></p>
						<p class="[ fz-16 ]"><?php echo get_post_meta($post->ID, 'costo_visita', true); ?></p>
					</div>
					<div class="[ col-xs-4 padding--sides--xsmall col-sm-4 ]">
						<p class="[ fz-18 ][ no-margin ]"><strong>Capacidad</strong></p>
						<p class="[ fz-16 ]"><?php echo get_post_meta($post->ID, 'capacidad_visita', true); ?></p>
					</div>
					<div class="[ col-xs-5 padding--sides--xsmall col-sm-4 ]">
						<p class="[ fz-18 ][ no-margin ]"><strong>Persona extra</strong></p>
						<p class="[ fz-16 ][ no-margin ]"><?php echo get_post_meta($post->ID, 'persona_extra_visita', true); ?></p>
						<p class="[ fz-16 ]"><?php echo get_post_meta($post->ID, 'persona_extra_visita_2', true); ?></p>
					</div>
					<div class="[ visible-sm ][ margin-bottom ]"></div>
				</div>
				<div class="[ col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 ]">
					<p class="[ lead ]" id="agenda">Agenda tu visita</p>
					<form id="agenda-visita" name="agendavisita" method="POST" action="">
						<div class="[ form-group ][ color-gray-xlight ]">
							<label>Nombre</label>
							<input name="nombre_visita" id="nombre_visita" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
						</div>
						<div class="[ row ]">
							<div class="[ col-xs-12 col-sm-6  padding--right--small--sm ][ form-group ][ color-gray-xlight ]">
								<label>Correo</label>
								<input name="email_visita" id="email_visita" type="email" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
							</div>
							<div class="[ col-xs-12 col-sm-6 padding--left--small--sm ][ form-group ][ color-gray-xlight ]">
								<label>Teléfono</label>
								<input name="telefono_visita" id="telefono_visita" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
							</div>
						</div>
						<div class="[ row ]">
							<div class="[ col-xs-6 padding--right--small ][ form-group ][ color-gray-xlight ]">
								<label class="[ hidden-xs ]">Número de personas</label>
								<label class="[ visible-xs ]">No. de personas</label>
								<input name="n_personas_visita" id="n_personas_visita" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]">
							</div>
							<div class="[ col-xs-6 padding--left--small ][ form-group ][ color-gray-xlight ]">
								<label>Fecha</label>
								<input name="fecha_visita" id="fecha_visita" type="text" class="[ form-control bg-gray no-border-radius color-gray-xlight ]" placeholder="yyyy/mm/dd">
							</div>
						</div>
						<input type="hidden" name="action" value="set-agenda-visita">
						<div class="[ text-center ]">
							<button type="submit" href="#" class="[ btn btn-secondary ]">enviar</button>
						</div>
					</form>
				</div>
			</article>
		</div>
	</section>

	<section class="[ container ]">
		<h2 class="[ text-center ]">Xochimilco</h2>
		<div class="[ user-content--visitas ]">
			<p>
			<?php
			$xochimilco = get_page_by_path('xochimilco');
			echo $xochimilco->post_content;
			?></p>
		</div>
	</section>

<?php get_footer(); ?>