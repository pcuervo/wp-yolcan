<?php 

/** 
 * AGREGAR MENU PARA VER VISITAS AGENDADAS
 */
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

/** 
 * AGREGAR MENU PARA VER CREA TU CLUB
 */
add_action( 'admin_menu', 'menuCreaTuClub' );

/** Step 1. */
function menuCreaTuClub() {
	add_menu_page( 'Crea tu club', 'Crea tu club', 'read', 'crea-tu-club', 'crea_tu_club', '', 8);
}

/** Step 3. */
function crea_tu_club() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	$theme_dir = get_template_directory();
	include_once($theme_dir.'/templates/admin/crea-tu-club.php');
}