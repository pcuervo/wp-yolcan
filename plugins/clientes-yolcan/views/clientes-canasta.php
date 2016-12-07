<?php $canasta_g = isset($_GET['canasta']) ? $_GET['canasta'] : '';
$canasta_id = ''; ?>
<div class="wrap">
    <h1>
        Clientes activos por canasta
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
		<?php echo get_the_title($canasta_id); ?> ( <?php echo $total; ?> )
	</h2>
    <ul class="subsubsub">
        <?php $current_activos = $_GET['page'] == 'clientes_canasta' ? 'current' : '';
        $current_suspendidos = $_GET['page'] == 'clientes_canasta_suspendidos' ? 'current' : '';
        $current_por_caducar = $_GET['page'] == 'clientes_canasta_proximos_caducar' ? 'current' : '';
        $current_saldo_insuficiente = $_GET['page'] == 'clientes_canasta_saldo_insuficiente' ? 'current' : ''; ?>

        <li class="activos"><a href="<?php echo admin_url().'admin.php?page=clientes_canasta&canasta='.$canasta_id; ?>" class="<?php echo $current_activos; ?>">Activos <span class="count"></span></a> |</li>
        <li class="suspendidos"><a href="<?php echo admin_url().'admin.php?page=clientes_canasta_suspendidos&canasta='.$canasta_id; ?>" class="<?php echo $current_suspendidos; ?>">Suspendidos <span class="count"></span></a> |</li>
        <li class="proximos-caducar"><a href="<?php echo admin_url().'admin.php?page=clientes_canasta_proximos_caducar&canasta='.$canasta_id; ?>" class="<?php echo $current_por_caducar; ?>">Próximos a caducar <span class="count"></span></a> |</li>
        <li class="sin-saldo"><a href="<?php echo admin_url().'admin.php?page=clientes_canasta_saldo_insuficiente&canasta='.$canasta_id; ?>" class="<?php echo $current_saldo_insuficiente; ?>">Saldo insuficiente <span class="count"></span></a> |</li>
    </ul>
    <table class="wp-list-table widefat fixed striped users">
        <thead>
            <tr>
                <th scope="col" class="manage-column column-primary"><span>Nombre de cliente</span></th>
                <th scope="col" class="manage-column"><span>Club</span></th>
                <th scope="col" class="manage-column">Producto</th>
                <th scope="col" class="manage-column">Temporalidad</th>
                <th scope="col" class="manage-column"><span>Saldo</span></th>
                <th scope="col" class="manage-column"><span>Precio por canasta</span></th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php if(!empty($clientes)):
                foreach ($clientes as $cliente): 
                    $user = get_user_by( 'id', $cliente->cliente_id );
                    $producto_id = wp_get_post_parent_id( $cliente->producto_id ); 
                    $firstName = get_user_meta($user->ID, 'first_name', true);
                    $lastName = get_user_meta($user->ID, 'last_name', true); ?>
                    <tr>
                        <td>
                            <a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>">
                                <?php echo $firstName != '' ? $firstName.' '.$lastName : $user->user_login; ?>
                            </a>
                        </td>
                        <td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo get_the_title($cliente->club_id); ?></a></td>
                        <td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo get_the_title($producto_id); ?></a></td>
                        <td>
                            <?php if(function_exists('getCostoVariationID')): 
                                $variationAttr = getCostoVariationID($cliente->producto_id); 
                                echo $variationAttr->temporalidad; ?>
                            <?php endif; ?>
                        </td>
                        <td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->saldo; ?></a></td>
                        <td><a href="<?php echo admin_url().'admin.php?page=cliente&id_cliente='.$cliente->cliente_id; ?>"><?php echo $cliente->costo_semanal_canasta; ?></a></td>
                    </tr>
                <?php endforeach;
            endif; ?>
        </tbody>

    </table>

	
</div>