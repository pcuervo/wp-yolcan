<div class="wrap">
    <h1>
       Corte de saldo clientes
    </h1>
    <hr>
    
	<?php if(isset($_GET['corte']) AND $_GET['corte'] == 'ok'): ?>
		<div class="mensaje mensaje-susses">
			El corte se realizo correctamente
		</div>
	<?php else: ?>
		<div class="mensaje mensaje-error">
			Al generar el corte no solo descontara saldo al cliente para sus canastas si no tambien estara guardando un historial de las compras y las canastas
		</div>
	<?php endif; ?>
	<br>
	<form id="form-corte" action="" method="post">
		<input type="hidden" name="action" value="realizar-corte">
	</form>
	<a class="button-primary bt-corte"  href="">Realizar corte</a>
	<br><br>
	<hr>
	<h2>Ultimos cortes</h2>
	<table class="wp-list-table widefat fixed striped users">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-primary"><span>Fecha de corte</span></th>
				<th scope="col" class="manage-column"><span>Usuario genero el corte</span></th>
				
			</tr>
		</thead>

		<tbody id="the-list">
			<?php if (!empty($cortes)): 
				foreach ($cortes as $key => $corte):
					$user = get_userdata( $corte->user_id );  ?>
					<tr>
						<td><?php echo $corte->fecha_corte; ?></td>
						<td><?php echo isset($user->user_login) ? $user->user_login : ''; ?></td>
						
					</tr>
				<?php endforeach;
			endif; ?>
		</tbody>

	</table>
</div>