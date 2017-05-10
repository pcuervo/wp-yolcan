<div class="wrap nosubsub">
	<h2>Visitas agendadas</h2>

	<div class="hide-sidebar sidebar-for-errors cont-cupones">
		<p><i>Los registros mostrados son de la fecha actual <strong>"<?php echo getDateTransform(date('Y-m-d')); ?>"</strong> en adelante.</i></p>
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Correo</th>
					<th scope="col">Teléfono</th>
					<th scope="col">No. Personas</th>
					<th scope="col">Fecha</th>

				</tr>
			</thead>

			<tbody id="the-list">
				<?php $visitas = getVisitasAgendadas();
				if (!empty($visitas)):
					foreach ($visitas as $visita): ?>
						<tr id="post-313" class="iedit ">
							<td><strong><?php echo $visita->nombre; ?></strong></td>
							<td><?php echo $visita->correo; ?></td>
							<td><?php echo $visita->telefono; ?></td>
							<td><?php echo $visita->numero_personas; ?></td>
							<td><?php echo getDateTransform( $visita->fecha); ?></td>
						</tr>
					<?php endforeach;
				endif; ?>
			</tbody>

		</table>
	</div>
</div>