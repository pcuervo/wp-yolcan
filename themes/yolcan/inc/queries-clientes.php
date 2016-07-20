<?php
add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}opciones_clientes (
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			status int(11) NOT NULL DEFAULT '0',
			club_id bigint(20) unsigned NOT NULL DEFAULT '0',
			producto_id bigint(20) unsigned NOT NULL DEFAULT '0',
			saldo double(8,2) DEFAULT NULL,
			suspendido int(11) NOT NULL DEFAULT '0',
			id_suspencion bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_cambio_status date NOT NULL DEFAULT '0000-00-00',
		
			UNIQUE KEY `cliente_id` (`cliente_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});


add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}suspencion_entregas (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			status int(11) NOT NULL DEFAULT '0',
			tiempo_suspencion bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_inicio_suspencion date NOT NULL DEFAULT '0000-00-00',
			fecha_fin_suspencion date NOT NULL DEFAULT '0000-00-00',
		
			UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});	

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}decuentos_canastas (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			cantidad bigint(20) unsigned NOT NULL DEFAULT '0',
			producto_id bigint(20) unsigned NOT NULL DEFAULT '0',
			adicionales_id bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_descuesto date NOT NULL DEFAULT '0000-00-00',
			UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});	

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}adicionales_cliente (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			adicionales longtext COLLATE utf8mb4_unicode_ci,
			UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});	



/**
 * REGRESA LAOPCIONES DEL CLIENTE
 * @param  [integer] $clinetId [id del cliente]
 * @return [abject]            [Objeto con las opciones del cliente]
 */
function getOpcionesCliente($clienteId){
	global $wpdb;

	return $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}opciones_clientes 
		WHERE cliente_id = $clienteId;", OBJECT );
}

/**
 * Actualiza el club de consumo del cliente
 */
function setClubCliente($clubId, $clienteId){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'opciones_clientes',
		array(
			'cliente_id' => $clienteId,
			'status'  => 1,
			'saldo' => 0.00,
			'club_id' => $clubId,
			'fecha_cambio_status' => date('Y-m-d')
		),
		array(
			'%d',
			'%d',
			'%f',
			'%d',
			'%s'
		)
	);

	return $wpdb->insert_id;
}

/**
 * Actualiza el club de consumo del cliente
 */
function updateClubCliente($clubId, $clienteId){
	global $wpdb;
	$wpdb->update( 
		$wpdb->prefix.'opciones_clientes',
		array( 
			'club_id' => $clubId
		), 
		array( 'cliente_id' => $clienteId ), 
		array( 
			'%d'
		), 
		array( '%d' ) 
	);

	return true;
}

/**
 * REGRESA LOS CLUBES
 */
function getClubesDeConsumo(){
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts
		WHERE post_status = 'publish' AND post_type = 'clubes-de-consumo';
	", OBJECT );
}


function getIngredientesCanasta($canastaID){
	global $wpdb;
	return $wpdb->get_results( "SELECT ingrediente_id, cantidad FROM {$wpdb->prefix}actualizaciones_canasta as ac
		INNER JOIN {$wpdb->prefix}canasta_relationships as cr
		ON ac.id = cr.actualizacion_id
		WHERE canasta_id = $canastaID AND status = 1;
	", OBJECT );
}


function getIngredientesAdicionales($clienteId){
	global $wpdb;
	return $wpdb->get_var("SELECT adicionales FROM {$wpdb->prefix}adicionales_cliente
		WHERE cliente_id = $clienteId;"
	);
}

/**	
 * GUARDA EL REGISTRO DE LOS INGREDIENTES ADICIONALES
 */
function saveIngredientesAdicionales($data, $clienteId){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'adicionales_cliente',
		array(
			'cliente_id' => $clienteId,
			'adicionales' => $data
		),
		array(
			'%d',
			'%s'
		)
	);

	return $wpdb->insert_id;
}

/**
 * ACTUALIZA LOS INGREDIENES ADICIONALES
 */
function updateIngredientesAdicionales($data, $clienteId){
	global $wpdb;
	$wpdb->update( 
		$wpdb->prefix.'adicionales_cliente',
		array( 
			'adicionales' => $data
		), 
		array( 'cliente_id' => $clienteId ), 
		array( 
			'%s'
		), 
		array( '%d' ) 
	);

	return true;
}
