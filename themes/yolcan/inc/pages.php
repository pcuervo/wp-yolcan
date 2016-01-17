<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){


		// PRODUCTOS
		if( ! get_page_by_path('nuestros-productos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Nuestros productos',
				'post_name'   => 'nuestros-productos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Conócenos
		if( ! get_page_by_path('conocenos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Conócenos',
				'post_name'   => 'conocenos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}


	});
