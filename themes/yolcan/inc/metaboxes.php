<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////

// PRUEBA DE PLUGIN



add_action('add_meta_boxes', function(){
	global $post;

	add_meta_box( 'meta-box-extras_receta', 'Extras Receta', 'show_metabox_extras_receta', 'recetas');
	add_meta_box( 'meta-box-ingredientes_receta', 'Ingredientes', 'show_metabox_ingredientes_receta', 'recetas', 'side', 'high');
	add_meta_box( 'meta-box-informacion_ingrediente', 'Info. Adicional', 'show_metabox_informacion_ingrediente', 'ingredientes', 'side', 'high');
    // add_meta_box( 'meta-box-cantidad_ingrediente', 'Peso', 'show_metabox_cantidad_ingrediente', 'ingredientes', 'side', 'high');
    add_meta_box( 'meta-box-precio_ingrediente', 'Precio', 'show_metabox_precio_ingrediente', 'ingredientes', 'side', 'high');
	add_meta_box( 'meta-box-info_extra', 'Información extra', 'show_metabox_info_extra', 'clubes-de-consumo');

	if ($post->post_name == 'visitanos'){
		add_meta_box( 'meta-box-datos_visita', 'Datos visitas', 'show_metabox_datos_visita', 'page', 'side', 'high');
	}

	if ($post->post_name == 'contactanos'){
		add_meta_box( 'meta-box-ubicacion', 'Ubicación', 'show_metabox_ubicacion', 'page', 'side', 'high');
		add_meta_box( 'meta-box-info', 'Información extra', 'show_metabox_info', 'page', 'side', 'high');
	}

});



// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////



function show_metabox_extras_receta($post){
	$tiempo_preparacion = get_post_meta($post->ID, 'tiempo_preparacion', true);
	$numero_personas = get_post_meta($post->ID, 'numero_personas', true);
	$nivel_de_preparacion = get_post_meta($post->ID, 'nivel_de_preparacion', true);
	$pasos_preparacion = get_post_meta($post->ID, 'pasos_preparacion', true);

	$settings = array('editor_height' => '200',  'media_buttons' => false );

	wp_nonce_field(__FILE__, '_extras_receta_nonce');

	echo "<label for='tiempo_preparacion' class='label-paquetes'>Tiempo de preparación: </label>";
	echo "<input type='text' class='widefat' id='tiempo_preparacion' name='tiempo_preparacion' value='$tiempo_preparacion'/>";

	echo "<br><br><label for='numero_personas' class='label-paquetes'>Número de personas: </label>";
	echo "<input type='text' class='widefat' id='numero_personas' name='numero_personas' value='$numero_personas'/>";

	echo "<br><br><label for='nivel_de_preparacion' class='label-paquetes'>Nivel de preparación: </label>";
	echo "<input type='text' class='widefat' id='nivel_de_preparacion' name='nivel_de_preparacion' value='$nivel_de_preparacion'/>";

	echo "<br><br><label for='pasos_preparacion' class='label-paquetes'>Pasos para preparar: </label>";
	wp_editor( $pasos_preparacion, 'pasos_preparacion', $settings );
}


function show_metabox_ingredientes_receta($post){
	wp_nonce_field(__FILE__, 'ingredientes_nonce');

	$ingredientes = new WP_Query( ['post_type' => 'ingredientes', 'posts_per_page' => -1] );

	if ( ! empty($ingredientes->posts) ) :
		$activitisShip = orderIndexObject(getIngredientsShip($post->ID));
	 	foreach ($ingredientes->posts as $ingrediente):
	 		$checked = isset( $activitisShip[$ingrediente->ID] ) ? 'checked' : '';?>

	 		<input type="checkbox" name="ingredientes[]" id="ingredientes[]" value="<?php echo $ingrediente->ID ?>" <?php echo $checked; ?> /> <?php echo $ingrediente->post_title; ?><br><br>

	 	<?php endforeach;
	endif;
}

/**
 * CAMBIAR INDEX DEL OBJETO POR EL ID DEL INGREDIENTE
 * @param  [type] $activities [description]
 * @return [type]             [description]
 */
function orderIndexObject($ingredients){
	$array = array();
	if(! empty($ingredients)):
		foreach ($ingredients as $key => $ingredient) :
			$array[$ingredient->ingrediente_id] = $ingredient;
		endforeach;
	endif;

	return $array;
}

/**
 * METABOX VISITANOS
 */
function show_metabox_datos_visita($post){
	$costo_visita = get_post_meta($post->ID, 'costo_visita', true);
	$capacidad_visita = get_post_meta($post->ID, 'capacidad_visita', true);
	$persona_extra_visita = get_post_meta($post->ID, 'persona_extra_visita', true);
	$persona_extra_visita_2 = get_post_meta($post->ID, 'persona_extra_visita_2', true);


	wp_nonce_field(__FILE__, '_datos_visitas_nonce');

	echo "<label for='costo_visita' class='label-paquetes'>Costo: </label>";
	echo "<input type='text' class='widefat' id='costo_visita' name='costo_visita' value='$costo_visita'/>";

	echo "<br><br><label for='capacidad_visita' class='label-paquetes'>Capacidad: </label>";
	echo "<input type='text' class='widefat' id='capacidad_visita' name='capacidad_visita' value='$capacidad_visita'/>";

	echo "<br><br><label for='persona_extra_visita' class='label-paquetes'>Personas extra 1: </label>";
	echo "<input type='text' class='widefat' id='persona_extra_visita' name='persona_extra_visita' value='$persona_extra_visita'/>";

	echo "<br><br><label for='persona_extra_visita_2' class='label-paquetes'>Personas extra 2: </label>";
	echo "<input type='text' class='widefat' id='persona_extra_visita_2' name='persona_extra_visita_2' value='$persona_extra_visita_2'/>";

}


function show_metabox_ubicacion($post){
	$latitud_contacto = get_post_meta($post->ID, 'latitud_contacto', true);
	$longitud_contacto = get_post_meta($post->ID, 'longitud_contacto', true);

	wp_nonce_field(__FILE__, '_latlong_nonce');

	echo "<label for='addresscontacto' class='label-paquetes'>Ingresa la dirección: </label>";
	echo "<input type='text' class='widefat' id='addresscontacto' name='addresscontacto' value=''/>";

	echo "<br><br><label for='latitud_contacto' class='label-paquetes'>Latitud: </label>";
	echo "<input type='text' class='widefat' id='latitud_contacto' name='latitud_contacto' value='$latitud_contacto'/>";

	echo "<label for='longitud_contacto' class='label-paquetes'>Longitud: </label>";
	echo "<input type='text' class='widefat' id='longitud_contacto' name='longitud_contacto' value='$longitud_contacto'/>";

	echo '<br><br><div class="iframe-cont">';

		if ($latitud_contacto != '') {
			echo '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitud_contacto.','.$longitud_contacto.'&hl=es;z=14&amp;output=embed"></iframe>';
		}

	echo '</div>';
}

function show_metabox_info($post){
	$telefono_c = get_post_meta($post->ID, 'telefono_c', true);
	$whatsapp_c = get_post_meta($post->ID, 'whatsapp_c', true);

	wp_nonce_field(__FILE__, '_info_cont_nonce');

	echo "<label for='telefono_c' class='label-paquetes'>Telefóno: </label>";
	echo "<input type='text' class='widefat' id='telefono_c' name='telefono_c' value='$telefono_c'/>";

	echo "<br><br><label for='whatsapp_c' class='label-paquetes'>Whatsapp: </label>";
	echo "<input type='text' class='widefat' id='whatsapp_c' name='whatsapp_c' value='$whatsapp_c'/>";
}


function show_metabox_info_extra($post){
	wp_nonce_field(__FILE__, '_info_extra_nonce');

	$club = get_post_meta($post->ID, 'ubicacion-club', true);
	$latitud_club = get_post_meta($post->ID, 'latitud-club', true);
	$longitud_club = get_post_meta($post->ID, 'longitud-club', true);

	$nombre_encargado_club = get_post_meta($post->ID, 'nombre-encargado-club', true);
	$telefono_encargado_club = get_post_meta($post->ID, 'telefono-encargado-club', true);
	$dias_de_recoleccion = get_post_meta($post->ID, 'dias-de-recoleccion', true);
	$dias_de_recoleccion_a = get_post_meta($post->ID, 'dias-de-recoleccion-a', true);

	$horarios_de_recoleccion = get_post_meta($post->ID, 'horarios-de-recoleccion', true);
	$capacidad_del_club = get_post_meta($post->ID, 'capacidad-del-club', true);
	$puede_dejar_efectivo = get_post_meta( $post->ID, 'puede-dejar-efectivo', true );

	echo "<label for='ubicacion_club' class='label-paquetes'>Ingresa la dirección: </label><br><br>";
	echo "<input type='text' class='widefat' id='ubicacion_club' name='ubicacion_club' value='$club'/>";
	echo "<input type='hidden' class='widefat' id='latitud_club' name='latitud_club' value='$latitud_club'/>";
	echo "<input type='hidden' class='widefat' id='longitud_club' name='longitud_club' value='$longitud_club'/>";

	echo '<br><br><div class="iframe-cont">';
		if ($latitud_club != '') {
			echo '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitud_club.','.$longitud_club.'&hl=es;z=14&amp;output=embed"></iframe>';
		}
	echo '</div><br>';

	echo "<label for='nombre_encargado_club' class='label-paquetes'>Nombre del encargado del club: </label>";
	echo "<input type='text' class='widefat' id='nombre_encargado_club' name='nombre_encargado_club' value='$nombre_encargado_club'/><br><br>";

	echo "<label for='telefono_encargado_club' class='label-paquetes'>Teléfono del encargado del club: </label>";
	echo "<input type='text' class='widefat' id='telefono_encargado_club' name='telefono_encargado_club' value='$telefono_encargado_club'/><br><br>";

	echo "<label for='dias_de_recoleccion' class='label-paquetes'>Días de recolección: </label><br>";
	echo "de: <input type='text' class='date-picker' id='dias_de_recoleccion' name='dias_de_recoleccion' value='$dias_de_recoleccion'/>";
	echo " a: <input type='text' class='date-picker' id='dias_de_recoleccion_a' name='dias_de_recoleccion_a' value='$dias_de_recoleccion_a'/><br><br>";

	echo "<label for='horarios_de_recoleccion' class='label-paquetes'>Horarios de recolección: </label>";
	echo "<input type='text' class='widefat' id='horarios_de_recoleccion' name='horarios_de_recoleccion' value='$horarios_de_recoleccion'/><br><br>";

	echo "<label for='capacidad_del_club' class='label-paquetes'>Capacidad del club de consumo: </label>";
	echo "<input type='text' class='widefat' id='capacidad_del_club' name='capacidad_del_club' value='$capacidad_del_club'/><br><br>";

	$checked_1 = $puede_dejar_efectivo == 'si' ? 'checked' : '';
	$checked_2 = $puede_dejar_efectivo == 'no' ? 'checked' : '';
	$default = ($checked_1 == '' AND $checked_2 == '') ? 'checked' : '';

	echo "<label for='puede_dejar_efectivo' class='label-paquetes'>¿Se puede dejar efectivo? </label><br><br> ";
	echo '<input type="radio" name="puede_dejar_efectivo" value="si" '.$checked_1.' '.$default.'> Si<br>';
		echo '<input type="radio" name="puede_dejar_efectivo" value="no" '.$checked_2.' > No<br>';

}

function show_metabox_informacion_ingrediente($post){
	wp_nonce_field(__FILE__, '_info_ingrediente_nonce');

	$adicional_canasta = get_post_meta($post->ID, 'adicional_canasta', true);
	$valor_en_puntos = get_post_meta($post->ID, 'valor_en_puntos', true);

	// $checked = $adicional_canasta == 'si' ? 'checked' : '';
	// echo '<input type="radio" name="adicional_canasta" value="si" '.$checked.'> Adicional en canasta<br><br>';

	echo "<label for='valor_en_puntos' class='label-paquetes'>Valor en puntos: </label>";
	echo "<input type='text' class='widefat' id='valor_en_puntos' name='valor_en_puntos' value='$valor_en_puntos'/><br><br>";
}

function show_metabox_cantidad_ingrediente($post){
	wp_nonce_field(__FILE__, '_cantidad_ingrediente_nonce');

	$cantidad_en_peso = get_post_meta($post->ID, 'cantidad_en_peso', true);
    $tipo_en_peso = get_post_meta($post->ID, 'tipo_en_peso', true);

	echo "<label for='cantidad_en_peso' class='label-paquetes'>Cantidad en peso: </label>";
	echo "<input type='text' class='widefat' id='cantidad_en_peso' name='cantidad_en_peso' value='$cantidad_en_peso'/><br><br>";
    echo "<label for='tipo_en_peso' class='label-paquetes'>Tipo: </label>";
	echo "<select name='tipo_en_peso'><option value='$tipo_en_peso'>$tipo_en_peso</option><option value='Gramos'>Gramos</option><option value='Kilogramos'>Kilogramos</option><option value='Unidad'>Unidad</option><option value='Docena'>Docena</option><option value='Manojo'>Manojo</option></select><br><br>";
}

function show_metabox_precio_ingrediente($post){
	wp_nonce_field(__FILE__, '_precio_ingrediente_nonce');

	$precio_ingrediente = get_post_meta($post->ID, 'precio_ingrediente', true);

	echo "<input type='text' class='widefat' id='precio_ingrediente' name='precio_ingrediente' value='$precio_ingrediente'/><br><br>";
}



// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////


add_action('save_post', function($post_id){

	if (isset($_POST['post_type']) AND $_POST['post_type'] == 'recetas') destroyShipIngredients($post_id);

	if ( ! current_user_can('edit_page', $post_id))
		return $post_id;


	if ( defined('DOING_AUTOSAVE') and DOING_AUTOSAVE )
		return $post_id;


	if ( wp_is_post_revision($post_id) OR wp_is_post_autosave($post_id) )
		return $post_id;


	if ( isset($_POST['tiempo_preparacion']) and check_admin_referer(__FILE__, '_extras_receta_nonce') ){
		update_post_meta($post_id, 'tiempo_preparacion', $_POST['tiempo_preparacion']);
		update_post_meta($post_id, 'numero_personas', $_POST['numero_personas']);
		update_post_meta($post_id, 'nivel_de_preparacion', $_POST['nivel_de_preparacion']);
		update_post_meta($post_id, 'pasos_preparacion', $_POST['pasos_preparacion']);

	}

	if ( isset($_POST['ingredientes']) and check_admin_referer(__FILE__, 'ingredientes_nonce') ){

		if ( ! empty($_POST['ingredientes']) ){
			foreach ($_POST['ingredientes'] as $ingredientes):
				storeShipIngredients($post_id, $ingredientes);
			endforeach;
		}
	}

	if ( isset($_POST['costo_visita']) and check_admin_referer(__FILE__, '_datos_visitas_nonce') ){
		update_post_meta($post_id, 'costo_visita', $_POST['costo_visita']);
		update_post_meta($post_id, 'capacidad_visita', $_POST['capacidad_visita']);
		update_post_meta($post_id, 'persona_extra_visita', $_POST['persona_extra_visita']);
		update_post_meta($post_id, 'persona_extra_visita_2', $_POST['persona_extra_visita_2']);
	}

	if ( isset($_POST['latitud_contacto']) and check_admin_referer(__FILE__, '_latlong_nonce') ){
		update_post_meta($post_id, 'latitud_contacto', $_POST['latitud_contacto']);
		update_post_meta($post_id, 'longitud_contacto', $_POST['longitud_contacto']);
	}


	if ( isset($_POST['telefono_c']) and check_admin_referer(__FILE__, '_info_cont_nonce') ){
		update_post_meta($post_id, 'telefono_c', $_POST['telefono_c']);
		update_post_meta($post_id, 'whatsapp_c', $_POST['whatsapp_c']);
	}

	if ( isset($_POST['ubicacion_club']) and check_admin_referer(__FILE__, '_info_extra_nonce') ){
		update_post_meta($post_id, 'ubicacion-club', $_POST['ubicacion_club']);
		update_post_meta($post_id, 'latitud-club', $_POST['latitud_club']);
		update_post_meta($post_id, 'longitud-club', $_POST['longitud_club']);
		update_post_meta($post_id, 'nombre-encargado-club', $_POST['nombre_encargado_club']);
		update_post_meta($post_id, 'telefono-encargado-club', $_POST['telefono_encargado_club']);
		update_post_meta($post_id, 'dias-de-recoleccion', $_POST['dias_de_recoleccion']);
		update_post_meta($post_id, 'horarios-de-recoleccion', $_POST['horarios_de_recoleccion']);
		update_post_meta($post_id, 'capacidad-del-club', $_POST['capacidad_del_club']);
		update_post_meta($post_id, 'puede-dejar-efectivo', $_POST['puede_dejar_efectivo']);
		update_post_meta($post_id, 'dias-de-recoleccion-a', $_POST['dias_de_recoleccion_a']);
	}

	if ( isset($_POST['valor_en_puntos']) and check_admin_referer(__FILE__, '_info_ingrediente_nonce') ){
		update_post_meta($post_id, 'valor_en_puntos', $_POST['valor_en_puntos']);
	}
    
    
    if ( isset($_POST['cantidad_en_peso']) and check_admin_referer(__FILE__, '_cantidad_ingrediente_nonce') ){
		update_post_meta($post_id, 'cantidad_en_peso', $_POST['cantidad_en_peso']);
	}

    if ( isset($_POST['tipo_en_peso']) and check_admin_referer(__FILE__, '_cantidad_ingrediente_nonce') ){
		update_post_meta($post_id, 'tipo_en_peso', $_POST['tipo_en_peso']);
	}
    
    if ( isset($_POST['precio_ingrediente']) and check_admin_referer(__FILE__, '_precio_ingrediente_nonce') ){
		update_post_meta($post_id, 'precio_ingrediente', $_POST['precio_ingrediente']);
	}


	// Guardar correctamente los checkboxes
	if ( isset($_POST['adicional_canasta']) and check_admin_referer(__FILE__, '_info_ingrediente_nonce') ){
		update_post_meta($post_id, 'adicional_canasta', $_POST['adicional_canasta']);
	} else if ( ! defined('DOING_AJAX') ){
		delete_post_meta($post_id, 'adicional_canasta');
	}


});



// OTHER METABOXES ELEMENTS //////////////////////////////////////////////////////////

add_action( 'restrict_manage_posts', 'admin_ingredientes_filtro_adicional_en_canasta' );

function admin_ingredientes_filtro_adicional_en_canasta(){
    $type = 'ingredientes';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('ingredientes' == $type){
        $values = array(
            'Adicional en canasta' => 'si'
        );
        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filtrar por ', 'wose45436'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}


/**
 * MUESTRA LOS INGRETIENTES FILTRADOS COMO ADICIONALES A LA CANASTA
 */
add_filter( 'parse_query', 'filtrar_ingredientes_adicionales_canasta' );

function filtrar_ingredientes_adicionales_canasta( $query ){
    global $pagenow;
    $type = 'ingredientes';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'ingredientes' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'adicional_canasta';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}
