<ul class="subsubsub">
	<?php
	$current_activos = $_GET['page'] == 'restaurantes_activos' ? 'current' : '';
	$current_noactivos = $_GET['page'] == 'restaurantes_no_activos' ? 'current' : ''; 
	$current_suspendidos = $_GET['page'] == 'restaurantes_suspendidos' ? 'current' : '';
	$current_por_caducar = $_GET['page'] == 'restaurantes_proximos_caducar' ? 'current' : '';

	$current_saldo_insuficiente = $_GET['page'] == 'restaurantes_saldo_insuficiente' ? 'current' : '';?>
	<li class="activos"><a href="<?php echo admin_url().'admin.php?page=restaurantes_activos'; ?>" class="<?php echo $current_activos; ?>">Activos <span class="count"></span></a> |</li>
	<li class="no-activos"><a href="<?php echo admin_url().'admin.php?page=restaurantes_no_activos'; ?>" class="<?php echo $current_noactivos; ?>">No activos <span class="count"></span></a> |</li>
	<li class="suspendidos"><a href="<?php echo admin_url().'admin.php?page=restaurantes_suspendidos'; ?>" class="<?php echo $current_suspendidos; ?>">Suspendidos <span class="count"></span></a> |</li>
	<li class="proximos-caducar"><a href="<?php echo admin_url().'admin.php?page=restaurantes_proximos_caducar'; ?>" class="<?php echo $current_por_caducar; ?>">Próximos a caducar <span class="count"></span></a> |</li>
	<li class="sin-saldo"><a href="<?php echo admin_url().'admin.php?page=restaurantes_saldo_insuficiente'; ?>" class="<?php echo $current_saldo_insuficiente; ?>">Saldo insuficiente <span class="count"></span></a> |</li>

</ul>