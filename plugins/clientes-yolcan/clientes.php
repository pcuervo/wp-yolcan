<?php 
/**
 * @package GestionDeClientes
 */
/*
Plugin Name: Clientes Yolcan
Description: Administrador de clientes. 
Version: 1.0
Author: Alejandro Cervantes para pcuervo.com
Author URI: http://alejandrocervantes.me
*/

global $errores;
global $mesage_error;

define( 'PATH_CLIENTESURL', plugins_url(basename( dirname(__FILE__))) . "/");
define( 'PATH_CLIENTES', dirname(__FILE__));
define( 'PATH_VERSION_CLIENTES', "1.0");

add_action( 'admin_enqueue_scripts', function(){
	// scripts
	wp_enqueue_style('clientes-css', PATH_CLIENTESURL . 'resources/style.css');

});

require(PATH_CLIENTES."/helpers.php");
require(PATH_CLIENTES."/controller/ClientesController.php");
require(PATH_CLIENTES."/models/ClientesModel.php");

register_activation_hook( __FILE__, array( 'ClientesModel', 'install' ) );


add_action( 'admin_menu', create_function( '', 'ClientesController::index("activos", "Clientes", "activos");' ) );

if (isset($_GET['page']) AND $_GET['page'] == 'no_activos'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("noActivos", "Cliestes No Activos", "no_activos");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'suspendidos'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("suspendidos", "Cliestes Suspendidos", "suspendidos");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'proximos_caducar'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("proximosCaducar", "Cliestes Próximos a caducar", "proximos_caducar");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'por_club'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("clubes", "Cliestes por Club", "por_club");' ) );
}