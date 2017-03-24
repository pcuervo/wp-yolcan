<div class="error">
	<div class="header">Tiene los siguiente errores</div>
	<?php if (!empty($mesage_error)) : 
		foreach ($mesage_error as $key => $mensaje): ?>
			<div class="mensaje-error"><?php echo $mensaje; ?></div>
		<?php endforeach; 
	endif; ?>
</div>