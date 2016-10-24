<div class="wrap">
    <h1>
        Clientes <span class="color-primary"><?php echo isset($_GET['club']) ? 'Por Club - '.get_the_title($_GET['club']) : '';?></span>
    </h1>
    <hr>
    <h2>
		Clientes Suspendidos ( <?php echo $total; ?> )
	</h2>
    <?php include('nav.php'); ?>
	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Nombre de cliente</span></th>
				<th scope="col" class="manage-column"><span>Club</span></th>
				<th scope="col" class="manage-column"><span>Fecha suspension</span></th>
				<th scope="col" class="manage-column"><span>Semanas de suspension</span></th>
				<th scope="col" class="manage-column"><span>Fecha próximo corte</span></th>
				<th scope="col" class="manage-column"><span>Saldo</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($clientes)):
				foreach ($clientes as $cliente): 
					$user = get_user_by( 'id', $cliente->cliente_id ); ?>
					<tr>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $user->user_login; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo get_the_title($cliente->club_id); ?></a></td>
						<td>
							<a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
								<?php if(function_exists('getCostoVariationID')):
								 	echo getDateTransformFormat($cliente->fecha_suspension);
								endif; ?>
							</a>
						</td>
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->tiempo_suspension; ?> semanas</a></td>
						<td>
							<a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
								<?php if(function_exists('getCostoVariationID')):
								 	echo getDateTransformFormat($cliente->fecha_proximo_cobro);
								endif; ?>
							</a>
						</td>
						
						<td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->saldo; ?></a></td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>