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
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'canastas',
                ),
            )
        );
        $productos = new WP_Query( $args );

        return ! empty($productos->posts) ? $productos->posts : [];
    }

}