<?php global $current_user; 
global $opCliente;
global $clubCanasta;
$costoSemanal = isset($clubCanasta->attr_variation->costoSemanal) ? $clubCanasta->attr_variation->costoSemanal : 0; ?>
<span id="productos-canasta"></span>
<article class="[ padding--bottom border-bottom margin-bottom ]">
	<h4>Tu próxima canasta - <span class="[ color-primary ]">$<?php echo $costoSemanal;?></span></h4>
	<p><?php echo $clubCanasta->producto_name; ?> para el 10 de junio:</p>
	<h5>Ingredientes:</h5>
	<ul class="[ list-style-none ][ padding--left ]">
		<?php if (!empty($clubCanasta->ingredientes)):
			foreach ($clubCanasta->ingredientes as $key => $ingrediente): 
				$terms = wp_get_post_terms( $ingrediente->ingrediente_id, 'unidades' );
				$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
				<li>
					- <?php echo get_the_title($ingrediente->ingrediente_id); ?> ( <?php echo $ingrediente->cantidad.' '.$unidad; ?> )
				</li>
			<?php endforeach;
		else:
			echo '<p>Aun no hay ingredientes</p>';
		endif; ?>
	</ul>

	<h5>Productos agregados:</h5>
	<div class="[ margin-botton ]">
		<p>
            <span>
                <?php 
                $padicionalnombre = get_post_meta($current_user->ID, 'padicionalnombre', true);
                $padicionalprecio = get_post_meta($current_user->ID, 'padicionalprecio', true);
                $padicionalpeso = get_post_meta($current_user->ID, 'padicionalpeso', true);
                $padicionaltipo = get_post_meta($current_user->ID, 'padicionaltipo', true);
                $padicionalnumber = get_post_meta($current_user->ID, 'padicionalnumber', true);
                $padicionalocasion = get_post_meta($current_user->ID, 'padicionalocasion', true);
                ?>
                <?php echo $padicionalnumber; ?> | <?php echo $padicionalnombre; ?> - <?php echo $padicionalpeso; ?> <?php echo $padicionaltipo; ?> - $ <?php echo $padicionalprecio; ?>.00 | <?php echo $padicionalocasion; ?></span> 
            <small><a class="[ underline ][ color-secondary ]" href="#">eliminar</a></small>
        </p>
	</div>

	<a href="<?php echo site_url('/recetas/'); ?>" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
</article>

<article class="">
	<h4>Agrega productos</h4>
	<?php if (!empty($clubCanasta->adicionales) AND $costoSemanal < $opCliente->saldo): ?>
		
		<p>Selecciona los productos que deseas agregar a tu canasta:</p>
		<form method="post" id="contactus_form" action="#productos-canasta">
			<?php foreach($clubCanasta->adicionales as $adicional): 
				$precio = get_post_meta($adicional->ingrediente_id, 'valor_en_puntos', true);
				$terms = wp_get_post_terms( $adicional->ingrediente_id, 'unidades' );
				$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
	            
				<div class="[ margin-bottom ]">
					<a data-toggle="collapse" href="#ingrediente<?php echo $adicional->ingrediente_id; ?>" class="[ no-decoration color-dark color-dark-hover ]">
						<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
						<p class="[ inline-block align-middle ][ no-margin ]"><?php echo get_the_title($adicional->ingrediente_id); ?> ( <?php echo $unidad; ?> )</p>
	                    <input type="hidden" name="padicionalnombre" value="<?php echo get_the_title($adicional->ingrediente_id); ?>">
					</a>
					<div id="ingrediente<?php echo $adicional->ingrediente_id; ?>" class="[ panel-collapse collapse ][ padding--top ]">
						<p class="[ color-gray-xlight ]">Precio: $ <?php echo $precio != '' ? number_format($precio) : 0; ?>
	                        <input type="hidden" name="padicionalprecio" value="<?php echo $precio != '' ? number_format($precio) : 0; ?>">
	                    <br>Cantidad: </p>
	                        <input type="hidden" name="padicionalpeso" value="">
	                        <input type="hidden" name="padicionaltipo" value="">
						<div class="[ row ]">
							<div class="[ col-xs-3 padding--right--small ]">
								<input type="number" name="padicionalnumber" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
							</div>
							<div class="[ col-xs-5 no-padding ]">
								<div>
									<input type="radio" id="option<?php echo $adicional->ingrediente_id; ?>1" name="padicionalocasion" value="Sólo esta ocación">
									<label for="option<?php echo $adicional->ingrediente_id; ?>1"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
								</div>
								<div>
									<input type="radio" id="option<?php echo $adicional->ingrediente_id; ?>2" name="padicionalocasion" value="Cada semana">
									<label for="option<?php echo $adicional->ingrediente_id; ?>2"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
								</div>
							</div>
							<div class="[ col-xs-4 padding--left--small ]">
	                            <input type="submit" name="padicional" id="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]" value="agregar"/>
							</div>
						</div>
					</div>
				</div>
	            
			<?php endforeach; ?>
		</form>
	<?php elseif($costoSemanal >= $opCliente->saldo): ?>
		<p>No cuenta con el saldo sufuciente para agregar adicionales</p>
	<?php else: ?> 
		<p>El clube a un no cuenta con productos adicionales</p>
	<?php endif; ?>
</article> <!-- /forms -->