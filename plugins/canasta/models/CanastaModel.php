<?php
class CanastaModel {
	public $_wpdb;
	public $_prefix;

    function __construct() {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->_prefix = $wpdb->prefix;
    }

    static function install(){
    	$model = new CanastaModel;
  		$model->createTableCanasta();
  		$model->createTableCanastaRelationships();

    }

    private function createTableCanasta(){
    	global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}actualizaciones_canasta (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				se_entrega date NOT NULL DEFAULT '0000-00-00',
				valor_puntos_completa int(11) NOT NULL DEFAULT '0',
				valor_puntos_mitad int(11) NOT NULL DEFAULT '0',
				ultima_actualizacion datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
    }

    private function createTableCanastaRelationships(){
    	global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}canasta_relationships (
				id bigint(20) NOT NULL AUTO_INCREMENT,
				canasta_id bigint(20) unsigned NOT NULL DEFAULT '0',
				ingrediente_id bigint(20) unsigned NOT NULL DEFAULT '0',
				canasta_completa bigint(20) unsigned NOT NULL DEFAULT '0',
				media_canasta bigint(20) unsigned NOT NULL DEFAULT '0',
				adicional bigint(20) unsigned NOT NULL DEFAULT '0',
				UNIQUE KEY `id` (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);
    }

    /**
     * PRODUCTOS
     */
    static function productos()
    {
    	global $wpdb;
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
			WHERE post_status = 'publish' AND post_type = 'product';
		", OBJECT );
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

}