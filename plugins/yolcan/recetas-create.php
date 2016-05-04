<?php
function recetas_create () {
$nombre = $_POST["nombre"];
$texto = $_POST["texto"];
$ingredientes = $_POST["ingredientes"];
//insert
if(isset($_POST['insert'])){
	global $wpdb;
	$wpdb->insert(
		'yolcan_recetas', //table
		array('id' => $id,'nombre' => $nombre,'texto' => $texto, 'ingredientes' => $ingredientes), //data
		array('%s','%s') //data format			
	);
	$message.="La receta fue agregada con éxito!";
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/yolcan/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h1 class="iconos"><span class="dashicons dashicons-plus iconos" style="background: rgb(71,133,65);"></span> Crear una nueva receta</h1><br>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <table class="wp-list-table widefat fixed ingrediente">
        <tr><th style="width:20%;"><span class="dashicons dashicons-grid-view iconos2"></span> NOMBRE: </th><td><input type="text" name="nombre" value="<?php echo $nombre;?>" class="entrada"/></td></tr>
        <tr><th><span class="dashicons dashicons-media-spreadsheet iconos2"></span> RECETA: </th><td><textarea rows="7" cols="70" type="text" name="texto"></textarea></td></tr>
        <tr><th><span class="dashicons dashicons-carrot iconos2"></span> INGREDIENTES: </th><td>
            <?php
            global $wpdb;
            $rows = $wpdb->get_results("SELECT * FROM wp_yolcan");
            ?>
            <ul>
            <?php
                foreach ($rows as $row ){
                    if (!empty($row->nombre)){
                        //echo "<td>$row->ID</td>";
                        echo "<li><input type='checkbox' name='vehicle' value='".$row->nombre."'>$row->nombre</li>";
                    }else{
                        echo "<p>Lo sentimos, no hay ingredientes disponibles.</p>";
                    }
                }
            ?>
            </ul>
        <tr><th></th><td><input class="btn-success" style="position:relative;float:right;" type='submit' name="insert" value='GUARDAR RECETA' class='button'></td></tr>
    </table>
</form>
</div>
<?php
}