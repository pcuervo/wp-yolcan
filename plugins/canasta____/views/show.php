<div class="wrap">
	<h1>Canasta Actual</h1>
	<hr>
	<h3>Ingredientes</h3>
	
	<div class="content-ingredientes">
		<h4>Canasta completa</h4>
		<p><strong>Ultima Actualización:</strong> Martes, 29 de Octubre del 2016</p>
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
		<p><strong>Ultima Actualización:</strong> Martes, 29 de Octubre del 2016</p>
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