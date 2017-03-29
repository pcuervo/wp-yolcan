<?php $club = $data['club'] != 'all' ? get_the_title($data['club']) : 'Todos';
$canasta = $data['canasta'] != 'all' ? get_the_title($data['canasta']) : 'Todas'; ?>
<div class="wrap">
    <h1>
        Reporte  de ventas
    </h1>
    <hr>
    <p>
        <strong>Club:</strong> <?php echo $club; ?>, 
        <strong>Canasta:</strong> <?php echo $canasta; ?>,
        <?php if ($data['resporte_del'] != ''): ?>
            <strong>Del:</strong> <?php echo $data['resporte_del']; ?>,
        <?php endif; ?>
        <?php if ($data['resporte_a'] != ''): ?>
            <strong>A:</strong> <?php echo $data['resporte_a']; ?>,
        <?php endif; ?>
        <?php if ($data['cliente'] != ''): ?>
            <strong>Cliente:</strong> <?php echo $data['cliente']; ?>,
        <?php endif; ?>
        
    </p>
    <?php if (!empty($ventas)): 
        foreach ($ventas as $key => $club): 
            foreach ($club as $key_C => $canasta) : ?>
                <h2><?php echo get_the_title($key).' - '.get_the_title($key_C); ?></h2>
                <table class="wp-list-table widefat fixed striped tags">
                    <tr>
                        <th>Cliente ID</th>
                        <th>Nombre</th> 
                        <th>Email</th> 
                        <th>Club</th>
                        <th>Canasta</th>
                        <th>Adicionales</th> 
                        <th>Fecha del corte</th> 

                    </tr>
                    <?php foreach ($canasta as $venta) : 
                        $user = get_user_by( 'id', $venta->cliente_id ); ?>
                        <tr>
                            <td><?php echo $venta->cliente_id; ?></td>
                            <td><?php echo $user->display_name; ?></td> 
                            <td><?php echo $user->user_email; ?></td> 
                            <td><?php echo get_the_title($venta->club_id); ?></td>
                            <td><?php echo get_the_title($venta->canasta_id_real); ?></td>
                            <td>
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
                            </td>
                            <td><?php echo $venta->fecha_corte; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach;
            echo '<hr>';
        endforeach; 
    endif; ?>
    
                
        
</div>