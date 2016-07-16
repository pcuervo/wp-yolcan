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

                $new_arr[get_the_ID()]['ID'] = get_the_ID();
				$new_arr[get_the_ID()]['nombre'] = get_the_title();
				$new_arr[get_the_ID()]['puntos'] = $puntos == '' ? 0 : $puntos;

			}
		}
		wp_reset_postdata();

		return $new_arr;
    }

    /**ELIMINA LOS INGREDIENTES DE LA CANASTA
     * @param  [int] $idCanasta [id de la canasta]
     * @return [type]            [description]
     */
    public function destroyIngredientesCanasta($idCanasta)
    {   
        $this->_wpdb->delete( $this->_prefix.'canasta_relationships', array( 'canasta_id' => $idCanasta ), array( '%d' ) );
    }


    /** 
     * GUARDA EL INGREDIENTE DE LA CANASTA
     * @param  [type] $idCanasta [description]
     * @return [type]            [description]
     */
    public function storeIngredienteCanasta($idCanasta, $idIngrediente)
    {
        $this->_wpdb->insert(
            $this->_prefix.'canasta_relationships',
            array(
                'canasta_id' => $idCanasta,
                'ingrediente_id' =>$idIngrediente
            ),
            array(
                '%d',
                '%d'
            )
        );

        return true;
    }
	

    /**
     * REGRESA LOS INGREDIENTES DE LA ACTUALIZACION INDICADA
     * @param  [integer] $id_actualizacion [id de la actualizacion]
     * @param  string $tipo             [tipo de canasta]
     * @return [object]                   [ingredientes]
     */
    public function getIngredientesCanasta($idActualizacion)
    {
    	return $this->_wpdb->get_results( "SELECT cr.*, p.post_title as nombre_ingrediente FROM {$this->_prefix}canasta_relationships as cr
            INNER JOIN {$this->_prefix}posts as p
            ON cr.ingrediente_id = p.ID
    		WHERE actualizacionID = $idActualizacion {$query_extra};
		", OBJECT );
    }

}