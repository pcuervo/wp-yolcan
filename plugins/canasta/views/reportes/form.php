<div class="wrap">
    <h1>
        Reportes
    </h1>
    <hr>
    <form action="<?php echo admin_url().'admin.php'; ?>" method="get">
        <input type="hidden" name="page" value="reporte_canastas">
        <div>
            <label for="club">Selecciona un club</label>
            <select name="club" class="widefat">
                <option value="all" >Todos</option>
                <?php if (!empty($clubes)): 
                    foreach ($clubes as $key => $club): ?>
                        <option value="<?php echo $club->ID; ?>"><?php echo $club->post_title; ?></option>
                    <?php endforeach; 
                endif; ?>
            </select>
        </div>
        <div>
            <label for="canasta">Selecciona una canasta</label>
            <select name="canasta" class="widefat">
                <option value="all" >Todas</option>
                <?php if (!empty($canastas)): 
                    foreach ($canastas as $key => $canasta): ?>
                        <option value="<?php echo $canasta->ID; ?>"><?php echo $canasta->post_title; ?></option>
                    <?php endforeach; 
                endif; ?>
            </select>
        </div>
        <div>
            <p>Selecciona un rango de fechas del corte *</p>
        </div>
        <div>
            <label for="reporte-de">Fecha de inicio</label><br>
            <input id="reporte-de" type="text" class="date-piker-reports" name="reporte_del">
        </div>
        <div>
            <label for="reporte-a">Fecha final</label><br>
            <input id="reporte-a" type="text" class="date-piker-reports" name="reporte_a">
        </div>
         <div>
            <label for="cliente">Cliente ID</label><br>
            <input id="cliente" type="text" name="cliente">
        </div>
        <br>
        <input type="hidden" name="reporteCanastas" value="si">
        <input type="submit" class="button-primary" value="Traer reporte">
    </form>
</div>