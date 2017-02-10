<?php
add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}opciones_clientes (
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			status int(11) NOT NULL DEFAULT '0',
			club_id bigint(20) unsigned NOT NULL DEFAULT '0',
			producto_id bigint(20) unsigned NOT NULL DEFAULT '0',
			saldo double(8,2) DEFAULT NULL,
			costo_semanal_canasta double(8,2) DEFAULT NULL,
			suspendido int(11) NOT NULL DEFAULT '0',
			id_suspension bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_cambio_status date NOT NULL DEFAULT '0000-00-00',
		
			UNIQUE KEY `cliente_id` (`cliente_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});


add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}suspension_entregas (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			tiempo_suspension bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_inicio_suspension date NOT NULL DEFAULT '0000-00-00',
			fecha_fin_suspension date NOT NULL DEFAULT '0000-00-00',
			fecha_proximo_cobro date NOT NULL DEFAULT '0000-00-00',
		
			UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);
});	

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}corte_canastas (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			saldo_anterior double(8,2) DEFAULT NULL,
			costo_canasta double(8,2) DEFAULT NULL,
			variation_id bigint(20) unsigned NOT NULL DEFAULT '0',
			club_id bigint(20) unsigned NOT NULL DEFAULT '0',
			actualizacion_id bigint(20) unsigned NOT NULL DEFAULT '0',
			canasta_id bigint(20) unsigned NOT NULL DEFAULT '0',
			adicionales longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
			fecha_corte date NOT NULL DEFAULT '0000-00-00',
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

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}saldo_modificado_por_admin (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL DEFAULT '0',
			cliente_id bigint(20) unsigned NOT NULL DEFAULT '0',
			saldo_anterior double(8,2) DEFAULT NULL,
			saldo_agregado double(8,2) DEFAULT NULL,
			fecha date NOT NULL DEFAULT '0000-00-00',
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
function setOpcionesCliente($clubId, $variation_id, $saldo, $costoSemanalCanasta, $clienteId){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'opciones_clientes',
		array(
			'cliente_id' => $clienteId,
			'status'  => 1,
			'saldo' => $saldo,
			'producto_id' => $variation_id,
			'club_id' => $clubId,
			'fecha_cambio_status' => date('Y-m-d'),
			'costo_semanal_canasta' => $costoSemanalCanasta
		),
		array(
			'%d',
			'%d',
			'%f',
			'%d',
			'%d',
			'%s',
			'%f'
		)
	);

	return $wpdb->insert_id;
}

/**
 * Actualiza el club de consumo del cliente
 */
function updateOpcionesCliente($clubId, $variation_id, $saldo, $costoSemanalCanasta, $clienteId){
	global $wpdb;
	$wpdb->update( 
		$wpdb->prefix.'opciones_clientes',
		array( 
			'club_id' => $clubId,
			'saldo' => $saldo,
			'producto_id' => $variation_id,
			'costo_semanal_canasta' => $costoSemanalCanasta
		), 
		array( 'cliente_id' => $clienteId ), 
		array( 
			'%d',
			'%f',
			'%d',
			'%f'
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


function getIngredienteAdicionalCanasta($canastaID, $ingredienteId){
	global $wpdb;
	return $wpdb->get_row( "SELECT ingrediente_id, cantidad FROM {$wpdb->prefix}actualizaciones_canasta as ac
		INNER JOIN {$wpdb->prefix}canasta_relationships as cr
		ON ac.id = cr.actualizacion_id
		WHERE canasta_id = $canastaID AND ingrediente_id = $ingredienteId AND status = 1;
	");
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

/**
 * GUARDA LA SUSPENCION DE LA CANASTA
 * @param  [int] $clienteID   [id del cliente]
 * @param  [int] $suspencion  [semanas de suspencion]
 * @param  [date] $fechaInicio [fecha en que se suspendio]
 * @param  [date] $fechaFin    [fecha del proximo descuento]
 * @return [int]              [id suspencion]
 */
function updateSuspensionCanasta($clienteId, $suspension, $fechaInicio, $fechaFin, $fechaProximoCobro){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'suspension_entregas',
		array(
			'cliente_id' => $clienteId,
			'tiempo_suspension' => $suspension,
			'fecha_inicio_suspension' => $fechaInicio,
			'fecha_fin_suspension' => $fechaFin,
			'fecha_proximo_cobro' => $fechaProximoCobro
		),
		array(
			'%d',
			'%d',
			'%s',
			'%s',
			'%s'
		)
	);

	return $wpdb->insert_id;
}

/**
 * CAMBIA EL STATUS DE LA SUSPENCION
 * @param  [type] $clienteId    [description]
 * @param  [type] $idSuspension [description]
 * @return [type]               [description]
 */
function updateSuspensionOpcionesCliente($clienteId, $idSuspension, $status = 1){
	global $wpdb;
	$wpdb->update( 
		$wpdb->prefix.'opciones_clientes',
		array( 
			'suspendido' => $status,
			'id_suspension' => $idSuspension
		), 
		array( 'cliente_id' => $clienteId ), 
		array( 
			'%d',
			'%d'
		), 
		array( '%d' ) 
	);

	return true;
}

/**
 * INFORMACION DE LA SUSPENSION DEL CLIENTE
 * @param  [int] $clineteId [id del cliente]
 * @return [object]            [informacion de la suspension]
 */
function getDataSuspensionActiva($clineteId){
	global $wpdb;

	return $wpdb->get_row( "SELECT tiempo_suspension, fecha_inicio_suspension, fecha_fin_suspension, fecha_proximo_cobro 
		FROM {$wpdb->prefix}opciones_clientes as oc
		INNER JOIN {$wpdb->prefix}suspension_entregas as se
		ON oc.id_suspension = se.id
		WHERE oc.cliente_id = $clineteId AND oc.suspendido = 1", OBJECT );
}


/**
 * REGRESA LOS CLIENTES QUE SE LES TIENE QUE DESACTIVAR SU CUENTA
 * @param  string $fecha [fecha actual]
 * @return [type]        [description]
 */
function getClientesDesactivarSuspension($fecha = ''){
	$fecha = $fecha == '' ? date('Y-m-d') : $fecha;
	global $wpdb;
	return $wpdb->get_results( "SELECT oc.cliente_id FROM {$wpdb->prefix}opciones_clientes as oc
		INNER JOIN {$wpdb->prefix}suspension_entregas as se
		ON oc.id_suspension = se.id
		WHERE oc.suspendido = 1 AND fecha_fin_suspension <= '$fecha';
	", OBJECT );
	
}

/**	
 * CLIENTES ACTIVOS
 * @return [type] [description]
 */
function getClientesActivos($clubes){
	$clubes = getClubesSeparadoComas($clubes);
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}opciones_clientes 
		WHERE suspendido = 0 AND status = 1 AND club_id IN ($clubes);
	", OBJECT );
}


/**
 * ACTUALIZA EL SALDO DEL CLIENTE
 * @param  [int] $clienteId [cliente id]
 * @param  [float] $saldo     [saldo]
 * @return [type]            [description]
 */
function updateSaldoCliente($clienteId, $saldo){
	global $wpdb;
	$wpdb->query("UPDATE {$wpdb->prefix}opciones_clientes 
		SET saldo = $saldo
		WHERE cliente_id = $clienteId;"
	);
}


function saveCanastaAlCorteCliente($data){
	extract($data);
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'corte_canastas',
		array(
			'cliente_id' => $cliente_id,
			'saldo_anterior' => $saldo_anterior,
			'costo_canasta' => $costo_canasta,
			'variation_id' => $variation_id,
			'club_id' => $club_id,
			'adicionales' => $adicionales,
			'fecha_corte' => $fecha_corte,
			'actualizacion_id' => $actualizacion_id,
			'canasta_id' => $canasta_id
		),
		array(
			'%d',
			'%s',
			'%s',
			'%d',
			'%d',
			'%s',
			'%s',
			'%d',
			'%d'
		)
	);

	return $wpdb->insert_id;
}

/**
 * REGRESA EL ID DE LA ACTUALIZACION DE LA CANASTA
 * @param  [int] $clubId [id del clube]
 * @return [type]                   [description]
 */
function getActualizacionCanasta($clubId){
	global $wpdb;
	return $wpdb->get_var("SELECT id FROM {$wpdb->prefix}actualizaciones_canasta
		WHERE club_id = $clubId AND status = 1;"
	);
}


/**	
 * REGRESA LA ACTUALIZACION DE LA CANASTA ID ACTIVA
 * @param  [type] $canastaId [description]
 * @return [type]            [description]
 */
function getActualizacionCanastaID($canastaId){
	global $wpdb;
	return $wpdb->get_var("SELECT ac.id FROM {$wpdb->prefix}actualizaciones_canasta as ac
		INNER JOIN {$wpdb->prefix}canasta_relationships as cr
		ON ac.id = cr.actualizacion_id 
		WHERE canasta_id = $canastaId AND status = 1
		GROUP BY ac.id;"
	);
}


/**	
 * CAMBIA EL STATUS DE LAS CANASTAS A DESACTIVADAS
 * @return [type] [description]
 */
function updateStatusActualizaciones(){
	global $wpdb;
	$wpdb->query("UPDATE {$wpdb->prefix}actualizaciones_canasta 
		SET status = 0
		WHERE status = 1"
	);
}