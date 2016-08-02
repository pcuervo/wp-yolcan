<?php $user = get_user_by( 'id', $clienteId ); 
$producto_id = wp_get_post_parent_id( $canasta->variation_id );
$variationAttr = function_exists('getCostoVariationID') ? getCostoVariationID($canasta->variation_id) : []; ?>
<div class="wrap">
	<h1>
        Cliente - <?php echo $user->user_login; ?>
    </h1>
    <hr>
     <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=historial_cliente&id_cliente='.$clienteId; ?>">
        << Regresar historial
    </a>
    <h2>
		Ingredientes Canasta
	</h2>
  	<div class="content-canastas">
        
        <div class="content-ingredientes bg">
            <h3 class="text-center"><?php echo get_the_title($producto_id); ?></h3>
            <div class="body-canasta">
                <ul>
                    <?php if (!empty($ingredientes)): 
                        foreach ($ingredientes as $key => $ingrediente):
                            $terms = wp_get_post_terms( $ingrediente->ingrediente_id, 'unidades' ); ?>
                            <li>- <?php echo get_the_title($ingrediente->ingrediente_id); ?> (<?php echo $ingrediente->cantidad; ?> <?php echo isset($terms[0]) ? $terms[0]->name : ''; ?> )</li>
                        <?php endforeach;
                    endif; ?>
                </ul>
            </div>
        </div>

        <div class="content-ingredientes bg">
            <h3 class="text-center">Adicionales</h3>
            <div class="body-canasta">
                <ul>
                    <?php 
                    $adicionales = isset($canasta->adicionales) ? unserialize($canasta->adicionales) : [];
                    $ingredientesAdicionales = isset($adicionales['ingredientes']) ? $adicionales['ingredientes'] : [];
                    if (!empty($ingredientesAdicionales)): 
                        foreach ($ingredientesAdicionales as $key => $ingrediente):
                            $terms = wp_get_post_terms( $ingrediente['ingredienteID'], 'unidades' ); ?>
                            <li>- <?php echo get_the_title($ingrediente['ingredienteID']); ?> (<?php echo $ingrediente['cantidad']; ?> <?php echo isset($terms[0]) ? $terms[0]->name : ''; ?> ) $<?php echo $ingrediente['total']; ?></li>
                        <?php endforeach;
                    else:
                    	echo '<li>No adquirio adicionales</li>';
                    endif; ?>
                </ul>
            </div>
        </div>

    </div>
	
</div>