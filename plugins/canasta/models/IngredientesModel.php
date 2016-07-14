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
    	//$canasta_id = $this->saveCanasta($data['valor_puntos_completa'], $data['valor_puntos_mitad']);
    	//$this->saveIngredientes($canasta_id, $data['ingredientes_canasta']);

    }

    /**
     * GUARDA LOS INGREDIENTES DE LA ACTUALIZACIÓN DE LA CANASTA
     * @param  [int] $canasta_id   [id de la actualizacion de la canasta]
     * @param  [array] $ingredientes [ingredientes a guaradar de la actualizacion]
     * @return [boolean]               [true]
     */
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

    /**
     * GUARDA LA ACTUALIZACION DE PUNTOS Y FECHA DE LA CANASTA
     * @param  [int] $puntos_completa [puntos de canasat completa]
     * @param  [int] $puntos_mitad    [puntos de la mitad de la canasta]
     * @return [int]                  [id de la actualización]
     */
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

        return $this->_wpdb->insert_id;
    }
	

    public function getUltimaActualizacion()
    {
    	return $this->_wpdb->get_row( "SELECT * FROM {$this->_prefix}actualizaciones_canasta
    		ORDER BY ultima_actualizacion DESC
    		LIMIT 1;
		", OBJECT );
    }

    /**
     * REGRESA LOS INGREDIENTES DE LA ACTUALIZACION INDICADA
     * @param  [integer] $id_actualizacion [id de la actualizacion]
     * @param  string $tipo             [tipo de canasta]
     * @return [object]                   [ingredientes]
     */
    public function getIngredientesCanasta($id_actualizacion, $tipo = 'all')
    {
        $query_extra = ' ';
        if ($tipo == 'completa') $query_extra .= 'AND canasta_completa = 1';
        if ($tipo == 'media') $query_extra .= 'AND media_canasta = 1';
        if ($tipo == 'adicionales') $query_extra .= 'AND adicional = 1';


    	return $this->_wpdb->get_results( "SELECT cr.*, p.post_title as nombre_ingrediente FROM {$this->_prefix}canasta_relationships as cr
            INNER JOIN {$this->_prefix}posts as p
            ON cr.ingrediente_id = p.ID
    		WHERE canasta_id = $id_actualizacion {$query_extra};
		", OBJECT );
    }

}