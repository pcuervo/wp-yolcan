<?php $completa = isset($actualizacion_canasta->valor_puntos_completa) ? $actualizacion_canasta->valor_puntos_completa : 0;
$mitad = isset($actualizacion_canasta->valor_puntos_mitad) ? $actualizacion_canasta->valor_puntos_mitad : 0;
$fecha = isset($actualizacion_canasta->ultima_actualizacion) ? $actualizacion_canasta->ultima_actualizacion : 0; ?>
<div class="wrap">
	<h1>Canasta Actual</h1>
	<hr>
	<h3>Ingredientes</h3>
	<?php $date = getDateTransformUpdate(date("Y-m-d", strtotime($fecha))); ?>
	<p><strong>Ultima Actualización:</strong> <?php echo $date[3].', '.$date[0].' de '.$date[1].' del '.$date[2]; ?></p>
	<div class="content-ingredientes">
		<h4>Canasta completa</h4>
		<hr>
		<p class="puntos">Valor en puntos: <strong><?php echo $completa ?></strong></p>
		<hr>
		<ul>
			<?php if (!empty($canasta_completa)): 
				foreach ($canasta_completa as $key => $ingrediente): ?>
					<li><?php echo $ingrediente->nombre_ingrediente; ?></li>
				<?php endforeach;
			endif; ?>
		</ul>
	</div>
	<div class="content-ingredientes">
		<h4>Media Canasta</h4>
		<hr>
		<p class="puntos">Valor en puntos: <strong><?php echo $mitad ?></strong></p>
		<hr>
		<ul>
			<?php if (!empty($media_canasta)): 
				foreach ($media_canasta as $key => $ingrediente): ?>
					<li><?php echo $ingrediente->nombre_ingrediente; ?></li>
				<?php endforeach;
			endif; ?>
		</ul>
	</div>
	<div class="content-ingredientes-adicionales">
		<h4>Adicionales en canasta</h4>
		<hr>
		<ul>
			<li class="header">
				<span class="ingrediente">Ingrediente</span>
				<span class="valor">Puntos</span>
			</li>
			<?php if (!empty($ingredientes_adicionales)): 
				foreach ($ingredientes_adicionales as $key => $ingrediente):
					$puntos = get_post_meta($ingrediente->ingrediente_id, 'valor_en_puntos', true); ?>
					<li>
						<span class="ingrediente"><?php echo $ingrediente->nombre_ingrediente; ?></span>
						<span class="valor"><?php echo $puntos != '' ? $puntos : 0; ?></span>
					</li>
				<?php endforeach;
			endif; ?>
		</ul>
	</div>
	<br><br>
	<a class="button button-primary button-editar-canasta" href="<?php echo admin_url().'admin.php?page=editar-canasta'; ?>">Editar canasta</a>
</div>