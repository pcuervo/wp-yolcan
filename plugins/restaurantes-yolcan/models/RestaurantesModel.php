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




}