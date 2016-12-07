<?php 

/** AGREGAR MENU PARA CARGAR CUPONES */
add_action( 'admin_menu', 'menuAgendaVisita' );

/** Step 1. */
function menuAgendaVisita() {
	add_menu_page( 'Visitas', 'Visitas', 'read', 'visitas', 'visitas_agendadas', '', 8);
}

/** Step 3. */
function visitas_agendadas() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	$theme_dir = get_template_directory();
	include_once($theme_dir.'/templates/admin/visitas.php');
}