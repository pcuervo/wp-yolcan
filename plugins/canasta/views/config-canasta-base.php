<div class="wrap">
    <h1><?php echo $titulo; ?></h1>
    <hr>
    <form action="" method="POST">
        <h4>Clubes a aplicar</h4>
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

        <input class="button button-primary" type="submit" name="" id="" value="Guardar configuración">
    </form>
</div>