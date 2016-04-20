<?php
/*
Plugin Name: YOLCAN Canastas
Description: Creación y edición de canastas YOLCAN
Version: 1.0
Author: Axel Obscura para pcuervo.com
Author URI: http://pcuervo.com/
*/

function yolcan_install() {
   global $wpdb;
   $table_yolcan = $wpdb->prefix . "yolcan";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      $sql = "CREATE TABLE " . $table_yolcan . " (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      nombre varchar(120) NOT NULL,
      canasta_completa varchar(120) NOT NULL,
      media_canasta varchar(120) NOT NULL,
      adicional varchar(120) NOT NULL,
      puntos varchar(120) NOT NULL,
      receta varchar(120) NOT NULL,
      entrega datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      ultima_actualizacion timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY  (id)
      );";
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
   }
}
register_activation_hook(__FILE__,'yolcan_install');

function recetas_install() {
   global $wpdb;
   $table_recetas = $wpdb->prefix . "yolcan_recetas";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      $sql = "CREATE TABLE " . $table_recetas . " (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      nombre varchar(120) NOT NULL,
      texto varchar(400) NOT NULL,
      ingredientes varchar(120) NOT NULL,
      ultima_actualizacion timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY  (id)
      );";
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
   }
}
register_activation_hook(__FILE__,'recetas_install');

//menu items
add_action('admin_menu','yolcan_modifymenu');
function yolcan_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Canastas YOLCAN', //page title
	'Canastas YOLCAN', //menu title
	'manage_options', //capabilities
	'yolcan_list', //menu slug
	yolcan_list //function
	);
    
    //this is a submenu
	add_submenu_page('yolcan_list', //parent slug
	'Ingredientes', //page title
	'Ingredientes', //menu title
	'manage_options', //capability
	'ingredientes_list', //menu slug
	ingredientes_list); //function
	
	//this is a submenu
	add_submenu_page('yolcan_list', //parent slug
	'Agregar Ingrediente', //page title
	'Nuevo ingrediente', //menu title
	'manage_options', //capability
	'ingredientes_create', //menu slug
	ingredientes_create); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Editar ingrediente', //page title
	'Editar ingrediente', //menu title
	'manage_options', //capability
	'ingredientes_update', //menu slug
	ingredientes_update); //function
    
    //this is a submenu
	add_submenu_page('yolcan_list', //parent slug
	'Agregar Receta', //page title
	'Nueva Receta', //menu title
	'manage_options', //capability
	'recetas_create', //menu slug
	recetas_create); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'yolcan-list.php');
require_once(ROOTDIR . 'ingredientes-list.php');
require_once(ROOTDIR . 'ingredientes-create.php');
require_once(ROOTDIR . 'ingredientes-update.php');
require_once(ROOTDIR . 'recetas-create.php');
