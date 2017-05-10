<html>
    <head>
        <title>Reporte diario PDF</title>
        <link href="http://fonts.googleapis.com/css?family=Roboto:300,500,400,700" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo PATH_CANASTA; ?>/resources/style-pdf.css" type="text/css"/>
    </head>
    <body>
        
        <?php if (!empty($ventas)): 
        foreach ($ventas as $key => $club): ?>
            <center>
                <h2>Reporte ventas clientes - <?php echo get_the_title($key); ?></h2>
            </center>
            <?php foreach ($club as $key_C => $canasta) : ?>
                
                <h3><?php echo get_the_title($key).' - '.get_the_title($key_C); ?></h3>
                <div class="container-reporte-cliente">
                    <?php foreach ($canasta as $venta) : 
                        $user = get_user_by( 'id', $venta->cliente_id ); ?>
                        <div>
                            <p><strong>Cliente ID: </strong><?php echo $venta->cliente_id; ?></p>
                            <p class="top-d"><strong>Nombre: </strong><?php echo $user->display_name; ?></p> 
                        </div>
                        <div>
                            <p><strong>Email: </strong><?php echo $user->user_email; ?></p> 
                            <p class="top-d"><strong>Club: </strong><?php echo get_the_title($venta->club_id); ?></p>
                        </div>
                        <div>
                            <p><strong>Canasta: </strong><?php echo get_the_title($venta->canasta_id_real); ?></p>
                            <p class="top-d"><strong>Fecha corte: </strong><?php echo $venta->fecha_corte; ?></p>
                        </div>
                        <br>
                        <div>
                            <p><strong>Adicionales: </strong>
                                <?php $adicionales = unserialize($venta->adicionales); 
                                $html = '';
                                $count = 0;
                                if (!empty($adicionales['ingredientes'])) :
                                    $total = count($adicionales['ingredientes']) - 1;
                                    foreach ($adicionales['ingredientes'] as $key => $ingrediente): 
                                        $html .= '* '.get_the_title($ingrediente['ingredienteID']);
                                        $html .= $count < $total ? ', ' : '';
                                        $count++;
                                    endforeach;
                                endif; 

                                echo $html;?>
                            </p>
                        </div>
                        
                        
                    <?php endforeach; ?>
                </div>
            <?php endforeach;
            echo '<div style="page-break-after:always;"></div>';
        endforeach; 
    endif; ?>
    </body>
</html>