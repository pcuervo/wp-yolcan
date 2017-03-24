<div class="wrap nosubsub">
	<h2>Crea tu club</h2>

	<div class="hide-sidebar sidebar-for-errors cont-cupones"> 
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Correo</th>
					<th scope="col">Teléfono</th>
					<th scope="col">Ubicación</th>
					<th scope="col">Mensaje</th>

				</tr>
			</thead>

			<tbody id="the-list">
				<?php $posibles = getCreaTuClub();
				if (!empty($posibles)):
					foreach ($posibles as $club): ?>
						<tr id="post-313" class="iedit ">
							<td><strong><?php echo $club->nombre; ?></strong></td>
							<td><?php echo $club->correo; ?></td>
							<td><?php echo $club->telefono; ?></td>
							<td><?php echo $club->ubicacion; ?></td>
							<td><?php echo $club->mensaje; ?></td>
						</tr>
					<?php endforeach;
				endif; ?>
			</tbody>

		</table>
	</div>
</div>