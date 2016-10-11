<?php $user = get_user_by( 'id', $restauranteId );  ?>
<div class="wrap content-cliente">
    <h1>
        Restaurante - <?php echo $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restauranteId; ?>">
        << Regresar restaurante
    </a>
    <br>
	
	<div>
		<h3>Historial de compras</h3>
		<?php if(!empty($historial)): ?>
			<table class="wp-list-table widefat fixed striped users">
				<thead>
					<tr>
						<th scope="col" class="manage-column column-primary"><span>Fecha compra</span></th>
						<th scope="col" class="manage-column column-primary"><span>Realizo compra</span></th>
						<th scope="col" class="manage-column column-primary"><span>Total compra</span></th>
					</tr>
				</thead>

				<tbody id="the-list">
					
						<?php foreach ($historial as $history):
							$user = get_user_by( 'ID', $history->user_id ); ?>
							<tr>
								<td><a href="<?php echo admin_url().'admin.php?page=compra_restaurante&id_restaurante='.$restauranteId.'&id_compra='.$history->id; ?>"><?php echo $history->fecha_corte; ?></a></td>
								<td><a href="<?php echo admin_url().'admin.php?page=compra_restaurante&id_restaurante='.$restauranteId.'&id_compra='.$history->id; ?>"><?php echo $user->user_login; ?></a></td>
								<td><a href="<?php echo admin_url().'admin.php?page=compra_restaurante&id_restaurante='.$restauranteId.'&id_compra='.$history->id; ?>"><?php echo $history->total_corte; ?></a></td>

							</tr>
						<?php endforeach; ?>
				</tbody>

			</table>
		<?php endif; ?>
	</div>

	
</div>