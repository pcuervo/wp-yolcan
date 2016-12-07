<?php $user = get_user_by( 'id', $restauranteId );  ?>
<div class="wrap content-cliente">
    <h1>
        Restaurante - <?php echo $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restauranteId; ?>">
        << Regresar restaurante
    </a>
    <br>
	<div class="side-cliente">
		<p><strong>Email:</strong> <?php echo $user->user_email; ?><br>
		<p><strong>Saldo actual: </strong> <?php echo isset($restaurante->saldo) ? $restaurante->saldo : 0; ?></p>
		
		<a href="<?php echo admin_url().'admin.php?page=comprar_restaurante&id_restaurante='.$restauranteId; ?>" class="button-primary">Nueva compra</a>
		<br>
		<br>
		<a href="<?php echo admin_url().'admin.php?page=historial_restaurante&id_restaurante='.$restauranteId; ?>" class="button-primary">Historial de compras</a>
	</div>
	<div class="body-cliente">
		<form action="<?php echo admin_url().'admin.php?page=update_saldo_restaurante&id_restaurante='.$restauranteId; ?>" method="post">
			<label for="">Saldo a agregar</label>
			<input type="text" name="saldo" value="">
			<input type="hidden" name="saldo-anterior" value="<?php echo isset($restaurante->saldo) ? $restaurante->saldo : 0; ?>">
	        <br>
	        <br>
	        <input type="submit" class="button-primary" value="Guardar">
		</form>
	</div>

	
</div>