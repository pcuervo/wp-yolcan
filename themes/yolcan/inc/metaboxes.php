<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){
		global $post;

		add_meta_box( 'meta-box-extras_receta', 'Extras Receta', 'show_metabox_extras_receta', 'recetas');
		add_meta_box( 'meta-box-ingredientes_receta', 'Ingredientes', 'show_metabox_ingredientes_receta', 'recetas', 'side', 'high');
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

		 		<input type="checkbox" name="ingredientes[]" id="ingredientes[]" value="<?php echo $ingrediente->ID ?>" <?php echo $checked; ?> /> <?php echo $ingrediente->post_name; ?><br><br>
				
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
		$capasidad_visita = get_post_meta($post->ID, 'capasidad_visita', true);
		$persona_extra_visita = get_post_meta($post->ID, 'persona_extra_visita', true);
		$persona_extra_visita_2 = get_post_meta($post->ID, 'persona_extra_visita_2', true);


		wp_nonce_field(__FILE__, '_datos_visitas_nonce');

		echo "<label for='costo_visita' class='label-paquetes'>Costo: </label>";
		echo "<input type='text' class='widefat' id='costo_visita' name='costo_visita' value='$costo_visita'/>";

		echo "<br><br><label for='capasidad_visita' class='label-paquetes'>Capasidad: </label>";
		echo "<input type='text' class='widefat' id='capasidad_visita' name='capasidad_visita' value='$capasidad_visita'/>";

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
			update_post_meta($post_id, 'capasidad_visita', $_POST['capasidad_visita']);
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


		


		// Guardar correctamente los checkboxes
		/*if ( isset($_POST['_checkbox_meta']) and check_admin_referer(__FILE__, '_checkbox_nonce') ){
			update_post_meta($post_id, '_checkbox_meta', $_POST['_checkbox_meta']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, '_checkbox_meta');
		}*/


	});



// OTHER METABOXES ELEMENTS //////////////////////////////////////////////////////////
