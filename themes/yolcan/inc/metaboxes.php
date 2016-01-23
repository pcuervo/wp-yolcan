<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){

		add_meta_box( 'meta-box-extras_receta', 'Extras Receta', 'show_metabox_extras_receta', 'recetas');
		add_meta_box( 'meta-box-ingredientes_receta', 'Ingredientes', 'show_metabox_ingredientes_receta', 'recetas', 'side', 'high');


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


		// Guardar correctamente los checkboxes
		/*if ( isset($_POST['_checkbox_meta']) and check_admin_referer(__FILE__, '_checkbox_nonce') ){
			update_post_meta($post_id, '_checkbox_meta', $_POST['_checkbox_meta']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, '_checkbox_meta');
		}*/


	});



// OTHER METABOXES ELEMENTS //////////////////////////////////////////////////////////
