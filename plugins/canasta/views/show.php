<div class="wrap">
	<h1>Canastas Actuales</h1>
	<hr>
	<h3>Ingredientes por canasta | club de consumo</h3>
        <?php
        $productos = CanastaModel::productos();
        $clubes = CanastaModel::clubes();
        $ingredientes = CanastaModel::ingredientes();
        $ingredientespuntos = CanastaModel::ingredientes(); 
        ?>
        <table class="widefat" cellspacing="0">
            <thead>
            <tr>
                
                    <th id="columnname" class="manage-column column-columnname" scope="col">ID CLUB</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">ID PRODUCTO</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">CLUB DE CONSUMO</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">TIPO DE CANASTA</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">INGREDIENTES</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col"></th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                    <th class="manage-column column-columnname" scope="col"></th>
                    <th class="manage-column column-columnname" scope="col"></th>
                    <th class="manage-column column-columnname" scope="col"></th>
                    <th class="manage-column column-columnname" scope="col"></th>
                    <th class="manage-column column-columnname" scope="col"></th>
                    <th class="manage-column column-columnname" scope="col"></th>
            </tr>
            </tfoot>

            <tbody>
                <?php
                if ( ! empty($productos) AND ! empty($clubes) ) {
                    foreach ($clubes as $key => $club) {
                        foreach ($productos as $key => $producto) {
                                $club_id = $club->ID;
                                $producto_id = $producto->ID;
                                $club_consumo = $club->post_title;
                                $club_producto = $producto->post_title;
                                ?>
                                    <tr class="alternate" valign="top" style="border-bottom: 1px solid #333;">
                                        <td class="column-columnname" style="border-bottom: 1px solid #999;"><p style="text-align: center;"><?php echo $club_id; ?></p></td>
                                        <td class="column-columnname" style="border-bottom: 1px solid #999;"><p style="text-align: center;"><?php echo $producto_id; ?></p></td>
                                        <td class="column-columnname" style="border-bottom: 1px solid #999;"><p><b><?php echo $club_consumo; ?></b></p></td>
                                        <td class="column-columnname" style="border-bottom: 1px solid #999;"><p><b><?php echo $club_producto; ?></b></p></td>
                                        <td class="column-columnname" style="border-bottom: 1px solid #999;">
                                            <ul style="list-style: decimal; margin:0; padding: 0;">
                                            <?php
                                            foreach ($ingredientespuntos as $key => $ingrediente) {
                                                $ingrediente_name = $ingrediente->post_title;
                                                $ingrediente_id = $ingrediente->ID;
                                                    echo "<li>".$ingrediente_id."-".$ingrediente_name."</li>";
                                            }
                                            ?>
                                            </ul>
                                        </td>
                                        <td style="border-bottom: 1px solid #999;"><a class="button button-primary" href="<?php echo admin_url().'admin.php?page=edit_canasta'; ?>">EDITAR CANASTA</a></td>
                                    </tr>
                                <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
</div>