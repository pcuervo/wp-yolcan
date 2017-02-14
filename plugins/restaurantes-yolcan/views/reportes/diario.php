<div class="wrap">
    <h1>
        Restaurantes
    </h1>
    <hr>
    <h2>
		Reporte diario
	</h2>
	<form action="<?php echo admin_url().'admin.php'; ?>" method="get">
	    <input type="hidden" name="page" value="reporte_diario">

		<div>
	    	<label for="suspender-hasta">Selecciona una fecha</label><br>
	        <input id="suspender-hasta" type="text" class="date-piker-reports" name="resporte_del">
	        
	    </div>
		<br>
	    <input type="hidden" name="reporteDiario" value="si">
        <input type="submit" class="button-primary" value="Traer reporte">
	</form>

	<?php if ($search == 'si') :
		if(!empty($results)):
			echo "<h2>Reporte con fecha ".$date." <a href=''>Generar PDF</a></h2>";
			foreach (array_chunk($results, 2) as $key => $restaurantes) : 
				echo '<div class="chunk-content">';
				foreach ($restaurantes as $key => $restaurante):
					$user = get_user_by( 'id', $restaurante->restaurante_id ); ?>
					<div class="container-restaurant-report">
						<h3><?php echo $user->user_login; ?></h3>
						<?php $ingredientes = unserialize($restaurante->ingredientes);
						if(!empty($ingredientes)): 
							foreach ($ingredientes as $key => $ingrediente):
								$terms = wp_get_post_terms( $ingrediente['id'], 'unidades' );
	                			$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
								<div class="ingrediente">
									<div class="cantidad"><?php echo $ingrediente['cantidad']; ?> <strong><?php echo $unidad ?></strong></div>
									<div class="nombre"><strong><?php echo get_the_title($ingrediente['id']); ?></strong></div>
								</div>
							<?php endforeach;
						endif;  ?>
					</div>
				<?php endforeach;
				echo '</div>';
			endforeach;
		else:
			echo '<p>No se encontraron resultados para la fecha <strong>'.$date.'</strong></p>';
		endif;
	endif; ?>
	<!-- <table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Restaurante</span></th>
				<th scope="col" class="manage-column"><span>Saldo</span></th>
				<th scope="col" class="manage-column"><span>Última compra</span></th>
				<th scope="col" class="manage-column"><span>Último abono</span></th>

			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($restaurantes)):
				foreach ($restaurantes as $restaurante): 
					$user = get_user_by( 'id', $restaurante->restaurante_id ); ?>
					<tr>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $user->user_login; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $restaurante->saldo; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $restaurante->ultimo_corte; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $restaurante->ultima_carga_saldo; ?></a></td>

					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table> -->
</div>