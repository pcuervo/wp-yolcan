<?php $user = get_user_by( 'id', $restauranteId );
$user_creo = get_user_by( 'id', $compra->user_id );  ?>
<div class="wrap content-cliente">
    <h1>
        Restaurante - <?php echo $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=restaurante&id_restaurante='.$restauranteId; ?>">
        << Regresar restaurante
    </a>
    <br>
	
	<div class="content-agregados-compra">
		<h3>Compra con fecha <?php echo isset($compra->fecha_corte) ? $compra->fecha_corte : '' ?></h3>
		<p><strong>Realizo compra</strong>: <?php echo $user_creo->user_login; ?></p>
		<p><strong>Total compra</strong>: <?php echo $compra->total_corte; ?></p>
		
	</div>	

	<div class="content-ingredientes-restaurante">
		<p><strong>Ingredientes comprados</strong></p>
		<?php $ingredientes = unserialize($compra->ingredientes); 
		if (!empty($ingredientes)):
			foreach ($ingredientes as $key => $ingrediente) :
			    $terms = wp_get_post_terms( $ingrediente['id'], 'unidades' );
                $unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
				<div class="caja-ingrediente">
                    <?php echo get_the_post_thumbnail($ingrediente['id'], 'thumbnail'); ?>
                    <p class="titulo-ingrediente"><strong><?php echo get_the_title($ingrediente['id']); ?></strong></p>
                    <p>(<?php echo $ingrediente['cantidad']; ?> <strong><?php echo $unidad ?></strong>) - $<?php echo $ingrediente['costo']; ?></p>
                </div>
			<?php endforeach;
		endif; ?>
	</div>

	
</div>