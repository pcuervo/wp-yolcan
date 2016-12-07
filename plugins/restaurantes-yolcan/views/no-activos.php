<div class="wrap">
    <h1>
        Restaurantes
    </h1>
    <hr>
    <h2>
		Restaurantes No activos ( <?php echo $total; ?> )
	</h2>
    <?php include('nav.php'); ?>
	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Restaurante</span></th>
				<th scope="col" class="manage-column"><span>Email</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($restaurantes)):
				foreach ($restaurantes as $restaurante): 
					$user = get_user_by( 'id', $restaurante->restaurante_id ); ?>
					<tr>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $user->user_login; ?></a></td>
						<td><a href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restaurante->restaurante_id; ?>"><?php echo $user->user_email; ?></a></td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>