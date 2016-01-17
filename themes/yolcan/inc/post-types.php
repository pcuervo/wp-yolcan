<?php


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

	});