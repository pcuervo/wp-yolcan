<?php
// TAXONOMIES ////////////////////////////////////////////////////////////////////////


	add_action( 'init', 'custom_taxonomies_callback', 0 );
	function custom_taxonomies_callback(){

		// AUTORES
		if( ! taxonomy_exists('unidades')){

			$labels = array(
				'name'              => 'Unidades',
				'singular_name'     => 'Unidad',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todos',
				'edit_item'         => 'Editar Unidad',
				'update_item'       => 'Actualizar Unidad',
				'add_new_item'      => 'Nuevo Unidad',
				'new_item_name'     => 'Nombre Nuevo Unidad',
				'menu_name'         => 'Unidades'
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'unidades' ),
			);

			register_taxonomy( 'unidades', 'ingredientes', $args );
		}

		if( ! taxonomy_exists('tipo-de-ingrediente')){

			$labels = array(
				'name'              => 'Tipo de ingrediente',
				'singular_name'     => 'Tipo de ingrediente',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todos',
				'edit_item'         => 'Editar Tipo de ingrediente',
				'update_item'       => 'Actualizar Tipo de ingrediente',
				'add_new_item'      => 'Nuevo Tipo de ingrediente',
				'new_item_name'     => 'Nombre Nuevo Tipo de ingrediente',
				'menu_name'         => 'Tipo de ingrediente'
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'tipo-de-ingrediente' ),
			);

			register_taxonomy( 'tipo-de-ingrediente', 'ingredientes', $args );
		}

		// UNIDADES
		$terms = termsUnidades();
		foreach ($terms as $slug => $term) {
			if ( ! term_exists( $slug, 'unidades' ) ){
				wp_insert_term( $term, 'unidades', array('slug' => $slug) );
			}
		}
		
	}

	function wpse_insert_term()
	{
		// CATEGORY PRODUCT
		$termsProd = termsProduct();
		foreach ($termsProd as $slug => $term) {
		
			if ( ! term_exists( $slug, 'product_cat' ) ){
				
				wp_insert_term( $term, 'product_cat', array('slug' => $slug) );
			}
		}
	   
	}
	add_action('init', 'wpse_insert_term');

	/**
	 * TERMS OF TAXONOMY UNIDADES
	 * @return [array] [terms names]
	 */
	function termsUnidades(){
		return array(
				'g' => 'g',
				'kg' => 'Kg',
				'lt' => 'Lt',
				'pz' => 'Pza'
			);
	}

	function termsProduct(){
		return array(
			'canastas' => 'Canastas',
			'puntos' => 'Puntos'
		);	
	}
