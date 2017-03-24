<div class="wrap">
    <h1>
        Clientes <span class="color-primary"><?php echo isset($_GET['club']) ? 'Por Club - '.get_the_title($_GET['club']) : '';?></span>
    </h1>
    <hr>
    <h2>
		Clientes No activos ( <?php echo $total; ?> )
	</h2>
    <?php include('nav.php'); ?>
	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Nombre de cliente</span></th>
				<th scope="col" class="manage-column"><span>Email</span></th>
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if(!empty($clientes)):
				foreach ($clientes as $cliente): 
					$user = get_user_by( 'id', $cliente->cliente_id ); 
					$firstName = get_user_meta($user->ID, 'first_name', true);
                    $lastName = get_user_meta($user->ID, 'last_name', true); ?>
					<tr>
						<td> <?php echo $firstName != '' ? $firstName.' '.$lastName : $user->user_login; ?></td>
						<td><?php echo $user->user_email; ?></td>
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>