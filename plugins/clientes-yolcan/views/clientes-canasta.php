<?php $canasta_g = isset($_GET['canasta']) ? $_GET['canasta'] : '';
$canasta_id = ''; ?>
<div class="wrap">
    <h1>
        Clientes por canasta
    </h1>
    <ul class="subsubsub">
    	<?php if (!empty($canastas)):
    		$canasta_id = $canasta_g;
    		foreach ($canastas as $key => $canasta): 
    			if ($canasta_g == '' AND $key == 0 ):
    				$canasta_id = $canasta->ID; ?>
    				<li><a href="<?php echo admin_url().'admin.php?page=clientes_canasta&canasta='.$canasta->ID; ?>" class="current"><?php echo $canasta->post_title; ?> <span class="count"></span></a> |</li>
    			<?php else:
    				$current_activo = $canasta_g == $canasta->ID ? 'current' : ''; ?>
    				<li><a href="<?php echo admin_url().'admin.php?page=clientes_canasta&canasta='.$canasta->ID; ?>" class="<?php echo $current_activo; ?>"><?php echo $canasta->post_title; ?> <span class="count"></span></a> |</li>
    			<?php endif;
    		endforeach;
    			
    	endif; ?>
	</ul>
	<hr>
	<br>
    <h2>
		<?php echo get_the_title($canasta_id); ?>
	</h2>

	
</div>