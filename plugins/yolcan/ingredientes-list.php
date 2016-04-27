<?php
function ingredientes_list () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/yolcan/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h1 class="iconos"><span class="dashicons dashicons-star-filled iconos" style="background: rgb(71,133,65);"></span> Ingredientes - Canastas YOLCAN</h1><br>

<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT * from wp_yolcan");
echo "<table class='wp-list-table widefat fixed ingrediente'>";
echo "<tr><th class='border'>ID</th><th class='border'>Nombre</th><th class='border'>Canasta</th><th class='border'>Puntos</th><th class='border'>&nbsp;</th></tr>";
foreach ($rows as $row ){
	echo "<tr>";
	echo "<td class='centrar'>$row->id</td>";
	echo "<td class='centrar'>$row->nombre</td>";
    echo "<td class='centrar'>
    <ul class='ing_canasta'>";
        ?>
        <?php
        if (!empty($row->canasta_completa)):
           echo "<li>Canasta completa</li>";
        endif;
        if (!empty($row->media_canasta)):
           echo "<li>Media canasta</li>";
        endif;
        if (!empty($row->adicional)):
           echo "<li>Adicional</li>";
        endif;
        ?>
    <?php
    echo "</ul>";
    echo "</td>";
    echo "<td class='centrar'>$row->puntos</td>";
	echo "<td><a class='btn-success-chico' href='".admin_url('admin.php?page=ingredientes_update&id='.$row->id)."'>Actualizar</a></td>";
	echo "</tr>";}
echo "</table>";
?>
    <div align="center">
        <a class="btn-success" style="margin-bottom:20px;" href="<?php echo admin_url('admin.php?page=ingredientes_create'); ?>">Agregar nuevo ingrediente</a>
    </div>
</div>
<?php
}