<div class="wrap">
    <h1>
        <?php echo $idClub != 0 ? 'Club - '.get_the_title($idClub) : 'Canastas base'; ?>
    </h1>
    <h3>Canastas Activas</h3>
   
    <?php if (!empty($canastasActivas)):?>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas&id_club='.$idClub; ?>">
            Editar canastas
        </a>
        <hr>
    <?php else: ?>
        <div class="mensaje mensaje-error">No tiene canastas activas</div>
        <br>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=crear_canastas&id_club='.$idClub; ?>">
            Crear primera canasta
        </a>
    <?php endif; ?>
    <hr>
    <h3>Canastas Programadas</h3>
    <?php if (!empty($canastasProgramadas)):?>
         <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas&id_club='.$idClub; ?>">
            Editar canastas
        </a>
        <hr>
    <?php else: ?>
        <div class="mensaje mensaje-error">No tiene canastas programadas</div>
        <br>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas&id_club='.$idClub; ?>">
            Programar próxima canasta
        </a>
   <?php endif; ?>
   
  
    <?php if (!empty($productos)): 
        foreach ($productos as $key => $product): 
            $idCanasta = $product->ID.$idClub; ?>
            <!-- <div class="content-ingredientes bg">
                <h3 class="text-center"><?php echo $product->post_title; ?> </h3>
                <div class="body-canasta">
                    <ul>
                        
                    </ul>
                </div>
                <p class="actualizacion"><strong>Ultima Actualización:</strong> Martes, 29 de Octubre del 2016</p>
            </div> -->
        <?php endforeach;
    endif; ?>
</div>