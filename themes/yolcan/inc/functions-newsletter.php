<?php

require_once('MCAPI.class.php');

/**
 * RESIVE INFORMACION DEL FORMULARIO DE CONTACTO
 */
function ajax_mail_send_newsletter(){

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$apikey = MAILCHIMP_API_KEY;
	$listId = 'da8c08262c';

	$apiUrl = 'http://api.mailchimp.com/1.3/';
	$api = new MCAPI($apikey);

	$retval = $api->listSubscribe( $listId, $email, array(), 'html', false);

	if ($api->errorCode){
		wp_send_json("Hubo un error con la solicitud, intentalo de nuevo.");
	} else {
	    wp_send_json(1);
	}

}

add_action('wp_ajax_ajax_mail_send_newsletter', 'ajax_mail_send_newsletter');
add_action('wp_ajax_nopriv_ajax_mail_send_newsletter', 'ajax_mail_send_newsletter');