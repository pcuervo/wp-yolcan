<?php
class IngredientesModel {
	public $_wpdb;
	public $_prefix;

    function __construct() {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->_prefix = $wpdb->prefix;
    }

    /**	
     * REGRESA TODOS LOS INGREDIENTES
     * @return [array] [ingredientes para la canasta]
     */
    public function getIngredientes()
    {
    	$ingredientes = new WP_Query(array(
			'post_type'      => 'ingredientes',
			'posts_per_page' => -1,
		));
		$new_arr = array();
		if ( $ingredientes->have_posts() ){
			while ( $ingredientes->have_posts() ) { 
				$ingredientes->the_post();

				$puntos = get_post_meta(get_the_ID(), 'valor_en_puntos', true);

				$new_arr[get_the_ID()]['nombre'] = get_the_title();
				$new_arr[get_the_ID()]['puntos'] = $puntos == '' ? 0 : $puntos;

			}
		}
		wp_reset_postdata();

		return $new_arr;
    }

    public function setIngredientesCanasta($data)
    {
    	$canasta_id = $this->saveCanasta($data['valor_puntos_completa'], $data['valor_puntos_mitad']);
    	$this->saveIngredientes($canasta_id, $data['ingredientes_canasta']);

    }


    public function saveIngredientes($canasta_id, $ingredientes)
    {
    	if (! empty($ingredientes)) {
    		foreach ($ingredientes as $key => $ingrediente) {
    			$this->_wpdb->insert(
		            $this->_prefix.'canasta_relationships',
		            array(
		                'canasta_id' 	   => $canasta_id,
		                'ingrediente_id'   => $key,
		                'canasta_completa' => isset($ingrediente['canasta_completa']) ? 1 : 0,
		                'media_canasta'    => isset($ingrediente['media_canasta']) ? 1 : 0,
		                'adicional'        => isset($ingrediente['adicional']) ? 1 : 0
		            ),
		            array(
		                '%d',
		                '%d',
		                '%d',
		                '%d',
		                '%d'
		            )
		        );
    		}
    	}

    	return true;
    }


    public function saveCanasta($puntos_completa, $puntos_mitad)
    {
    	$this->_wpdb->insert(
            $this->_prefix.'actualizaciones_canasta',
            array(
                'valor_puntos_completa' => $puntos_completa,
                'valor_puntos_mitad'    => $puntos_mitad,
                'ultima_actualizacion'  => date('Y-m-d h:i:s')
            ),
            array(
                '%d',
                '%d',
                '%s'
            )
        );

        return $wpdb->insert_id;
    }

}