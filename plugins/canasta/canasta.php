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
	wp_enqueue_script( 'canastas-js', PATH_CANASTAURL . 'resources/functions-canastas.js', array('jquery'), '1.0', true );


});

require(PATH_CANASTA."/helpers.php");
require(PATH_CANASTA."/controller/CanastaController.php");
require(PATH_CANASTA."/controller/ReportesCanastasController.php");
require(PATH_CANASTA."/models/CanastaModel.php");

register_activation_hook( __FILE__, array( 'CanastaModel', 'install' ) );

add_action( 'admin_menu', create_function( '', 'CanastaController::index("canasta", "Canastas", "canasta");' ) );

add_action( 'admin_menu', create_function( '', 'ReportesCanastasController::index("reportes", "Reportes", "reportes");' ) );

if (isset($_GET['page']) AND $_GET['page'] == 'canastas_club'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("canastasClube", "Canastas del Club", "canastas_club");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'editar_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("editCanastas", "Editar canastas", "editar_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'crear_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("createCanastas", "Crear canastas", "crear_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'store_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("storeCanastas", "Crear canastas", "store_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'update_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("updateCanastas", "Actualizar canastas", "update_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'programar_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("createCanastasProgramadas", "Programar canastas", "programar_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'store_programar_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("storeCanastasProgramadas", "Programar canastas", "store_programar_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'editar_canastas_programadas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("editCanastasProgramadas", "Programar canastas", "editar_canastas_programadas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'configuaracion_canasta_base'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("configCanastaBase", "Configuracion canasta base", "configuaracion_canasta_base");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'historial_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("historialCanasta", "Historial de canastas", "historial_canastas");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'ingredientes_canastas'){
	add_action( 'admin_menu', create_function( '', 'CanastaController::index("showCanastas", "Ingredientes de canastas", "ingredientes_canastas");' ) );
}

/**
 * REPORTE CANASTAS
 */
if (isset($_GET['page']) AND $_GET['page'] == 'reporte_canastas'){
	add_action( 'admin_menu', create_function( '', 'ReportesCanastasController::index("reporteCanastas", "Reporte de canastas", "reporte_canastas");' ) );
}