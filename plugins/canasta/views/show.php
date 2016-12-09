<div class="wrap">
    <h1>Canastas Actuales</h1>
    <hr>
    <h3>Canastas base</h3>
    <!-- <p>** Los Clubes en rojo usan la canasta base - ( Para dejar de usar la canasta base cambiar en la configuracion de la misma ).</p> -->
    <ul class="ul-clubes">
        <li class="text-center">
            <h3>Canasta Base</h3>
            <a href="<?php echo admin_url().'admin.php?page=canastas_club&id_club=1'; ?>">
                Ver Canastas
            </a>
            |
            <a href="<?php echo admin_url().'admin.php?page=configuaracion_canasta_base&cb=1'; ?>">
                Configuración
            </a>
        </li>
        
        <?php for ($i=2; $i < 6; $i++) { ?>
            <li class="text-center">
                <h3>Canasta Base <?php echo $i; ?></h3>
                <a href="<?php echo admin_url().'admin.php?page=canastas_club&id_club='.$i; ?>">
                    Ver Canastas
                </a>
                |
                <a href="<?php echo admin_url().'admin.php?page=configuaracion_canasta_base&cb='.$i; ?>">
                    Configuración
                </a>
            </li>
        <?php } ?>
    </ul>
    <hr>
    <h3>Clubs de consumo</h3>
    <?php if (! empty($clubes)) : ?>
        <ul class="ul-clubes">
            <?php foreach ($clubes as $key => $club):
                $class = isset($clubesCanastaBase[$club->ID]) ? 'danger-club' : ''; ?>
                
                <li class="text-center <?php echo $class; ?>">
                    <h3><?php echo $club->post_title; ?></h3>
                    <a href="<?php echo admin_url().'admin.php?page=canastas_club&id_club='.$club->ID; ?>">
                        Ver Canastas
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>