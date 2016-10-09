<?php
class RestaurantesModel {
	public $_wpdb;
	public $_prefix;

	function __construct() {
		global $wpdb;
		$this->_wpdb = $wpdb;
		$this->_prefix = $wpdb->prefix;
	}

	static function install()
	{
		$model_restaurante = new RestaurantesModel;
		$model_restaurante->restaurante_roles();
		$model_restaurante->createTableSaldoRestaurantes();
		$model_restaurante->createTableHistorialSaldoRestaurantes();
		$model_restaurante->createTableHistorialCortesRestaurantes();
	}

	/**	
	 * CREA EL ROL RESTAURANTE
	 * @return [type] [description]
	 */
	private function restaurante_roles()
	{
		$administrator = get_role('author');
		add_role( 'restaurante', 'Restaurante', $administrator->capabilities );
	}

	private function createTableSaldoRestaurantes()
	{
		$this->_wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$this->_prefix}saldo_restaurantes (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				status int(11) NOT NULL DEFAULT '1',
				restaurante_id bigint(20) unsigned NOT NULL DEFAULT '0',
				saldo double(8,2) DEFAULT NULL,
				suspendido int(11) NOT NULL DEFAULT '0',
				id_suspension bigint(20) unsigned NOT NULL DEFAULT '0',
				fecha_cambio_status date NOT NULL DEFAULT '0000-00-00',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
	}

	private function createTableHistorialSaldoRestaurantes()
	{
		$this->_wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$this->_prefix}historial_saldo_restaurantes (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				restaurante_id bigint(20) unsigned NOT NULL DEFAULT '0',
				saldo_anterior double(8,2) DEFAULT NULL,
				saldo_agregado double(8,2) DEFAULT NULL,
				saldo_a_la_fecha double(8,2) DEFAULT NULL,
				fecha datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				user_id bigint(20) unsigned NOT NULL DEFAULT '0',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
	}

	private function createTableHistorialCortesRestaurantes()
	{
		$this->_wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$this->_prefix}historial_cortes_restaurantes (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				restaurante_id bigint(20) unsigned NOT NULL DEFAULT '0',
				saldo_anterior double(8,2) DEFAULT NULL,
				total_corte double(8,2) DEFAULT NULL,
				saldo_despues_del_corte double(8,2) DEFAULT NULL,
				ingredientes longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
				fecha_corte datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				user_id bigint(20) unsigned NOT NULL DEFAULT '0',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
	}

	/**
	 * REGRESA LOS RESTAURANTES ACTIVOS
	 * @return [type] [description]
	 */
	public function getActivos()
	{
		return $this->_wpdb->get_results( "SELECT sc.* FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%restaurante%') as um
			INNER JOIN {$this->_prefix}saldo_restaurantes as sc
			ON um.user_id = sc.restaurante_id
			WHERE suspendido = 0 AND saldo > 0;", 
	  OBJECT );
	}

	/**	
	 * REGRESA LOS RESTAURANTES QUE NUEVOS
	 * @return [type] [description]
	 */
	public function getInactivos()
	{
		return $this->_wpdb->get_results( "SELECT user_id as restaurante_id FROM {$this->_prefix}usermeta as um
			INNER JOIN  {$this->_prefix}users as u
			ON um.user_id = u.ID
			WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%restaurante%' AND user_id NOT IN (SELECT restaurante_id FROM {$this->_prefix}saldo_restaurantes)", 
	 	 OBJECT );
	}

	/**	
	 * INFORMACION DEL RESTAURANTE
	 * @param  [type] $restauranteId [description]
	 * @return [type]                [description]
	 */
	public function getDataRestauranteById($restauranteId)
	{
		return $this->_wpdb->get_row( "SELECT * FROM {$this->_prefix}saldo_restaurantes WHERE restaurante_id = $restauranteId;", 
	 	 OBJECT );

	}

	/**
	 * HISTORIALD E CARGAS DE SALDO RESTAURANTE
	 * @param  [type] $restauranteId [description]
	 * @return [type]                [description]
	 */
	public function getHistorySaldoRestauranteById($restauranteId){
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}historial_saldo_restaurantes 
			WHERE restaurante_id = $restauranteId ORDER BY id DESC ;", 
	 	 OBJECT );
	}

}