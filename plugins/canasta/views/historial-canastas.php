<div class="wrap">
    <h1>
        <?php echo $titulo; ?>
    </h1>

    <h3 class=""><?php echo $clubId != 1 ? 'Club - '.get_the_title($clubId) : 'Canastas base'; ?></h3>
    <a class="button-primary"  href="<?php echo admin_url().'admin.php?page=canastas_club&id_club='.$clubId; ?>">
        << Regresar
    </a>
    <br>
    <br>
    <table class="wp-list-table widefat fixed striped users">
        <thead>
            <tr>
                <th scope="col" class="manage-column"><span>Fecha de aplicación</span></th>
                <th scope="col" class="manage-column"><span>Fecha de creación</span></th>
                <th scope="col" class="manage-column"><span>Fecha de ultima actualización</span></th>
                <th scope="col" class="manage-column">Status</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php if(!empty($historial)):
                foreach ($historial as $historia):  ?>
                    <tr>
                        <td><a href="<?php echo admin_url().'admin.php?page=ingredientes_canastas&id_actualización='.$historia->id.'&id_club='.$clubId; ?>"><?php echo getCorteCanasta($historia->fecha_creacion); ?></a></td>
                        <td><?php echo getDateTransformFormat($historia->fecha_creacion); ?></td>
                        <td><?php echo getDateTransformFormat($historia->fecha_actualizacion); ?></td>
                        <td><?php echo $historia->status == 0 ? 'Inactiva' : 'Activa'; ?></td>
                        
                    </tr>
                <?php endforeach;
            endif; ?>
        </tbody>

    </table>
    
   
</div>