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
	wp_enqueue_script( 'api-google', 'http://maps.googleapis.com/maps/api/js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'bootstrap', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'chart', JSPATH.'Chart.js', array('jquery'), '1.0', false );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );


	// localize scripts
	wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );
	wp_localize_script( 'functions', 'is_home', (string)is_home() );
	wp_localize_script( 'functions', 'is_conocenos', (string)is_page('conocenos') );
	wp_localize_script( 'functions', 'is_nuestros_productos', (string)is_page('nuestros-productos') );
	wp_localize_script( 'functions', 'is_recetas', (string)is_post_type_archive('recetas') );
	wp_localize_script( 'functions', 'is_single_recetas', (string)is_singular('recetas') );

	if ( is_home() ) {
		$direc_club = getLocationClubs();
		wp_localize_script( 'functions', 'clubes', $direc_club );

	}

});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



add_action( 'admin_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script( 'api-google', 'https://maps.google.com/maps/api/js?libraries=places&language=es-ES', array('jquery'), '1.0', true );
	wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'google-function', JSPATH.'google-autocomplete.js', array('api-google'), '1.0', true );


	// localize scripts
	wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );



	// styles
	wp_enqueue_style( 'admin-css', CSSPATH.'admin.css' );
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

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

require_once('inc/usuarios.php');



// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



add_action( 'pre_get_posts', function($query){

	if ( $query->is_main_query() and ! is_admin() ) {

		if ( is_post_type_archive('faq') ) {
			$query->set( 'posts_per_page', -1 );
		}

		if ( is_post_type_archive('recetas') ) {
			$query->set( 'posts_per_page', 10 );
		}

	}
	return $query;

});





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
 * REGRESA LAS LOCALIZACIONES DE LOS CLUBS DE CONSUMO PARA MOSTRAR EN EL MAPA -- HOME
 * @return [array] [localización cada club]
 */
function getLocationClubs(){
	$clubes_consumo = new WP_Query(array(
			'post_type'      => 'clubes-de-consumo',
			'posts_per_page' => -1,
		));
	$new_arr = array();
	if ( $clubes_consumo->have_posts() ) :

		$count = 1;
		while ( $clubes_consumo->have_posts() ) : $clubes_consumo->the_post();

			$latitud_club = get_post_meta(get_the_ID(), 'latitud-club', true);
			$longitud_club = get_post_meta(get_the_ID(), 'longitud-club', true);

			if ($latitud_club != '' AND $longitud_club != '') {
				$new_arr[$count]['latitud'] = $latitud_club;
				$new_arr[$count]['longitud'] = $longitud_club;
				$new_arr[$count]['nombre'] = get_the_title();
			}

			$count++;
		endwhile;
	endif;
	wp_reset_postdata();

	return $new_arr;
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


/**
 * PAGINACION
 */

function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}

/**
 * OPCIONES PARA LA PAGINACION
 * @return [type] [description]
 */
function optionsPagination(){
	$pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('Página %CURRENT_PAGE% de %TOTAL_PAGES%:');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('Primera');
    $pagenavi_options['last_text'] = ('Última');
    $pagenavi_options['next_text'] = 'Siguiente';
    $pagenavi_options['prev_text'] = 'Anterior';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 3; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;

    return $pagenavi_options;
}


/**
 * PAGINACION ARCHIVES (NOTA: partir en mas funciones - alex)
 * @return [string]         [html con la paginacion]
 */
function pagenavi($paged = '', $num_pages = '', $siteUrl = '', $especial = false, $simbol_url = '?', $variable_page = 'paged') {

    global $wpdb, $wp_query;

    $before = '';
    $after = '';

    $pagenavi_options = optionsPagination();

    if (!is_single()) {

        $paged = $paged == '' ? intval(get_query_var($variable_page)) : $paged;
        $max_page = $num_pages == '' ? $wp_query->max_num_pages : $num_pages;

        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;

        if($start_page <= 0) {
            $start_page = 1;
        }

        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }

        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);

        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {

            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";

            if(!empty($pages_text)) {
                echo '<ul class="[ pagination ][ no-margin ]">';
            }

            echo '<li class="pag-anterior">';
            	if ($especial == true) {
            		$pa = $paged - 1;
            		echo $paged > 1 ? '<a href="'.$siteUrl.$simbol_url.$variable_page.'='.$pa.'"><img class="[ svg icon--iconed--small icon--stoke icon--thickness-3 ][ color-dark ]" src="'.THEMEPATH.'icons/arrow-left-12.svg"></a>' : '';
            	}else{
            		previous_posts_link($pagenavi_options['prev_text']);
            	}

            echo '</li>';

            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);

                $url = $especial == true ? $siteUrl.$simbol_url.$variable_page.'=1' : esc_url(get_pagenum_link());
                echo '<li><a href="'.$url.'" class="first" title="'.$first_page_text.'">1</a></li>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
                }
            }

            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }

            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<li class="num-pag-current active"><span class="current">'.$current_page_text.'</span></li>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    $url = $especial == true ? $siteUrl.$simbol_url.$variable_page.'='.$i : esc_url(get_pagenum_link($i));
                    echo '<li class="num-pag"><a href="'.$url.'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }

            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
               	$url = $especial == true ? $siteUrl.$simbol_url.$variable_page.'='.$max_page : esc_url(get_pagenum_link($max_page));
                echo '<li><a href="'.$url.'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
            }
            echo '<li class="pag-siguiente">';
            	if ($especial == true) {
            		$pa = $paged + 1;
            		echo $paged < $num_pages ? '<a href="'.$siteUrl.$simbol_url.$variable_page.'='.$pa.'"><img class="[ svg icon--iconed--small icon--stoke icon--thickness-3 ][ color-dark ]" src="'.THEMEPATH.'icons/arrow-right-12.svg"></a>' : '';
            	}else{
            		next_posts_link($pagenavi_options['next_text'], $max_page);
            	}
            echo '</li>';

            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page edsf	" title="'.$page_text.'">'.$page_text.'</a></li>';
                }
            }
            echo '</ul></div>'.$after."\n";
        }
    }
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

add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
	wc_clear_notices();
    return WC()->cart->get_checkout_url();
}

/*
 * Quitar a los datos de Facturación innecesarios
 * con la excepción del nombre, apellido y correo.
 */
add_filter( 'woocommerce_checkout_fields', 'remove_unnecessary_fields', 10 );
function remove_unnecessary_fields( $fields ){
	foreach ( $fields['billing'] as $key => $field ) {
		if( 'billing_first_name' === $key || 'billing_last_name' === $key || 'billing_email' == $key ) {
			$fields['billing'][$key]['required'] = true;
			continue;
		}
		$fields['billing'][$key]['required'] = false;
		array_push( $fields['billing'][$key]['class'], '[ hidden ]');
	}

	return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'add_billing_consumer_club_field', 20 );
function add_billing_consumer_club_field( $fields ){
	$fields['billing']['billing_consumer_club'] = array(
		'type'			=> 'select',
        'label'     	=> 'Clubes de consumo',
	    'required'  	=> true,
	    'class'			=> array( 'form-row-wide' ),
	    'options'		=> array(
		    				'1' => 'Club 1',
		    				'2' => 'Club 2',
		    			)
     );

     return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'order_fields', 30 );
function order_fields($fields) {
    $order = array(
        "billing_first_name",
        "billing_last_name",
        "billing_email",
        "billing_consumer_club"
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }
    $fields["billing"] = $ordered_fields;
    return $fields;
}

add_filter( 'woocommerce_form_field_args', 'style_fields', 5 );
function style_fields( $args ){
	// echo '<pre>';
	// var_dump( $args );
	// echo '</pre>';
	return $args;
}


add_filter('woocommerce_add_to_cart_redirect', 'themeprefix_add_to_cart_redirect');
function themeprefix_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = $woocommerce->cart->get_checkout_url();
 return $checkout_url;
}