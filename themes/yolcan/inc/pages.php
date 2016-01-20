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

		// Conócenos
		if( ! get_page_by_path('blog') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Blog',
				'post_name'   => 'blog',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Visitanos
		if( ! get_page_by_path('visitanos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Visitanos',
				'post_name'   => 'visitanos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('xochimilco') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Xochimilco',
				'post_name'   => 'xochimilco',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}


	});
