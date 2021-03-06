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

if (isset($_GET['page']) AND $_GET['page'] == 'saldo_insuficiente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("saldoInsuficiente", "Saldo Insuficiente", "saldo_insuficiente");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'por_club'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("clubes", "Cliestes por Club", "por_club");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'cliente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("cliente", "Cliente", "cliente");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'editar_cliente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("editarCliente", "Editar cliente", "editar_cliente");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'update_cliente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("updateCliente", "Update cliente", "update_cliente");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'reanudar_entrega'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("reanudarEntregas", "Reanudar entregas cliente", "reanudar_entrega");' ) );
} 

if (isset($_GET['page']) AND $_GET['page'] == 'historial_cliente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("historialCanastas", "Historial cliente", "historial_cliente");' ) );
}

if (isset($_GET['page']) AND $_GET['page'] == 'ingredientes_canasta_cliente'){
	add_action( 'admin_menu', create_function( '', 'ClientesController::index("ingredientesCanasta", "Historial cliente", "ingredientes_canasta_cliente");' ) );
}

