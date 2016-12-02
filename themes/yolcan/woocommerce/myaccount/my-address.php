<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $opCliente;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'woocommerce' ),
		'shipping' => __( 'Shipping Address', 'woocommerce' )
	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'woocommerce' )
	), $customer_id );
}

$col = 1;
$clubTitle = $opCliente->clubId > 0 ? get_the_title($opCliente->clubId) : 'Aún no cuentas con un club'; ?>

<h3>Club:<br> <?php echo $clubTitle; ?></h3>
<a class="[ btn btn-secondary ]" href="<?php echo site_url('/mi-cuenta'); ?>?update_clube=si">Cambiar de club</a><br><br>

<div class="[ margin-bottom--large ]">
	<?php if( $opCliente->clubId > 0 ):
		$direccion = get_post_meta($opCliente->clubId, 'ubicacion-club', true);
	    $latitud_club = get_post_meta($opCliente->clubId, 'ubicacion-club', true);
	    $longitud_club = get_post_meta($opCliente->clubId, 'ubicacion-club', true);
	    $dias_de_recoleccion = get_post_meta($opCliente->clubId, 'dias-de-recoleccion', true);
	    $dias_de_recoleccion_a = get_post_meta($opCliente->clubId, 'dias-de-recoleccion-a', true);
	    $horarios_de_recoleccion = get_post_meta($opCliente->clubId, 'horarios-de-recoleccion', true);
	    $nombre_encargado_club = get_post_meta($opCliente->clubId, 'nombre-encargado-club', true);
	    $telefono_encargado_club = get_post_meta($opCliente->clubId, 'telefono-encargado-club', true); ?>
		
		<?php if( $latitud_club ): ?>
		    <div class="map-wrap iframe-cont [ margin-top-bottom--small ]">
		        <div class="overlay" onClick="style.pointerEvents='none'"></div><!-- wrap map iframe to turn off mouse scroll and turn it back on on click -->
		        <iframe class="map" width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $latitud_club; ?>,<?php echo $longitud_club; ?>&hl=es;z=14&amp;output=embed"></iframe>
		    </div>
		<?php endif; ?>
	    <p><?php echo $direccion; ?></p>
	    <?php echo $dias_de_recoleccion != '' ? '<p>Días de recolección '.$dias_de_recoleccion.'</p>' : '';
	    echo $horarios_de_recoleccion != '' ? '<p>Horario de recolección: '.$horarios_de_recoleccion.'</p>' : '';
	    echo $nombre_encargado_club != '' ? '<p>Encargado del Club: '.$nombre_encargado_club.'</p>' : '';
	    echo $telefono_encargado_club != '' ? '<p>Teléfono del encargado: '.$telefono_encargado_club.'</p>' : '';
	endif; ?>	
</div>


<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
</p>