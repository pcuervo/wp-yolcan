<?php $user = get_user_by( 'id', $clienteID );  ?>
<div class="wrap content-cliente">
    <h1>
        Cliente - <?php echo $user->user_login; ?>
    </h1>
    <hr>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=no_activos'; ?>">
        << Regresar
    </a>
    <br>
	<div class="side-cliente">
		<p><strong>Email:</strong> <?php echo $user->user_email; ?><br>
		<?php $clubID = isset($cliente->club_id) ? get_the_title($cliente->club_id) : 0; ?>
		<strong>Club:</strong> Sin club</p>
		<p><strong>Saldo actual:</strong> <?php echo isset($cliente->saldo) ? $cliente->saldo : '0'; ?></p>
	</div>

	<div class="body-cliente">
		<h3>Editar Saldo</h3>
		<form action="<?php echo admin_url().'admin.php?page=update_cliente_no_activo&id_cliente='.$clienteID; ?>" method="post">
			<label for="">Saldo</label>
			<input type="text" name="saldo" value="<?php echo isset($cliente->saldo) ? $cliente->saldo: 0; ?>">
			<input type="hidden" name="saldo-anterior" value="<?php echo isset($cliente->saldo) ? $cliente->saldo : 0; ?>">
			<input type="hidden" name="club-anterior" value="0">
			<hr>
			<p><strong>Cambiar de club</strong></p>
			<label for="">Seleccione un club</label>
			<select name="club" id="">
				<option value="0">Sin club</option>
				<?php if (!empty($clubes)):
					foreach ($clubes as $key => $club) : 
						$clubID = isset($cliente->club_id) ? $cliente->club_id : 0;
						$selected = $club->ID == $clubID ? 'selected' : ''; ?>
						<option value="<?php echo $club->ID ?>" <?php echo $selected ?>><?php echo $club->post_title ?></option>
					<?php endforeach; 
				endif; ?>
				
			</select>
			
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