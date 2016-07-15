<div class="wrap">
    <h1>Club - <?php echo get_the_title($idClube); ?></h1>
    <hr>
    <h3>Canastas</h3>
    <?php if (!empty($productos)): 
        foreach ($productos as $key => $product): ?>
            <div class="content-ingredientes bg">
                <h3 class="text-center"><?php echo $product->post_title; ?> </h3>
                <div class="body-canasta">
                    <ul>
                        
                    </ul>
                </div>
                <p class="actualizacion"><strong>Ultima Actualización:</strong> Martes, 29 de Octubre del 2016</p>
            </div>
        <?php endforeach;
    endif; ?>
</div>