<div class="wrap">
    <h1>Canastas Actuales</h1>
    <hr>
    <h3>Clubs de consumo</h3>
    <?php if (! empty($clubes)) : ?>
        <ul class="ul-clubes">
            <?php foreach ($clubes as $key => $club): ?>
                
                <li class="text-center">
                    <h3><?php echo $club->post_title; ?></h3>
                    <a href="<?php echo admin_url().'admin.php?page=canastas_club&id_club='.$club->ID; ?>">
                        Ver Canastas
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>