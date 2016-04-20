<?php
function yolcan_list () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/yolcan/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Canastas YOLCAN | 
<?php global $current_user;
      get_currentuserinfo();
      echo $current_user->user_login;
      //echo $current_user->ID;
?>
</h2>

<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT * FROM wp_yolcan");
?>
<div class="wrap">
	<h1 class="iconos"><span class="dashicons dashicons-products iconos" style="background: rgb(71,133,65);"></span> Canastas actuales</h1>
	<hr>
	<div class="content-ingredientes">
		<h4>Canasta completa</h4>
        <hr>
		<p><strong>Ultima Actualización:</strong><br><?php foreach ($rows as $row ){ echo $row->ultima_actualizacion; } ?></p>
		<hr>
		<ul>
            <?php
                foreach ($rows as $row ){
                    if (!empty($row->canasta_completa)):
                        //echo "<td>$row->ID</td>";
                        echo "<li>$row->nombre <a href='".admin_url('admin.php?page=ingredientes_update&id='.$row->id)."' class='act_ingredientes'>Editar</a></li>";
                    endif;
                }
            ?>
		</ul>
	</div>
    <div class="content-ingredientes">
		<h4>Media Canasta</h4>
		<hr>
		<p><strong>Ultima Actualización:</strong><br><?php foreach ($rows as $row ){ echo $row->ultima_actualizacion; } ?></p>
		<hr>
		<ul>
            <?php
                foreach ($rows as $row ){
                    if (!empty($row->media_canasta)):
                        //echo "<td>$row->ID</td>";
                        echo "<li>$row->id $row->nombre <a href='".admin_url('admin.php?page=ingredientes_update&id='.$row->id)."' class='act_ingredientes'>Editar</a></li>";
                    endif;
                }
            ?>
		</ul>
	</div>
    <div class="content-ingredientes-adicionales">
		<h4>Adicionales en canasta</h4>
		<hr>
		<ul>
			<li class="header">
				<span class="ingrediente">Ingrediente</span>
				<span class="valor">Puntos</span>
			</li>
			     <?php foreach ($rows as $row ){ 
                    if (!empty($row->adicional)): ?> 
					<li>
						<span class="ingrediente"><?php echo $row->nombre; ?></span>
						<span class="valor"><?php echo $row->puntos; ?></span>
					</li>
                  <?php  endif; } ?>
		</ul>
	</div>
    <div class="agregar">
        <a class="btn-success" href="<?php echo admin_url('admin.php?page=yolcan_create'); ?>">Agregar canasta</a>
    </div>
</div>
</div>
<?php
}