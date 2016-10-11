<?php $user = get_user_by( 'id', $restauranteId );  ?>
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
        <p><strong>Ingredientes agregados</strong></p>
        <form id="form-corte-restaurant" action="<?php echo admin_url().'admin.php?page=save_compra_restaurante&id_restaurante='.$restauranteId; ?>" method="POST">
            <div class="ingredientes-agregados-compra">
            
            </div>
            <p>Total: $<span id="total-compra">0</span></p>
            <input class="bt-corte-restaurant" type="submit" value="Generar compra">
        </form>
        
    </div>
    <div class="content-ingredientes-restaurante">
    	<?php if ( $ingredientes->have_posts() ) : 
            while ( $ingredientes->have_posts() ) : $ingredientes->the_post(); 
                $terms = wp_get_post_terms( get_the_ID(), 'unidades' );
                $unidad = isset($terms[0]) ? $terms[0]->name : '';
                $precio = get_post_meta(get_the_ID(), 'precio_ingrediente_restaurante', true); ?>
                <div class="caja-ingrediente">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <p class="titulo-ingrediente"><strong><?php echo the_title(); ?></strong></p>
                    <p><?php echo '$'.$precio ?> - (<strong><?php echo $unidad ?></strong>)</p>
                    <input type="text" id="cantidad-<?php the_ID(); ?>" value="">
                    <span 
                        class="add-ingrediente" 
                        data-id="<?php the_ID(); ?>" 
                        data-ingrediente="<?php the_title(); ?>" 
                        data-unidad="<?php echo $unidad; ?>"
                        data-precio="<?php echo $precio; ?>">+
                    </span>
                </div>
                
            <?php endwhile;
        endif; ?>
    </div>
	

	
</div>