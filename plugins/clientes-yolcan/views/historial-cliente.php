<?php $user = get_user_by( 'id', $clienteId );  ?>
<div class="wrap content-cliente">
    <h1>
        Cliente - <?php echo $user->user_login; ?>
    </h1>
    <hr>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$clienteId; ?>">
        << Regresar perfil
    </a>
    <h2>
		Historial de compras
	</h2>
	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Fecha de corte</span></th>
				<th scope="col" class="manage-column"><span>Club</span></th>
				<th scope="col" class="manage-column"><span>Producto</span></th>
				<th scope="col" class="manage-column"><span>Temporalidad</span></th>
				<th scope="col" class="manage-column"><span>Monto cobrado</span></th>
				<th scope="col" class="manage-column"><span>Saldo anterior</span></th>
				<th scope="col" class="manage-column"><span>Costo canasta</span></th>
				<th scope="col" class="manage-column"><span>Costo adicionales</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($historial)):
				foreach ($historial as $canasta): 
					$producto_id = wp_get_post_parent_id( $canasta->variation_id );
					$adicionales = isset($canasta->adicionales) ? unserialize($canasta->adicionales) : [];
					$costoAdicionales = isset($adicionales['total_adicionales']) ? $adicionales['total_adicionales'] : 0;
					$descuento = $canasta->costo_canasta + $costoAdicionales; ?>
					<tr>
						<td><a href="<?php echo admin_url().'admin.php?page=ingredientes_canasta_cliente&id_cliente='.$clienteId.'&id_actualizacion='.$canasta->actualizacion_id.'&id_canasta='.$canasta->canasta_id; ?>"><?php echo getDateTransformFormat($canasta->fecha_corte); ?></a></td>
						<td><?php echo get_the_title($canasta->club_id); ?></td>
						<td><?php echo get_the_title($producto_id); ?></td>
						<td>
							<?php if(function_exists('getCostoVariationID')): 
								$variationAttr = getCostoVariationID($canasta->variation_id); 
								echo $variationAttr->temporalidad; ?>
							<?php endif; ?>
						</td>
						<td><?php echo $descuento; ?></td>
						<td><?php echo $canasta->saldo_anterior; ?></td>
						<td><?php echo $canasta->costo_canasta; ?></td>
						<td><?php echo $costoAdicionales; ?></td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
	
</div>