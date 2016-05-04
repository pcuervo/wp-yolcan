<div class="wrap">
	<h1>Canasta Actual</h1>
	<hr>
	<h3>Ingredientes</h3>
	<?php $date = getDateTransformUpdate(date('Y-m-d')); ?>
	<p><strong>Ultima Actualización:</strong> <?php echo $date[3].', '.$date[0].' de '.$date[1].' del '.$date[2]; ?></p>
	<div class="content-ingredientes">
		<h4>Canasta completa</h4>
		<hr>
		<p class="puntos">Valor en puntos: <strong>6000</strong></p>
		<hr>
		<ul>
			<li>Mix de ensalada</li>
			<li>Kale</li>
			<li>Quelite</li>
			<li>Calabaza</li>
			<li>Pepino</li>
			<li>Mantequilla</li>
			<li>Zanahoria</li>
		</ul>
	</div>
	<div class="content-ingredientes">
		<h4>Media Canasta</h4>
		<hr>
		<p class="puntos">Valor en puntos: <strong>3000</strong></p>
		<hr>
		<ul>
			<li>Mix de ensalada</li>
			<li>Kale</li>
			<li>Quelite</li>
			<li>Calabaza</li>
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
			<li>
				<span class="ingrediente">1pza Huevo</span>
				<span class="valor">5</span>
			</li>
			<li>
				<span class="ingrediente">Mantequilla</span>
				<span class="valor">30</span>
			</li>
			<li>
				<span class="ingrediente">Mantequilla</span>
				<span class="valor">30</span>
			</li>
			<li>
				<span class="ingrediente">Mantequilla</span>
				<span class="valor">30</span>
			</li>
		</ul>
	</div>

	<a href="<?php echo admin_url().'admin.php?page=editar-canasta'; ?>">Editar canasta</a>
</div>