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

		// Blog
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

		// Xochimilco
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

		if( ! get_page_by_path('contactanos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Contáctanos',
				'post_name'   => 'contactanos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('mi-carrito') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Mi Carrito',
				'post_name'   => 'mi-carrito',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('mi-cuenta') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Mi Cuenta',
				'post_name'   => 'mi-cuenta',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('checkout') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Checkout',
				'post_name'   => 'checkout',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('informacion-clubes-de-consumo') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Información Clubes de consumo',
				'post_name'   => 'informacion-clubes-de-consumo',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		if( ! get_page_by_path('finalizar-comprar') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Finalizar Comprar',
				'post_name'   => 'finalizar-comprar',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		//Video home
		if( ! get_page_by_path('video-home') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Video Home',
				'post_name'   => 'video-home',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// CTA Canastas
		if( ! get_page_by_path('cta-canastas') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'CTA Canastas',
				'post_name'   => 'cta-canastas',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// CTA Visítanos
		if( ! get_page_by_path('cta-visitanos') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'CTA Visítanos',
				'post_name'   => 'cta-visitanos',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

	});
