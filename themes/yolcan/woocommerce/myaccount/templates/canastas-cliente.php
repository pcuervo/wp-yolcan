<?php global $current_user;
global $opCliente;
global $clubCanasta;

$costoSemanal = isset($clubCanasta->attr_variation->costoSemanal) ? $clubCanasta->attr_variation->costoSemanal : 0;
$adicionalesAgregados = isset($clubCanasta->adicionalesAgregados) ? $clubCanasta->adicionalesAgregados : array();
$totalAdicionales = isset($adicionalesAgregados['total_adicionales']) ? getTotalAdicionalesSemana($adicionalesAgregados) : 0; ?>
<span id="productos-canasta"></span>
<article class="[ padding--bottom border-bottom margin-bottom ]">

	<!-- PROCIMA CANASTA -->

	<h4>Tu próxima canasta - <span class="[ color-primary ]">$<?php echo number_format($costoSemanal, 2, ".", ",");?></span></h4>
	<p><?php echo isset($clubCanasta->producto_name) ? $clubCanasta->producto_name : ''; ?> para el 10 de junio:</p>
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

	<!-- ADICIONALES AGREGADOS -->

	<h5>Productos agregados: <span class="[ color-primary ]"> $<?php echo number_format($totalAdicionales, 2, ".", ","); ?></span> </h5>

	<ul class="[ list-style-none ][ padding--left ]">
		<?php if (! empty($adicionalesAgregados)):
			foreach ($adicionalesAgregados['ingredientes'] as $key => $ingrediente):
				$terms = wp_get_post_terms( $ingrediente['ingredienteID'], 'unidades' );
				$unidad = isset($terms[0]) ? $terms[0]->name : '';
				$entrega_adicional = $ingrediente['toca-quincenal'] == 0 ? 'En esta semana no se entrega este ingrediente hasta la próxima' : '';?>
				<li>
		            - <?php echo get_the_title($ingrediente['ingredienteID']); ?> <strong> ( <?php echo $ingrediente['cantidad'].' '.$unidad; ?> )</strong> - $ <?php echo number_format($ingrediente['total']); ?> </span>
		            <small>
		            	<form action="" method="post" class="form-delete-aditional">
		            		<input type="hidden" name="adicional_id" value="<?php echo $ingrediente['ingredienteID']; ?>">
		            		<input type="hidden" name="action" value="delete-aditional">
		            		<input type="submit" value="- Eliminar">
		            	</form>
		            </small>

		           <small>* <?php echo $ingrediente['periodo']; ?> <span class="color-danger"><?php echo $entrega_adicional ; ?></span></small>
		        </li>
			<?php endforeach;
		else:
			echo '<p>No hay ingredientes adicionales</p>';
		endif; ?>

	</ul>
	<h5>Total a descontar el proximo corte: <span class="[ color-danger ]">$<?php echo number_format($totalAdicionales + $costoSemanal, 2, ".", ","); ?></span>  </h5>

	<a href="<?php echo site_url('/recetas/'); ?>" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
</article>

<!-- AGREGAR ADICIONALES -->

<article class="">

	<h4>Agrega productos</h4>
	<?php if (!empty($clubCanasta->adicionales) AND $costoSemanal < $opCliente->saldo):
		$saldoDisponible = ( $opCliente->saldo - $costoSemanal ) - $totalAdicionales; ?>
		<h5>Saldo disponible para adicionales <strong class="[ color-primary ]">$<?php echo number_format($saldoDisponible, 2, ".", ",");?></strong></h5>
		<input type="hidden" id="saldo-libre" value="<?php echo $saldoDisponible; ?>">

		<p>Selecciona los productos que deseas agregar a tu canasta:</p>
		<?php foreach($clubCanasta->adicionales as $adicional):
			$precio = get_post_meta($adicional->ingrediente_id, 'valor_en_puntos', true);
			if ($precio != ''):
				$terms = wp_get_post_terms( $adicional->ingrediente_id, 'unidades' );
				$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
	            <form method="post" class="add-additional" id="add-aditional-<?php echo $adicional->ingrediente_id; ?>" action="#productos-canasta">
	            	<input type="hidden" id="adicional-id" name="adicional-id" value="<?php echo $adicional->ingrediente_id; ?>">

					<div class="[ margin-bottom ]">
						<a data-toggle="collapse" href="#ingrediente<?php echo $adicional->ingrediente_id; ?>" class="[ no-decoration color-dark color-dark-hover ]">
							<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
							<p class="[ inline-block align-middle ][ no-margin ]"><?php echo get_the_title($adicional->ingrediente_id); ?> ( <?php echo $unidad; ?> )</p>
						</a>
						<div id="ingrediente<?php echo $adicional->ingrediente_id; ?>" class="[ panel-collapse collapse ][ padding--top ]">
							<p class="[ color-gray-xlight ]">Precio: $ <?php echo $precio != '' ? $precio : 0; ?>
		                        <input type="hidden" id="adicional-costo-<?php echo $adicional->ingrediente_id; ?>" name="adicional-costo" value="<?php echo $precio != '' ? $precio : 0; ?>">
		                    <br>Cantidad: </p>
							<div class="[ row ]">
								<div class="[ col-xs-3 padding--right--small ]">
									<input type="number" id="numero-productos-<?php echo $adicional->ingrediente_id; ?>" name="adicional-numero-productos" value="1" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
								</div>
								<div class="[ col-xs-5 no-padding ]">
									<div>
										<input type="radio" id="option<?php echo $adicional->ingrediente_id; ?>1" name="adicional-periodo" value="Sólo esta ocación" checked>
										<label for="option<?php echo $adicional->ingrediente_id; ?>1"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
									</div>
									<div>
										<input type="radio" id="option<?php echo $adicional->ingrediente_id; ?>2" name="adicional-periodo" value="Cada semana">
										<label for="option<?php echo $adicional->ingrediente_id; ?>2"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
									</div>
									<div>
										<input type="radio" id="option<?php echo $adicional->ingrediente_id; ?>3" name="adicional-periodo" value="Cada 15 dias">
										<label for="option<?php echo $adicional->ingrediente_id; ?>3"><span class="[ margin-right--xxsmall ]"></span> Cada 15 dias</label>
									</div>
								</div>
								<input type="hidden" name="action" value="save-additional-ingredient">
								<div class="[ col-xs-4 padding--left--small ]">
		                            <input type="submit" name="padicional" id="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]" value="agregar"/>
								</div>
							</div>
						</div>
					</div>
				</form>

            <?php endif;
		endforeach; ?>

	<?php elseif($costoSemanal >= $opCliente->saldo): ?>
		<p>No cuenta con el saldo sufuciente para agregar adicionales</p>
	<?php else: ?>
		<p>El club aún no cuenta con productos adicionales</p>
	<?php endif; ?>
</article> <!-- /forms -->