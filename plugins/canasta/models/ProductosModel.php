<?php
class ProductosModel {
	public $_wpdb;
	public $_prefix;

    function __construct() {
        global $wpdb;
        $this->_wpdb = $wpdb;
        $this->_prefix = $wpdb->prefix;
    }

    /**
     * PRODUCTOS
     */
    public function productos()
    {
        global $wpdb;
        return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
            WHERE post_status = 'publish' AND post_type = 'product';
        ", OBJECT );
    }

}