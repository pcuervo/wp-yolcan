<?php 
/**
 * @package CuestionarioSondeoCiudadano
 */
/*
Plugin Name: Canasta Yolcan
Description: Creación y edición de la canasta semanal, ademas de poder repartie la informacion correcta a cada usuario. 
Version: 1.0
Author: Alejandro Cervantes para pcuervo.com
Author URI: http://pcuervo.com
*/ 

global $errores;
global $mesage_error;

define( 'PATH_CANASTAURL', plugins_url(basename( dirname(__FILE__))) . "/");
define( 'PATH_CANASTA', dirname(__FILE__));
define( 'PATH_VERSION', "1.0");

add_action( 'admin_enqueue_scripts', function(){
	// scripts
	wp_enqueue_style('canasta-css', PATH_CANASTAURL . 'resources/style.css');

});

require(PATH_CANASTA."/helpers.php");
require(PATH_CANASTA."/controller/CanastaController.php");
require(PATH_CANASTA."/models/CanastaModel.php");

register_activation_hook( __FILE__, array( 'CanastaModel', 'install' ) );

add_action( 'admin_menu', create_function( '', 'CanastaController::index("canasta", "Canasta Semanal", "canasta");' ) );

$productos = CanastaModel::productos();
$clubes = CanastaModel::clubes();

if ( ! empty($productos) AND ! empty($clubes) ) {
	foreach ($clubes as $key => $club) {
		foreach ($productos as $key => $producto) {
			$page = $club->ID.'_'.$producto->ID;
			$name = $club->post_title.' - '.$producto->post_title;

			add_action( 'admin_menu', create_function( '', 'CanastaController::index("edit", "Editar '.$name.'", "editar-'.$page.'");' ) );
		}
	}
	
}