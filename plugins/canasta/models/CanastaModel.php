<?php
class CanastaModel {
	public $_wpdb;
	public $_prefix;

    function __construct() {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->_prefix = $wpdb->prefix;
    }

    static function install()
    {
    	$model = new CanastaModel;
  		$model->createTableCanasta();
  		$model->createTableCanastaRelationships();

    }

    private function createTableCanasta()
    {
    	global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}actualizaciones_canasta (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				canasta_id bigint(20) unsigned NOT NULL DEFAULT '0',
				se_entrega date NOT NULL DEFAULT '0000-00-00',
				fecha_creacion datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				fecha_actualizacion datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				status int(11) NOT NULL DEFAULT '0',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
    }

    private function createTableCanastaRelationships()
    {
    	global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}canasta_relationships (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				canasta_id bigint(20) unsigned NOT NULL DEFAULT '0',
				ingrediente_id bigint(20) unsigned NOT NULL DEFAULT '0',
				actualizacion_id bigint(20) unsigned NOT NULL DEFAULT '0',
				cantidad bigint(20) unsigned NOT NULL DEFAULT '0',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
    }

	/**
	 * CLUBES DE CONSUMO 
	 */
    static function clubes()
	{
		global $wpdb;
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
			WHERE post_status = 'publish' AND post_type = 'clubes-de-consumo';
		", OBJECT );
	}

        
    static function ingredientes()
	{
		global $wpdb;
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
			WHERE post_status = 'publish' AND post_type = 'ingredientes';
		", OBJECT );
	}

	/**
     * GUARDA LA ACTUALIZACION DE LA CANASTA
     * @param  [int] $puntos_completa [puntos de canasat completa]
     * @param  [int] $puntos_mitad    [puntos de la mitad de la canasta]
     * @return [int]                  [id de la actualización]
     */
    public function storeCanasta($idCanasta, $status, $fechaActualizacion, $fechaEntrega)
    {
    	$this->_wpdb->insert(
            $this->_prefix.'actualizaciones_canasta',
            array(
                'canasta_id' => $idCanasta,
                'fecha_creacion'  => date('Y-m-d h:i:s'),
                'status'  => $status,
                'fecha_actualizacion' => $fechaActualizacion,
                'se_entrega' => $fechaEntrega

            ),
            array(
                '%d',
                '%s',
                '%d',
                '%s',
                '%s'
            )
        );

        return $this->_wpdb->insert_id;
    }


  //   public function getUltimaActualizacion()
  //   {
  //   	return $this->_wpdb->get_row( "SELECT * FROM {$this->_prefix}actualizaciones_canasta
  //   		ORDER BY ultima_actualizacion DESC
  //   		LIMIT 1;
		// ", OBJECT );
  //   }

}