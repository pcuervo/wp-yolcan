<?php if (isset($_POST['action']) AND $_POST['action'] == 'set-agenda-visita') setAgendaVisita($_POST);
if (isset($_POST['action']) AND $_POST['action'] == 'set-contacto') setContacto($_POST);


global $result;

// DEFINIR LOS PATHS A LOS DIRECTORIOS DE JAVASCRIPT Y CSS ///////////////////////////



	define( 'JSPATH', get_template_directory_uri() . '/js/' );

	define( 'CSSPATH', get_template_directory_uri() . '/css/' );

	define( 'THEMEPATH', get_template_directory_uri() . '/' );
	
	define( 'SITEURL', site_url('/') );



// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////



	add_action( 'wp_enqueue_scripts', function(){
		// styles
		wp_enqueue_style( 'styles', get_stylesheet_uri() );
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

		// scripts
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'api-google', 'http://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bootstrap', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'chart', JSPATH.'Chart.js', array('jquery'), '1.0', false );
		wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );
		

		// localize scripts
		wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );
		wp_localize_script( 'functions', 'is_home', (string)is_home() );
		wp_localize_script( 'functions', 'is_conocenos', (string)is_page('conocenos') );
		wp_localize_script( 'functions', 'is_recetas', (string)is_post_type_archive('recetas') );
		wp_localize_script( 'functions', 'is_single_recetas', (string)is_singular('recetas') );

		if ( is_home() ) {
			$cc = get_page_by_path('clubes-de-consumo');
			$clubes = get_post_meta($cc->ID, 'direcciones-clubes', true);
			$direc_club = unserialize( $clubes );
			wp_localize_script( 'functions', 'clubes', $direc_club );

		}

	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'api-google', 'http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU', array('jquery'), '1.0', true );
		wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );

		wp_enqueue_script( 'google-function', JSPATH.'google-autocomplete.js', array('api-google'), '1.0', true );
		

		// localize scripts
		wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );



		// styles
		wp_enqueue_style( 'admin-css', CSSPATH.'admin.css' );

	});



// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////



	add_filter( 'show_admin_bar', function($content){
		return ( current_user_can('administrator') ) ? $content : false;
	});



// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////



	add_filter( 'admin_footer_text', function() {
		echo 'Creado por <a href="http://pcuervo.com">Pequeño cuervo</a>. ';
		echo 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});



// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////



	if ( function_exists('add_theme_support') ){
		add_theme_support('post-thumbnails');
	}

	if ( function_exists('add_image_size') ){
		
		add_image_size( 'img_blog', 305, 182, true );
		
		// cambiar el tamaño del thumbnail
		
		update_option( 'medium_size_h', 400 );
		update_option( 'medium_size_w', 400 );
		update_option( 'medium_crop', true );

		update_option( 'large_size_h', 450 );
		update_option( 'large_size_w', 800 );
		update_option( 'large_crop', true );
		
	}



// POST TYPES, METABOXES, TAXONOMIES AND CUSTOM PAGES ////////////////////////////////


	
	require_once('inc/post-types.php');

	require_once('inc/metaboxes.php');

	require_once('inc/taxonomies.php');

	require_once('inc/pages.php');

	require_once('inc/queries.php');

	require_once('inc/functions-newsletter.php');

	
	
// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		if ( $query->is_main_query() and ! is_admin() ) {

			if ( is_post_type_archive('faq') ) {
				$query->set( 'posts_per_page', -1 );
			}

		}
		return $query;

	});



// THE EXECRPT FORMAT AND LENGTH /////////////////////////////////////////////////////



	/*add_filter('excerpt_length', function($length){
		return 20;
	});*/


	/*add_filter('excerpt_more', function(){
		return ' &raquo;';
	});*/



// REMOVE ACCENTS AND THE LETTER Ñ FROM FILE NAMES ///////////////////////////////////



	add_filter( 'sanitize_file_name', function ($filename) {
		$filename = str_replace('ñ', 'n', $filename);
		return remove_accents($filename);
	});



// HELPER METHODS AND FUNCTIONS //////////////////////////////////////////////////////



	/**
	 * Print the <title> tag based on what is being viewed.
	 * @return string
	 */
	function print_title(){
		global $page, $paged;

		wp_title( '|', true, 'right' );
		bloginfo( 'name' );

		// Add a page number if necessary
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( __( 'Página %s' ), max( $paged, $page ) );
		}
	}



	/**
	 * Imprime una lista separada por commas de todos los terms asociados al post id especificado
	 * los terms pertenecen a la taxonomia especificada. Default: Category
	 *
	 * @param  int     $post_id
	 * @param  string  $taxonomy
	 * @return string
	 */
	function print_the_terms($post_id, $taxonomy = 'category'){
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms and ! is_wp_error($terms) ){
			$names = wp_list_pluck($terms ,'name');
			echo implode(', ', $names);
		}
	}



	/**
	 * Regresa la url del attachment especificado
	 * @param  int     $post_id
	 * @param  string  $size
	 * @return string  url de la imagen
	 */
	function attachment_image_url($post_id, $size){
		$image_id   = get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, $size, true);
		return isset($image_data[0]) ? $image_data[0] : '';
	}



	/*
	 * Echoes active if the page showing is associated with the parameter
	 * @param  string $compare, Array $compare
	 * @param  Bool $echo use FALSE to use with php, default is TRUE to echo value
	 * @return string
	 */
	function nav_is($compare = array(), $echo = TRUE){

		$query = get_queried_object();
		$inner_array = array();
		if(gettype($compare) == 'string'){
			
			$inner_array[] = $compare;
		}else{
			$inner_array = $compare;
		}

		foreach ($inner_array as $value) {
			if( isset($query->slug) AND preg_match("/$value/i", $query->slug)
				OR isset($query->name) AND preg_match("/$value/i", $query->name)
				OR isset($query->rewrite) AND preg_match("/$value/i", $query->rewrite['slug'])
				OR isset($query->post_name) AND preg_match("/$value/i", $query->post_name)
				OR isset($query->post_title) AND preg_match("/$value/i", remove_accents(str_replace(' ', '-', $query->post_title) ) ) )
			{
				if($echo){
					echo 'active';
				}else{
					return 'active';
				}
				return FALSE;
			}

		}
		return FALSE;
	}

// PAGINACION ///////////////////////////////////////////////////////////////////////////////

	/**
	 * CHECA SI EXISTE UNA PAGINA ANTERIOR
	 */
	function has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}


	/**
	 * CHECA SI EXISTE UNA PAGINA SIGUIENTE
	 */
	function has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
	}

	/**
	 * EDITA EL FORMATO DE LA FECHA
	 */
	function getDateTransform($post_date){
		$dia = substr($post_date, 8, 2);
		$mes = substr($post_date, 5, 2);
		$ano = substr($post_date, 0, 4);

		$meses = array('01' => 'Enero', '02' => 'febrero', '03' => 'Marzo', '04' => 'abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

		return $meses[$mes].' '.$dia.', '.$ano;
	}

	/**	
	 * AGENDA VISITA
	 */
	function setAgendaVisita($data){
		global $result;
		global $wpdb;

		$wpdb->insert(
			$wpdb->prefix.'sitas_agendadas',
			array(
				'nombre'   => $data['nombre_visita'],
				'correo'   => $data['email_visita'],
				'telefono' => $data['telefono_visita'],
				'numero_personas'  => $data['n_personas_visita'],
				'fecha' => $data['fecha_visita']
			),
			array(
				'%s',
				'%s',
				'%s',
				'%d',
				'%s'	
			)
		);

		$result['success'] = 'Se envío el mensaje con exito';

		return true;
	}

	/**
	 * NUEVO CONTACTO
	 * @param [type] $data [description]
	 */
	function setContacto($data){
		global $result;

		$content = '<p><strong>Teléfono: </strong>'.$data['correo_contacto'].'<p>';
		$content .= '<p><strong>Correo: </strong>'.$data['telefono_contacto'].'<p>';
		$content .= '<p><strong>Mensaje: </strong>'.$data['mensaje_contacto'].'<p>';
	
		$contact_new = array(
		  'post_title'    => $data['nombre_contacto'],
		  'post_content'  => $content,
		  'post_status'   => 'publish',
		  'post_type'     => 'contactos',
		  'post_author'   => 1,
		);

		wp_insert_post( $contact_new );

		$result['success'] = 'Se envío el mensaje con exito';

		return true;
	}

// WOOCOMMERCE /////////////////////////////////////////////////////

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}