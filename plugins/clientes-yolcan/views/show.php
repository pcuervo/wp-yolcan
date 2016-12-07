<div class="wrap">
    <h1>
        Clientes <span class="color-primary"><?php echo isset($_GET['club']) ? 'Por Club - '.get_the_title($_GET['club']) : '';?></span>
    </h1>
    <hr>
    <h2>
		Clientes Activos ( <?php echo $total; ?> )
	</h2>

    <?php include('nav.php'); ?>

	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Nombre de cliente</span></th>
				<th scope="col" class="manage-column"><span>Club</span></th>
				<th scope="col" class="manage-column">Producto</th>
				<th scope="col" class="manage-column">Temporalidad</th>
				<th scope="col" class="manage-column"><span>Saldo</span></th>
				<th scope="col" class="manage-column"><span>Precio por canasta</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($clientes)):
				foreach ($clientes as $cliente): 
					$user = get_user_by( 'id', $cliente->cliente_id );
					$producto_id = wp_get_post_parent_id( $cliente->producto_id );
					$firstName = get_user_meta($user->ID, 'first_name', true);
                    $lastName = get_user_meta($user->ID, 'last_name', true);  ?>
					<tr>
						<td>
							<a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
								<?php echo $firstName != '' ? $firstName.' '.$lastName : $user->user_login; ?>
							</a>
						</td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo get_the_title($cliente->club_id); ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo get_the_title($producto_id); ?></a></td>
						<td>
							<?php if(function_exists('getCostoVariationID')): 
								$variationAttr = getCostoVariationID($cliente->producto_id); 
								echo $variationAttr->temporalidad; ?>
							<?php endif; ?>
						</td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->saldo; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->costo_semanal_canasta; ?></a></td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>