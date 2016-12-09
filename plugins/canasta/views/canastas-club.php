<div class="wrap">
    <h1>
        <?php echo ($idClub >= 1 && $idClub <= 5) ? 'Canastas base '.$idClub : 'Club - '.get_the_title($idClub); ?>
    </h1>
    <?php if (!isset($historial)): ?>
        <h3>Canastas Activas</h3>
    <?php endif; ?>
    
    <!-- CANASTAS ACTIVAS -->
    <?php if (!empty($canastasActivas)):
        $canastas = $canastasActivas['canastas']; 
        $actualizacion = $canastasActivas['actualizacion'];
        if (!isset($historial)): ?>
            <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=canasta'; ?>">
                << Regresar clubes
            </a>
            <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas&id_club='.$idClub; ?>">
                Editar canastas
            </a>
            <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=historial_canastas&id_club='.$idClub; ?>">
                Ver historial canastas
            </a><br><br>
        <?php else: ?>
            <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=historial_canastas&id_club='.$idClub; ?>">
                Regresar historial de canastas
            </a><br><br>
        <?php endif; ?>
        <p>
            <strong>Fecha de creación:</strong> <?php echo getDateTransformFormat($actualizacion->fecha_creacion); ?><br>
            <strong>Fecha de aplicación:</strong> <?php echo getCorteCanasta($actualizacion->fecha_creacion); ?><br>
        </p>
        <div class="content-canastas">
            <?php if (!empty($productos)): 

                foreach ($productos as $key => $product): 
                    $idCanasta = $idClub.$product->ID;
                    $ingredientes = isset($canastas[$idCanasta]) ? $canastas[$idCanasta] : []; ?>
                    <div class="content-ingredientes bg">
                        <h3 class="text-center"><?php echo $product->post_title; ?>  </h3>
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
                        <p class="actualizacion"><strong>Ultima Actualización:</strong><br> <?php echo getDateTransformFormat($actualizacion->fecha_actualizacion); ?></p>
                    </div>
                <?php endforeach;

            endif; ?>
        </div>

    <?php else: ?>

        <div class="mensaje mensaje-error">No tiene canastas activas</div>
        <br>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=historial_canastas&id_club='.$idClub; ?>">
            Regresar historial de canastas
        </a>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=crear_canastas&id_club='.$idClub; ?>">
            Crear primera canasta
        </a>

    <?php endif; ?>

    <hr>

    <!-- CANASTAS PROGRAMADAS
    <h3>Canastas Programadas</h3>
    <?php if (!empty($canastasProgramadas)):
        $canastasP = $canastasProgramadas['canastas']; 
        $actualizacionP = $canastasProgramadas['actualizacion']; ?>
         <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=editar_canastas_programadas&id_club='.$idClub; ?>">
            Editar canastas
        </a>
        <br>
        <?php if ($actualizacionP->fecha_activar_canasta != '0000-00-00'): ?>
             <h4>Fecha de aplicación: <?php echo getDateTransformFormat($actualizacionP->fecha_activar_canasta); ?> </h4>
        <?php else: ?>
            <div class="mensaje mensaje-error">Favor de poner una fecha de aplicación</div>
        <?php endif; ?>
        
        <div class="content-canastas">
            <?php if (!empty($productos)): 

                foreach ($productos as $key => $product): 
                    $idCanasta = $idClub.$product->ID;
                    $ingredientes = isset($canastasP[$idCanasta]) ? $canastasP[$idCanasta] : []; ?>
                    <div class="content-ingredientes bg">
                        <h3 class="text-center"><?php echo $product->post_title; ?> </h3>
                        <div class="body-canasta">
                            <ul>
                                <?php if (!empty($ingredientes)): 
                                    foreach ($ingredientes as $key => $ingrediente): ?>
                                        <li>- <?php echo get_the_title($ingrediente->ingrediente_id); ?></li>
                                    <?php endforeach;
                                endif; ?>
                            </ul>
                        </div>
                        <p class="actualizacion"><strong>Ultima Actualización:</strong><br> <?php echo getDateTransformFormat($actualizacionP->fecha_actualizacion); ?></p>
                    </div>
                <?php endforeach;

            endif; ?>
        </div>
        <hr>
    <?php else: ?>
        <div class="mensaje mensaje-error">No tiene canastas programadas</div>
        <br>
        <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=programar_canastas&id_club='.$idClub; ?>">
            Programar próxima canasta
        </a>
   <?php endif; ?> -->
   
</div>