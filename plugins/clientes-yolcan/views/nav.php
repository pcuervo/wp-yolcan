<?php if( isset($_GET['club']) ): ?>
	<a href="<?php echo admin_url().'admin.php?page=activos'; ?>" class="button-primary btn-regresar">Regresar Clientes en General</a>
<?php endif; ?>
<ul class="subsubsub">
	<?php $object = isset($_GET['club']) ? '&club='.$_GET['club'] : '';
	$current_activos = $_GET['page'] == 'activos' ? 'current' : '';
	$current_noactivos = $_GET['page'] == 'no_activos' ? 'current' : ''; 
	$current_suspendidos = $_GET['page'] == 'suspendidos' ? 'current' : '';
	$current_por_caducar = $_GET['page'] == 'proximos_caducar' ? 'current' : '';
	$current_por_club = $_GET['page'] == 'por_club' ? 'current' : '';
	$current_por_canasta = $_GET['page'] == 'por_canasta' ? 'current' : '';

	$current_saldo_insuficiente = $_GET['page'] == 'saldo_insuficiente' ? 'current' : '';?>
	<li class="activos"><a href="<?php echo admin_url().'admin.php?page=activos'.$object; ?>" class="<?php echo $current_activos; ?>">Activos <span class="count"></span></a> |</li>
	<?php if(!isset($_GET['club'])):?>
		<li class="no-activos"><a href="<?php echo admin_url().'admin.php?page=no_activos'; ?>" class="<?php echo $current_noactivos; ?>">No activos <span class="count"></span></a> |</li>
	<?php endif; ?>
	<li class="suspendidos"><a href="<?php echo admin_url().'admin.php?page=suspendidos'.$object; ?>" class="<?php echo $current_suspendidos; ?>">Suspendidos <span class="count"></span></a> |</li>
	<li class="proximos-caducar"><a href="<?php echo admin_url().'admin.php?page=proximos_caducar'.$object; ?>" class="<?php echo $current_por_caducar; ?>">Próximos a caducar <span class="count"></span></a> |</li>
	<li class="sin-saldo"><a href="<?php echo admin_url().'admin.php?page=saldo_insuficiente'.$object; ?>" class="<?php echo $current_saldo_insuficiente; ?>">Saldo insuficiente <span class="count"></span></a> |</li>

	<?php if(!isset($_GET['club'])):?>
		<li class="por-clube"><a href="<?php echo admin_url().'admin.php?page=por_club'; ?>" class="<?php echo $current_por_club; ?>">Por club</a>  |</li>
	<?php else: ?>
		<li class="por-clube"><a href="<?php echo admin_url().'admin.php?page=por_club'; ?>" class="<?php echo $current_por_club; ?>">Ver otro club</a>  |</li>
	<?php endif; ?>

	<?php if(!isset($_GET['tamano-canasta'])):?>
		<li class="por-canasta"><a href="<?php echo admin_url().'admin.php?page=por_canasta'; ?>" class="<?php echo $current_por_canasta; ?>">Por canasta</a></li>
	<?php else: ?>
		<li class="por-canasta"><a href="<?php echo admin_url().'admin.php?page=por_canasta'; ?>" class="<?php echo $current_por_canasta; ?>">Ver otra canasta</a></li>
	<?php endif; ?>
</ul>