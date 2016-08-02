<?php $user = get_user_by( 'id', $cliente->cliente_id ); 
$producto_id = wp_get_post_parent_id( $cliente->producto_id );
$variationAttr = function_exists('getCostoVariationID') ? getCostoVariationID($cliente->producto_id) : []; ?>
<div class="wrap content-cliente">
    <h1>
        Cliente - <?php echo $user->user_login; ?>
    </h1>
    <hr>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
        << Regresar perfil
    </a>
    <br>
	<div class="side-cliente">
		<p><strong>Email:</strong> <?php echo $user->user_email; ?><br>
		<strong>Club:</strong> <?php echo get_the_title($cliente->club_id); ?></p>
		<p><strong>Saldo actual:</strong> <?php echo $cliente->saldo; ?></p>

		<h3>Ultima compra de saldo</h3>
		<p>
			<strong>Producto:</strong>  <?php echo get_the_title($producto_id); ?><br>
			<?php if(!empty($variationAttr)):  ?>
				<strong>Temporalidad:</strong>  <?php echo $variationAttr->temporalidad; ?><br>
				<strong>Precio:</strong>  $<?php echo $variationAttr->costo; ?><br>
				<strong>Precio por canasta:</strong>  $<?php echo $variationAttr->costoSemanal; ?><br>
			<?php endif; ?>
		</p>
	</div>

	<div class="body-cliente">
		<h3>Editar Saldo ó Suspender entregas</h3>
		<form action="<?php echo admin_url().'admin.php?page=update_cliente&id_cliente='.$cliente->cliente_id; ?>" method="post">
			<label for="">Saldo</label>
			<input type="text" name="saldo" value="<?php echo $cliente->saldo; ?>">
			<p>Suspender entrega de canasta</p>
			<?php if($cliente->suspendido != 1): ?>
				<div>
		            <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1">
		            <label for="suspender-1">1 Semana</label>
		        </div>
		        <div>
		            <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2">
		            <label for="suspender-2">2 Semanas</label>
		        </div>
		        <div>
		            <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3">
		            <label for="suspender-3">3 Semanas</label>
		        </div>
		        <div>
		            <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4">
		            <label for="suspender-4">4 Semanas</label>
		        </div>
		    <?php else: ?>
				<p><strong>Ya esta suspendida la entrega</strong></p>
			<?php endif; ?>
	        <br>
	        <input type="submit" class="button-primary" value="Guardar">
		</form>

	</div>
	
</div>