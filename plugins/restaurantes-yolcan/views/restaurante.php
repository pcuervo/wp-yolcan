<?php $user = get_user_by( 'id', $restauranteId );  ?>
<div class="wrap content-cliente">
    <h1>
        Restaurante - <?php echo $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=restaurantes_activos'; ?>">
        << Regresar restaurantes
    </a>
    <br>
	<div class="side-cliente">
		<p><strong>Email:</strong> <?php echo $user->user_email; ?><br>
		<p><strong>Saldo actual: </strong> <?php echo isset($restaurante->saldo) ? $restaurante->saldo : 0; ?></p>
		
		<a href="<?php echo admin_url().'admin.php?page=comprar_restaurante&id_restaurante='.$restauranteId; ?>" class="button-primary">Nueva compra</a>
		<br>
		<br>
		<a href="<?php echo admin_url().'admin.php?page=cargar_saldo_restaurante&id_restaurante='.$restauranteId; ?>" class="button-primary">Cargar saldo Restaurante</a>
		<br>
		<br>
		<a href="<?php echo admin_url().'admin.php?page=historial_restaurante&id_restaurante='.$restauranteId; ?>" class="button-primary">Historial de compras</a>
	</div>
	<div class="body-cliente">
		<h3>Historial de actualizaciones de saldo por el administrador</h3>
		<?php if(!empty($historySaldo)): ?>
			<table class="wp-list-table widefat fixed striped users">
				<thead>
					<tr>
						<th scope="col" class="manage-column column-primary"><span>Fecha actualización</span></th>
						<th scope="col" class="manage-column column-primary"><span>Lo actualizó</span></th>
						<th scope="col" class="manage-column column-primary"><span>Saldo Anterior</span></th>
						<th scope="col" class="manage-column column-primary"><span>Saldo Agregado</span></th>
						<th scope="col" class="manage-column column-primary"><span>Saldo Total</span></th>
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
								<td><?php echo $history->saldo_a_la_fecha; ?></td>

							</tr>
						<?php endforeach; ?>
				</tbody>

			</table>
		</div>
	<?php else: ?>
		<p class="color-primar">No existen actualizaciones por el Administrador</p>
	<?php endif; ?>

	
</div>