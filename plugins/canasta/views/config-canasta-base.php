<div class="wrap">
    <h1><?php echo $titulo; ?></h1>
    <hr>
    <form action="" method="POST">
        <h4>Clubes a aplicar</h4>
        <?php if($messaje): ?>
            <p class='mensaje'>
                Se duplicaron los ingredientes de la canasta base para los siguientes clubs de consumo <strong>
                    <?php if(!empty($clubesBase)):
                        $count = 0;
                        foreach ($clubesBase as $clube):
                            if ($clube != 0) :
                                $coma = $count > 0 ? ', ' : ' ';
                                echo $coma.get_the_title($clube);
                                $count++;
                            endif;
                        endforeach;
                    endif; ?>
                </strong>
            </p>
            <hr>
        <?php endif; ?>
        <table class="table-clubes-config-cb">
            <thead>
                <tr>
                    <th></th>
                    <th>Club</th>
                </tr>
            </thead>
            <tbody>
                 <?php if(!empty($clubes)): 
                    foreach ($clubes as $key => $club):
                        $check = isset($clubesAplica[$club->ID]) ? 'checked' : ''; ?>
                        <tr>
                            <td class="ingrediente">
                                <input type="checkbox" name="clubes[<?php echo $club->ID; ?>]" value="<?php echo $club->ID; ?>" <?php echo $check; ?>>
                            </td>
                            <td>
                                <?php echo $club->post_title; ?>
                            </td>
                        </tr>
                    <?php endforeach;
                endif; ?>
            </tbody>
        </table>
        <input type="hidden" name="clubes[0]" value="0">
        <input type="hidden" name="cb" value="<?php echo $cb; ?>">
        <input class="button button-primary" type="submit" name="" id="" value="Guardar configuración">
    </form>
</div>