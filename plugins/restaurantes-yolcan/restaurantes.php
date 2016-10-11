<?php 
/**
 * @package GestionDeRestaurantes
 */
/*
Plugin Name: Restaurantes Yolcan
Description: Administrador de restaurantes. 
Version: 1.0
Author: Alejandro Cervantes para pcuervo.com
Author URI: http://alejandrocervantes.me
*/

global $errores;
global $mesage_error;

define( 'PATH_RESTAURANTESURL', plugins_url(basename( dirname(__FILE__))) . "/");
define( 'PATH_RESTAURANTES', dirname(__FILE__));
define( 'PATH_VERSION_RESTAURANTES', "1.0");

add_action( 'admin_enqueue_scripts', function(){
	// scripts
	wp_enqueue_style('restaurantes-css', PATH_RESTAURANTESURL . 'resources/style.css');
	wp_enqueue_script( 'restaurantes-js', PATH_RESTAURANTESURL . 'resources/functions-restaurantes.js', array('jquery'), '1.0', true );
});

require(PATH_RESTAURANTES."/helpers.php");
require(PATH_RESTAURANTES."/controller/RestaurantesController.php");
require(PATH_RESTAURANTES."/models/RestaurantesModel.php");

register_activation_hook( __FILE__, array( 'RestaurantesModel', 'install' ) );


add_action( 'admin_menu', create_function( '', 'RestaurantesController::index("activos", "Restaurantes", "restaurantes_activos");' ) );


if (isset($_GET['page']) AND $_GET['page'] == 'restaurantes_no_activos'){
	add_action( 'admin_menu', create_function( '', 'RestaurantesController::index("noActivos", "Restaurantes No Activos", "restaurantes_no_activos");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'restaurante'){
	add_action( 'admin_menu', create_function( '', 'RestaurantesController::index("restaurante", "Restaurante", "restaurante");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'cargar_saldo_restaurante'){
	add_action( 'admin_menu', create_function( '', 'RestaurantesController::index("saldoRestaurante", "Saldo Restaurante", "cargar_saldo_restaurante");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'update_saldo_restaurante'){
	add_action( 'admin_menu', create_function( '', 'RestaurantesController::index("updateSaldoRestaurante", "Actualizar Saldo Restaurante", "update_saldo_restaurante");' ) );
}