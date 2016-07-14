<?php
// RENAME THE DEFAULT POST TYPE

function change_post_menu_label() {
    global $menu, $submenu;

    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'Blog';
    $submenu['edit.php'][10][0] = 'Nueva Nota';
    $submenu['edit.php'][16][0] = 'Blog Tags';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );



// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


	add_action('init', function(){


		// INGREDIENTES
		$labels = array(
			'name'          => 'Ingredientes',
			'singular_name' => 'Ingrediente',
			'add_new'       => 'Nuevo Ingrediente',
			'add_new_item'  => 'Nuevo Ingrediente',
			'edit_item'     => 'Editar Ingrediente',
			'new_item'      => 'Nuevo Ingrediente',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Ingrediente',
			'search_items'  => 'Buscar Ingrediente',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Ingredientes'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'ingredientes' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
                        'capability_type'    => array('ingrediente','ingredientes'),
                        'map_meta_cap'       => true,
		);
		register_post_type( 'ingredientes', $args );

		// RECETAS
		$labels = array(
			'name'          => 'Recetas',
			'singular_name' => 'Receta',
			'add_new'       => 'Nueva Receta',
			'add_new_item'  => 'Nueva Receta',
			'edit_item'     => 'Editar Receta',
			'new_item'      => 'Nueva Receta',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver Receta',
			'search_items'  => 'Buscar Receta',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Recetas'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'recetas' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
                        'capability_type'    => array('receta','recetas'),
                        'map_meta_cap'       => true,
		);
		register_post_type( 'recetas', $args );

		// RECETAS
		$labels = array(
			'name'          => 'Faq',
			'singular_name' => 'Faq',
			'add_new'       => 'Nueva faq',
			'add_new_item'  => 'Nueva faq',
			'edit_item'     => 'Editar faq',
			'new_item'      => 'Nueva faq',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver faq',
			'search_items'  => 'Buscar faq',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Faq'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'faq' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor' ),
                        'capability_type'    => array('faq','faqs'),
                        'map_meta_cap'       => true
		);
		register_post_type( 'faq', $args );

		// RECETAS
		$labels = array(
			'name'          => 'Contactos',
			'singular_name' => 'Contactos',
			'add_new'       => 'Nuevo Contacto',
			'add_new_item'  => 'Nuevo Contacto',
			'edit_item'     => 'Editar Contacto',
			'new_item'      => 'Nuevo Contacto',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Contacto',
			'search_items'  => 'Buscar Contacto',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Contactos'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'contactos' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor' ),
                        'capability_type'    => array('contacto','contactos'),
                        'map_meta_cap'       => true
		);
		register_post_type( 'contactos', $args );

		// BENEFICIOS
		$labels = array(
			'name'          => 'Beneficios',
			'singular_name' => 'Beneficios',
			'add_new'       => 'Nuevo Beneficio',
			'add_new_item'  => 'Nuevo Beneficio',
			'edit_item'     => 'Editar Beneficio',
			'new_item'      => 'Nuevo Beneficio',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Beneficio',
			'search_items'  => 'Buscar Beneficio',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Beneficios'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'beneficios' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( 'beneficios', $args );

		/**
		 * CLUBS DE CONSUMO
		 */
		$labels = array(
			'name'          => 'Clubes de consumo',
			'singular_name' => 'Clubes de consumo',
			'add_new'       => 'Nuevo Club',
			'add_new_item'  => 'Nuevo Club',
			'edit_item'     => 'Editar Club',
			'new_item'      => 'Nuevo Club',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Club',
			'search_items'  => 'Buscar Club',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Clubes de consumo'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'clubes-de-consumo' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
                        'capability_type'    => array('club-de-consumo','club-de-consumos'),
                        'map_meta_cap'       => true,
		);
		register_post_type( 'clubes-de-consumo', $args );

	});



/**	
 * SUBMENU EN INGREDIENTES
 */
add_action('admin_menu', 'register_submenu_page_ingredients');

function register_submenu_page_ingredients() {
	add_submenu_page( 'edit.php?post_type=ingredientes', 'Ingredientes de temporada', 'Ingredientes de temporada', 'manage_options', 'ingredientes-de-temporada', 'ingresients_submenu_page_callback' );
}

function ingresients_submenu_page_callback() {
	if (isset($_POST['action']) AND $_POST['action'] == 'ingredientes-temporada') saveSeasonalIngredients($_POST);

	$html = '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		$html .= '<h2>Ingredientes de temporada</h2>';
	$html .= '</div><br>';

	$html .= '<div class="container-ingredients">';
		$html .= '<form action="" method="POST">';

			$ingredientes = new WP_Query( ['post_type' => 'ingredientes', 'posts_per_page' => -1] );
				
			if ( ! empty($ingredientes->posts) ) :
				$activitisShip = orderIndexObject(getIngredientsShip(0));
				
			 	foreach ($ingredientes->posts as $ingrediente):
			 		$checked = isset( $activitisShip[$ingrediente->ID] ) ? 'checked' : '';
			 		$html .= '<div class="container-ingredient">';
			 			$html .= '<input type="checkbox" name="ingredientesTemporada[]" id="ingredientesTemporada[]" value="'.$ingrediente->ID.'" '.$checked.' /> '.$ingrediente->post_name.' <br><br>';
					$html .= '</div>';
			 	endforeach;
			endif;

			$html .= '<input type="hidden" value="ingredientes-temporada" name="action" >';
			$html .= '<input type="submit" value="Guardar" class="button-primary button-large button-clear" >';
		$html .= '</form>';
	$html .= '</div>';

	echo $html;
}


/**	
 * ACTUALIZA LOS INGREDIENTES DE TEMPORADA
 * @param  [array] $data [description]
 * @return [type]       [description]
 */
function saveSeasonalIngredients($data){
	$ingredientes = isset($data['ingredientesTemporada']) ? $data['ingredientesTemporada'] : array();

	if (!empty($ingredientes)):
		destroyShipIngredients(0);
		foreach ($ingredientes as $ingrediente):
			storeShipIngredients(0, $ingrediente);
		endforeach;
	endif;
}