<?php
function ingredientes_update () {
global $wpdb;
$id = $_GET["id"];
$nombre=$_POST["nombre"];
    $puntos=$_POST["puntos"];
//update
if(isset($_POST['update'])){	
	$wpdb->update(
		'wp_yolcan', //table
		array('nombre' => $nombre), //data
		array('ID' => $id ), //where
		array('%s'), //data format
		array('%s') //where format
	);	
}
//delete
else if(isset($_POST['delete'])){	
	$wpdb->query($wpdb->prepare("DELETE FROM wp_yolcan WHERE id=%s",$id));
}
else{//selecting value to update	
	$ingrediente = $wpdb->get_results($wpdb->prepare("SELECT * from wp_yolcan where id=%s",$id));
	foreach ($ingrediente as $s ){
		$nombre=$s->nombre;
        $canasta_completa=$s->canasta_completa;
        $media_canasta=$s->media_canasta;
        $adicional=$s->adicional;
        $puntos=$s->puntos;
	}
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/yolcan/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Actualizar Ingrediente</h2><br>

<?php if($_POST['delete']){?>
<div class="updated"><p>Ingrediente eliminado</p></div>
<a href="<?php echo admin_url('admin.php?page=yolcan_list')?>">&laquo; Regresar a lista de ingredientes</a>

<?php } else if($_POST['update']) {?>
<div class="updated"><p>Ingrediente actualizado</p></div>
<a href="<?php echo admin_url('admin.php?page=yolcan_list')?>">&laquo; Regresar a lista de ingredientes</a>

<?php } else {?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed ingrediente'>
<tr><th style="width:15%;">NOMBRE:</th><td><input type="text" name="nombre" value="<?php echo $nombre;?>" class="entrada"/></td></tr>
<tr><th>CANASTA :</th><td><input type="checkbox" name="canasta_completa" value="canasta_completa"> CANASTA COMPLETA<br><input type="checkbox" name="media_canasta" value="media_canasta"> MEDIA CANASTA<br><input type="checkbox" name="adicional" value="adicional"> ADICIONALES<br></td></tr>
<tr><th>PUNTOS :</th><td><input type="text" name="puntos" value="<?php echo $puntos;?>" class="entrada"/></td></tr>
</table>
    <div align="center">
        <input type='submit' name="update" value='Guardar' class='btn-success'> &nbsp;&nbsp;
        <input type='submit' name="delete" value='Eliminar' class='btn-success borrar' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
    </div>
</form>
<?php }?>

</div>
<?php
}