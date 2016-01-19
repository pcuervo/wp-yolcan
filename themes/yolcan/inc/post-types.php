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
			'supports'           => array( 'title', 'editor', 'thumbnail' )
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
			'supports'           => array( 'title', 'editor', 'thumbnail' )
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
			'supports'           => array( 'title', 'editor' )
		);
		register_post_type( 'faq', $args );

	});