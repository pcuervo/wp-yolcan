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
				club_id bigint(20) unsigned NOT NULL DEFAULT '0',
				fecha_activar_canasta date NOT NULL DEFAULT '0000-00-00',
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
	public function storeCanasta($idClub, $status, $fecha_activa)
	{
		$this->_wpdb->insert(
			$this->_prefix.'actualizaciones_canasta',
			array(
				'club_id' => $idClub,
				'fecha_creacion'  => date('Y-m-d h:i:s'),
				'fecha_actualizacion' => date('Y-m-d h:i:s'),
				'status' => $status,
				'fecha_activar_canasta' => $fecha_activa
			),
			array(
				'%d',
				'%s',
				'%s',
				'%d',
				'%s'
			)
		);

		return $this->_wpdb->insert_id;
	}

	/**
	 * REGRESA LA CANASTA ACTIVA
	 * @param  [int] $idClub [id del club]
	 * @return [object]      [ingredientes canastas]
	 */
	public function getCanastasClub($idClub, $status = 1)
	{
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}actualizaciones_canasta as ac
		  INNER JOIN {$this->_prefix}canasta_relationships as cr
		  ON ac.id = cr.actualizacion_id
		  WHERE club_id = $idClub AND status = $status;", 
	  OBJECT );
	}

	/**
	 * EDITA LA FECHA DE ACT UALIZACION
	 * @param  [int] $idActualizacion [id de la actualizacion a editar]
	 * @return [bool]
	 */
	public function updateDateEditCanasta($idActualizacion, $fechaActiva)
	{
		$this->_wpdb->update( 
		  	$this->_prefix.'actualizaciones_canasta', 
		  	array( 
				'fecha_actualizacion' => date('Y-m-d h:i:s'),
				'fecha_activar_canasta' => $fechaActiva
		  	), 
		  	array('id' => $idActualizacion), 
		  	array( 
				'%s',
				'%s'
		 	), 
		  	array( '%d' ) 
		);
	}

}