<?php
function ingredientes_create () {
$nombre = $_POST["nombre"];
$canasta_completa = $_POST["canasta_completa"];
$media_canasta = $_POST["media_canasta"];
$adicional = $_POST["adicional"];
$puntos = $_POST["puntos"];
$receta = $_POST["receta"];
$entrega = $_POST["entrega"];
//insert
if(isset($_POST['insert'])){
	global $wpdb;
	$wpdb->insert(
		'wp_yolcan', //table
		array('nombre' => $nombre, 'canasta_completa' => $canasta_completa, 'media_canasta' => $media_canasta, 'adicional' => $adicional, 'puntos' => $puntos, 'receta' => $receta, 'entrega' => $entrega), //data
		array('%s','%s','%s','%s','%s','%s','%s')		
	);
	$message.="Ingrediente agregado";
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/yolcan/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h1 class="iconos"><span class="dashicons dashicons-plus iconos" style="background: rgb(71,133,65);"></span> Agregar nuevo ingrediente</h1><br>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <table class="wp-list-table widefat fixed ingrediente">
        <tr><th style="width:20%;">NOMBRE :</th><td><input type="text" name="nombre" value="<?php echo $nombre;?>" class="entrada"/></td></tr>
        <tr><th>CANASTA :</th><td><input type="checkbox" name="canasta_completa" value="canasta_completa" checked> CANASTA COMPLETA<br><input type="checkbox" name="media_canasta" value="media_canasta"> MEDIA CANASTA<br><input type="checkbox" name="adicional" value="adicional"> ADICIONALES<br></td></tr>
        <tr><th>PUNTOS :</th><td><input type="text" name="puntos" value="<?php echo $puntos;?>" class="entrada"/></td></tr>
        <tr><th>RECETAS :</th><td><input type="text" name="receta" value="<?php echo $receta;?>" class="entrada"/></td></tr>
        <tr><th>ENTREGA :</th><td><input type="text" name="entrega" value="<?php echo $entrega;?>" class="entrada"/></td></tr>
        <tr><th></th><td><input class="btn-success" style="position:relative;float:right;" type='submit' name="insert" value='GUARDAR INGREDIENTE' class='button'></td></tr>
    </table>
</form>
</div>
<?php
}