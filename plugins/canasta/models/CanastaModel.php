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

	/**
	 * CLUBES DE CONSUMO 
	 */
	static function clubesByID($clubes)
	{
		$clubes = getClubesSeparadoComas($clubes);

		global $wpdb;
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
			WHERE post_status = 'publish' AND post_type = 'clubes-de-consumo' AND ID IN ($clubes);
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
	 * GET CANASTAS
	 * @return [type] [description]
	 */
	static function getCanastas(){
		$args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'canastas',
                ),
            )
        );
        $canastas = new WP_Query( $args );
        if (!empty($canastas->posts)) {
        	return $canastas->posts;
        }

        return [];
	}

	/**
	 * REGRESA TODAS LAS CANASTAS ACTIVAS CON SUS INGREDIENTES
	 * @return [type] [description]
	 */
	static function canastasActivas(){
		global $wpdb;
		return $wpdb->get_results( "SELECT club_id, canasta_id, ingrediente_id, cantidad
			FROM {$wpdb->prefix}actualizaciones_canasta as ac
			INNER JOIN {$wpdb->prefix}canasta_relationships as cr
			ON ac.id = cr.actualizacion_id 
			WHERE status = 1;
		", OBJECT );
	}


	static function desactivarCanastas($clubes){
		global $wpdb;
		$clubes = getClubesSeparadoComas($clubes);
		$wpdb->query("UPDATE {$wpdb->prefix}actualizaciones_canasta 
			SET status = 0
			WHERE status = 1 AND club_id IN ($clubes)"
		);
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
	 * REGRESA LAS CANASTAS DE LA ACTUALIZACIOM
	 * @param  [int] $idClub [id del club]
	 * @return [object]      [ingredientes canastas]
	 */
	public function getCanastasClubByActualizacion($idActualizacion)
	{
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}actualizaciones_canasta as ac
		  	INNER JOIN {$this->_prefix}canasta_relationships as cr
		  	ON ac.id = cr.actualizacion_id
		  	WHERE ac.id = $idActualizacion;", 
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

	/**
	 * REGRESA LAS ULTIMAS 20 ACTUALIZACIONES DE LA CANASTA
	 * @param  integer  $this->idClub [id del club]
	 * @param  integer $limit        [limite de actualizaciones]
	 * @return [object]                [ultimas actualizaciones]
	 */
	public function getHistorialCanastasByClub($idClub, $limit = 20)
	{
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}actualizaciones_canasta
			WHERE club_id = $idClub
			ORDER BY id DESC
			LIMIT $limit;", 
	 	OBJECT );
	}

	/**
	 * RETURN RESULTS REPORT
	 * @return [type] [description]
	 */
	public function getReport($data)
	{
		$select = 'SELECT * FROM '.$this->_prefix.'corte_canastas';
		$where = '';
		if ($data['club'] != 'all') {
			$where .= ' club_id = '.$data['club'];
		}

		if ($data['canasta'] != 'all') {
			if ($where != '') $where .= ' AND';
			$where .= ' canasta_id_real = '.$data['canasta'];
		}

		if ($data['reporte_del'] != '') {
			if ($where != '') $where .= ' AND';
			$where .= ' fecha_corte >= "'.$data['reporte_del'].'"';
		}

		if ($data['reporte_a'] != '') {
			if ($where != '') $where .= ' AND';
			$where .= ' fecha_corte <= "'.$data['reporte_a'].'"';
		}

		if ($data['cliente'] != '') {
			if ($where != '') $where .= ' AND';
			$where .= ' cliente_id = "'.$data['cliente'].'"';
		}
		
		if ($where != '') {
			$select .= ' WHERE '.$where;
		}

		return $this->_wpdb->get_results( $select, OBJECT );
	}


}