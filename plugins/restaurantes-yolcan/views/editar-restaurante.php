<?php $user = get_user_by( 'id', $cliente->cliente_id ); 
$producto_id = wp_get_post_parent_id( $cliente->producto_id );
$variationAttr = function_exists('getCostoVariationID') ? getCostoVariationID($cliente->producto_id) : []; ?>
<div class="wrap content-cliente">
    <h1>
        Cliente - <?php echo $user->user_login; ?>
    </h1>
    <hr>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
        << Regresar perfil
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
	</div>

	<div class="body-cliente">
		<h3>Editar Saldo ó Suspender entregas</h3>
		<form action="<?php echo admin_url().'admin.php?page=update_cliente&id_cliente='.$cliente->cliente_id; ?>" method="post">
			<label for="">Saldo</label>
			<input type="text" name="saldo" value="<?php echo $cliente->saldo; ?>">
			<input type="hidden" name="saldo-anterior" value="<?php echo $cliente->saldo; ?>">
			<input type="hidden" name="club-anterior" value="<?php echo $cliente->club_id; ?>">

			<hr>
			<p><strong>Cambiar de club</strong></p>
			<label for="">Seleccione un club</label>
			<select name="club" id="">
				<?php if (!empty($clubes)):
					foreach ($clubes as $key => $club) : 
						$selected = $club->ID == $cliente->club_id ? 'selected' : ''; ?>
						<option value="<?php echo $club->ID ?>" <?php echo $selected ?>><?php echo $club->post_title ?></option>
					<?php endforeach; 
				endif; ?>
				
			</select>
			<hr>
			<p><strong>Suspender entrega de canasta</strong></p>
			<?php if($cliente->suspendido != 1): ?>
				<div>
		            <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1">
		            <label for="suspender-1">1 Semana</label>
		        </div>
		        <div>
		            <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2">
		            <label for="suspender-2">2 Semanas</label>
		        </div>
		        <div>
		            <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3">
		            <label for="suspender-3">3 Semanas</label>
		        </div>
		        <div>
		            <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4">
		            <label for="suspender-4">4 Semanas</label>
		        </div>
		        <div>
		        	<label for="suspender-hasta">Suspender hasta</label><br>
		            <input id="suspender-hasta" type="text" class="date-piker" name="suspensionHasta">
		            
		        </div>
		    <?php else: ?>
				<p><strong>Ya esta suspendida la entrega</strong></p>
			<?php endif; ?>
	        <br>
	        <input type="submit" class="button-primary" value="Guardar">
		</form>

	</div>
	<br>
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
	<?php else: ?>
		<p class="color-primar">No existen actualizaciones por el Administrador</p>
	<?php endif; ?>
	
</div>