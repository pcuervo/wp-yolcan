<?php $user = get_user_by( 'id', $cliente->cliente_id ); 
$producto_id = wp_get_post_parent_id( $cliente->producto_id );
$canasta = function_exists('getCostoVariationID') ? getIdCanastaClube($cliente->club_id, $producto_id) : [];
$ingredientesCanasta = function_exists('getIngredientesCanasta') ? getIngredientesCanasta($canasta) : [];
$ingredientesAdicionales = function_exists('getIngredientesAdicionales') ? unserialize(getIngredientesAdicionales($cliente->cliente_id) ) : [];

$totalAdicionales = isset($ingredientesAdicionales['total_adicionales']) ? $ingredientesAdicionales['total_adicionales'] : 0;
$variationAttr = function_exists('getCostoVariationID') ? getCostoVariationID($cliente->producto_id) : [];
$firstName = get_user_meta($user->ID, 'first_name', true);
$lastName = get_user_meta($user->ID, 'last_name', true); ?>
<div class="wrap content-cliente">
    <h1>
        Cliente - <?php echo $firstName != '' ? $firstName.' '.$lastName : $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=activos'; ?>">
        << Regresar clientes
    </a>
    <br>
	<div class="side-cliente">
		<p><strong>Email:</strong> <?php echo $user->user_email; ?><br>
		<strong>Club:</strong> <?php echo get_the_title($cliente->club_id); ?></p>
		<p><strong>Saldo actual:</strong> <?php echo $cliente->saldo; ?></p>

		<h3>Ultima compra de saldo</h3>
		<p>
			<strong>Producto:</strong>  <?php echo get_the_title($producto_id); ?><br>
			<?php if(!empty($variationAttr)):  ?>
				<strong>Temporalidad:</strong>  <?php echo $variationAttr->temporalidad; ?><br>
				<strong>Precio:</strong>  $<?php echo $variationAttr->costo; ?><br>
				<strong>Precio por canasta:</strong>  $<?php echo $variationAttr->costoSemanal; ?><br>
			<?php endif; ?>
		</p>
		<a href="<?php echo admin_url().'admin.php?page=editar_cliente&id_cliente='.$cliente->cliente_id; ?>" class="button-primary">Editar Cliente</a>
	</div>
	<div class="body-cliente">
		<h3>Próxima canasta
			<span>
				$<?php if(!empty($variationAttr)): 
					echo $variationAttr->costoSemanal; ?>
				<?php endif; ?>
			</span>
		</h3>
		<?php if ($cliente->saldo > $variationAttr->costoSemanal AND $cliente->suspendido != 1): ?>
			
			<ul>
				<?php if(!empty($ingredientesCanasta)): 
					foreach ($ingredientesCanasta as $key => $ingrediente) :
						$terms = wp_get_post_terms( $ingrediente->ingrediente_id, 'unidades' );
						$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
						<li>
							- <?php echo get_the_title($ingrediente->ingrediente_id); ?> ( <?php echo $ingrediente->cantidad.' '.$unidad; ?> )
						</li>
					<?php endforeach;
				else: ?>
					<li>No tiene ingredientes la canasta</li>
				<?php endif; ?>
			</ul>

			<h3>Ingredientes Adicionales: <span>$<?php echo $totalAdicionales; ?></span></h3>
			<ul>
				<?php if(!empty($ingredientesAdicionales['ingredientes'])): 
					foreach($ingredientesAdicionales['ingredientes'] as $ingrediente) :
						$terms = wp_get_post_terms( $ingrediente['ingredienteID'], 'unidades' );
						$unidad = isset($terms[0]) ? $terms[0]->name : '';?>
						<li>
				            - <?php echo get_the_title($ingrediente['ingredienteID']); ?> <strong> ( <?php echo $ingrediente['cantidad'].' '.$unidad; ?> )</strong> - $ <?php echo $ingrediente['total']; ?> </span> 
				           <small>* <?php echo $ingrediente['periodo']; ?></small>
				        </li>
					<?php endforeach;
				else: ?>
					<li>No tiene ingredientes adicionales</li>
				<?php endif; ?>
			</ul>
			<h3>Total Próximo corte: 
				<?php if(!empty($variationAttr)): ?>
					$<?php echo $variationAttr->costoSemanal + $totalAdicionales; ?>
				<?php endif; ?>

			</h3>
		<?php elseif($cliente->suspendido == 1): 
			$suspension = function_exists('getSuspensionCanastas') ? getSuspensionCanastas($cliente->cliente_id) : ''; ?>
			<p>Las entregas al cliente estan suspendidas por: <strong class="[ color-primary ]"><?php echo $suspension->temporalidad; ?> Semanas</strong></p>
	        <p>Fecha suspensión: <strong> <?php echo getDateTransform($suspension->fechaSuspension); ?></strong>
	        <!-- <br>Podras ver la próxima canasta hasta <strong> <?php echo getDateTransform($suspension->fechaFin); ?></strong> -->
	        <br>Fecha próximo corte: <strong> <?php echo getDateTransform($suspension->FechaProximoDescuento); ?></strong></p>

	        <p class="[ margin-top--large ]">Desea <strong>renudar</strong> sus entregas?</p>
	        <form method="post" action="<?php echo admin_url().'admin.php?page=reanudar_entrega&id_cliente='.$cliente->cliente_id; ?>" method="post">
	            <input type="submit" name="enviar" id="submit" class="button-primary" value="Reanudar entregas"/>
	        </form><br>
		<?php elseif($cliente->saldo < $variationAttr->costoSemanal): ?>
			<p>El saldo del cliente es de <strong>$<?php echo $cliente->saldo ?></strong>.<br> Saldo insuficiente para adquirir la próxima canasta.</p>
		<?php endif; ?>
		<a href="<?php echo admin_url().'admin.php?page=historial_cliente&id_cliente='.$cliente->cliente_id; ?>" class="button-primary">Historial de canastas</a>
	</div>
	<br>
	<br>
	<div style="position: relative;overflow: hidden;width: 100%;">
		<hr>
		<h3>Historial de actualizaciones de saldo por el administrador</h3>
		<?php if(!empty($historySaldo)): ?>
			<table class="wp-list-table widefat fixed striped users">
				<thead>
					<tr>
						<th scope="col" class="manage-column column-primary"><span>Fecha actualización</span></th>
						<th scope="col" class="manage-column column-primary"><span>Lo actualizó</span></th>
						<th scope="col" class="manage-column column-primary"><span>Saldo Anterior</span></th>
						<th scope="col" class="manage-column column-primary"><span>Saldo Actualizado</span></th>
					</tr>
				</thead>

				<tbody id="the-list">
					
						<?php foreach ($historySaldo as $history):
							$user = get_user_by( 'ID', $history->user_id ); ?>
							<tr>
								<td><?php echo $history->fecha; ?></td>
								<td><?php echo $user->user_login; ?></td>
								<td><?php echo $history->saldo_anterior; ?></td>
								<td><?php echo $history->saldo_agregado; ?></td>
							</tr>
						<?php endforeach; ?>
				</tbody>

			</table>
		</div>
	<?php else: ?>
		<p class="color-primar">No existen actualizaciones por el Administrador</p>
	<?php endif; ?>

	
</div>