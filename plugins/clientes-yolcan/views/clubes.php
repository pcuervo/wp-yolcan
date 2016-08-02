<div class="wrap">
    <h1>
        Clientes
    </h1>
    <?php include('nav.php'); ?>
	<hr>
	<br>
    <h2>
		Selecciona un clube
	</h2>

	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Nombre de club</span></th>
				<th scope="col" class="manage-column column-primary"><span>Clientes</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($clubes)):
				foreach ($clubes as $club): ?>
					<tr>
						<td><a href="<?php echo admin_url().'admin.php?page=activos&club='.$club->ID; ?>"><?php echo $club->post_title; ?></a></td>
						<td>
							<a href="<?php echo admin_url().'admin.php?page=activos&club='.$club->ID; ?>">
								<?php echo isset($totalClientes[$club->ID]) ? $totalClientes[$club->ID]->total : 0; ?>
							</a>
						</td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>