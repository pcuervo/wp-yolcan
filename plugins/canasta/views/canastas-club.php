<div class="wrap">
    <h1>
        <?php echo $idClub != 0 ? 'Club - '.get_the_title($idClub) : 'Canastas base'; ?>
    </h1>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas&id_club='.$idClub; ?>">
        Editar canastas
    </a>
    <hr>
    <?php if (!empty($productos)): 
        foreach ($productos as $key => $product): 
            $idCanasta = $product->ID.$idClub; ?>
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