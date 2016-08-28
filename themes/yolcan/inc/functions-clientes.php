<?php global $opCliente;
global $clubCanasta;
global $procesoRegistro;
add_action('get_header', function() {
	global $current_user;
	if(isset($_POST['action']) AND $_POST['action'] == 'suspender-canasta') suspenderCanastaTemporal($_POST, $current_user->ID);
	if(isset($_POST['action']) AND $_POST['action'] == 'reanudar-canasta') reanudarCanasta($current_user->ID);
	if(isset($_POST['action']) AND $_POST['action'] == 'delete-aditional') deleteIngredienteAdicional($_POST);
	if(isset($_POST['action']) AND $_POST['action'] == 'save-additional-ingredient') setIngredienteAdicional($_POST);
	if(is_page('mi-cuenta') AND isset($_POST['club'])) saveClubCliente($_POST['club']);
	if(is_page('mi-cuenta')) checkStatusCliente();
	if(is_page('mi-cuenta')) getClubAndCanasta();
});

if(isset($_POST['action']) AND $_POST['action'] == 'create-client') setNuevoCliente($_POST);


/**
 * CREA UN NURVO CLIENTE
 * @param [type] $data [description]
 */
function setNuevoCliente($data){
	global $procesoRegistro;
	extract($data);
	$user_id = username_exists( $emailCliente );
	if ( !$user_id and email_exists($emailCliente) == false ) {
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		$user_id = wp_create_user( $nombreCliente, $passwordCliente, $emailCliente );
		if(!is_wp_error($user_id)){
			$wp_user = get_user_by( 'id', $user_id );
			$wp_user->set_role( 'customer' );
		    wp_set_current_user($user_id);
		    wp_set_auth_cookie($user_id); 
		    wp_safe_redirect( site_url('/mi-cuenta') );
   			exit();
		}
	} else {
		$procesoRegistro['error'] = 'El email ya esta en uso';
	}
}

/**	
 * ACTUALIZA LOS INGREDIENTES ADICIONALES DEL CLIENTE
 */
function setIngredienteAdicional($data){
	global $current_user;
	$adicionales = getIngredientesAdicionales($current_user->ID);
	if ($adicionales == '') return storeIngredientesAdicionales($current_user->ID, $data);
	
	return editIngredientesAdicionales($current_user->ID, $data, $adicionales);
}


/**
 * ELIMINAR INGREDIENTES ADICIONALES
 * @return [type]        [description]
 */
function deleteIngredienteAdicional($data){
	global $current_user;
	$adicionales = unserialize(getIngredientesAdicionales($current_user->ID) );

	$restar = isset($adicionales['ingredientes'][$data['adicional_id']]['total']) ? $adicionales['ingredientes'][$data['adicional_id']]['total'] : 0;
	$adicionales['total_adicionales'] = $adicionales['total_adicionales'] - $restar;
	unset($adicionales['ingredientes'][$data['adicional_id']]);

	updateIngredientesAdicionales(serialize($adicionales), $current_user->ID);
}

/**
 * GUARDA LOS ADICIONALES DEL CLIENTE
 */
function storeIngredientesAdicionales($clienteId, $data){
	$newArr = [];
	$total = $data['adicional-costo'] * $data['adicional-numero-productos'];
	$newArr['total_adicionales'] = $total;
	$newArr['ingredientes'][$data['adicional-id']] = [
		'ingredienteID' => $data['adicional-id'],
		'costo_unitario' => $data['adicional-costo'],
		'total' => $total,
		'cantidad' => $data['adicional-numero-productos'],
		'periodo' => $data['adicional-periodo']
	];

	return saveIngredientesAdicionales(serialize($newArr), $clienteId);
}


function editIngredientesAdicionales($clienteId, $data, $adicionales){
	$adicionales = unserialize($adicionales);
	$total = $data['adicional-costo'] * $data['adicional-numero-productos'];

	$adicionales['total_adicionales'] = $adicionales['total_adicionales'] + $total;

	$totalOld = isset($adicionales['ingredientes'][$data['adicional-id']]) ? $adicionales['ingredientes'][$data['adicional-id']]['total'] : 0;
	$cantidadOld = isset($adicionales['ingredientes'][$data['adicional-id']]) ? $adicionales['ingredientes'][$data['adicional-id']]['cantidad'] : 0;
	$totalIngrediente = $totalOld + $total;
	$cantidadIngrediente = $cantidadOld + $data['adicional-numero-productos'];
	$adicionales['ingredientes'][$data['adicional-id']] = [
		'ingredienteID' => $data['adicional-id'],
		'costo_unitario' => $data['adicional-costo'],
		'total' => $totalIngrediente,
		'cantidad' => $cantidadIngrediente ,
		'periodo' => $data['adicional-periodo']
	];

	return updateIngredientesAdicionales(serialize($adicionales), $clienteId);
}

/**
 * INFORMACION BASE DEL CLIENTE
 */
function getCliente($clienteId){
	$opCliente = getOpcionesCliente($clienteId);

	$newArr = (object) [
		'clineteId' => $clienteId,
		'status' => isset($opCliente->status) ? $opCliente->status : 0,
		'clubId' => isset($opCliente->club_id) ? $opCliente->club_id : '',
		'saldo' => isset($opCliente->saldo) ? $opCliente->saldo : '0.00',
		'suspendido' => isset($opCliente->suspendido) ? $opCliente->suspendido : 0,
		'id_suspencion' => isset($opCliente->id_suspension) ? $opCliente->id_suspension : 0,
		'producto_id' => isset($opCliente->producto_id) ? $opCliente->producto_id : 0,
	];

	return $newArr;
}


function checkStatusCliente(){
	global $current_user;
	global $opCliente;
	$opCliente = getCliente($current_user->ID);
}

/**
 * GUARDA EL CLUB DONDE QUIERE SU CANASTA EL CLIENTE
 */
function saveClubCliente($clubId){
	if ($clubId == '') return false;

	global $current_user;
	$opCliente = getOpcionesCliente($current_user->ID);
	
	if (!empty($opCliente)) {
		getClientUpdateClub($current_user->ID, $clubId);
		updateOpcionesCliente($clubId, $opCliente->producto_id, $opCliente->saldo, $opCliente->costo_semanal_canasta, $current_user->ID);
	}

	wp_redirect( site_url('/mi-cuenta') );
	exit;
}

/**	
 * REGRESA UN ARREGLO CON LOS CLUBES
 * @return [type] [description]
 */
function clubesDeConsumo(){
	$clubes = getClubesDeConsumo();
	$newArr = [];
	if (!empty($clubes)) {
		foreach ($clubes as $key => $club) {
			$capacidad_del_club = get_post_meta($club->ID, 'capacidad-del-club', true);
			$cupo_actual = get_post_meta($club->ID, 'cupo-actual', true); 
            $cupo_actual = $cupo_actual != '' ? $cupo_actual : 0;
            if ($cupo_actual < $capacidad_del_club){
				$newArr[$club->ID] = $club->post_title;
			}
		}
	}

	return $newArr;
}


function getClubAndCanasta(){
	global $opCliente;
	global $clubCanasta;
	if ($opCliente->producto_id != 0) {
		$producto = wp_get_post_parent_id( $opCliente->producto_id );
		$canasta = getIdCanastaClube($opCliente->clubId, $producto);
		$adicionalesId = getIdCanastaAdicionalesClube($opCliente->clubId, $producto);
		$clubCanasta = (object) [
			'producto_id' => $producto,
			'clubId' => $opCliente->clubId,
			'producto_name' => get_the_title($producto),
			'canastaID' => $canasta,
			'ingredientes' => getIngredientesCanasta($canasta),
			'adicionales' => getIngredientesCanasta($adicionalesId),
			'attr_variation' => getCostoVariationID($opCliente->producto_id),
			'adicionalesAgregados' => unserialize(getIngredientesAdicionales($opCliente->clineteId)),
			'suspension' => getSuspensionCanastas($opCliente->clineteId)
		];
	}else{
		$clubCanasta = (object) [];
	}
	
}

/**	
 * REGRESA EL ID DE LA CANASTA A UTILIZAR
 * @param  [int] $clubId   [id del club]
 * @param  [int] $producto [id del producto]
 * @return [int]           [id de canasta]
 */
function getIdCanastaClube($clubId, $producto){
	$clubesCanastaBase = get_option('clubes_usan_canasta_base');

	if (isset($clubesCanastaBase[$clubId])) {
		return '1'.$producto;
	}

	return $clubId.$producto;
}

/**	
 * REGRESA EL ID DE LA AaCTUALIZACION SEGUN LA CANASTA
 * @param  [int] $clubId   [id del club]
 * @param  [int] $producto [id del producto]
 * @return [int]           [id de canasta]
 */
function getIdActualizacionCanasta($clubId, $producto, $actualizasionID){
	$clubesCanastaBase = get_option('clubes_usan_canasta_base');

	if (isset($clubesCanastaBase[$clubId])) {
		return getActualizacionCanastaID('1'.$producto);
	}

	return $actualizasionID;
}

/**
 * REGRESA EL ID DE LOS ADICIONALES DE LA CANASTA
 * @param  [int] $clubId   [id del club]
 * @param  [int] $producto [id del producto]
 * @return [int]           [id adicionales]
 */
function getIdCanastaAdicionalesClube($clubId, $producto){
	$clubesCanastaBase = get_option('clubes_usan_canasta_base');

	if (isset($clubesCanastaBase[$clubId])) {
		return '11';
	}

	return $clubId.'1';
}


/**
 * REGRESA EL COSTO DEL PRODUCTO
 * @param  [int] $variant_id [variant id]
 * @return [type]             [description]
 */
function getCostoVariationID($variant_id){
	$temporalidad = get_post_meta( $variant_id, 'attribute_pa_temporalidad', true );
	$regular_price = get_post_meta( $variant_id, '_regular_price', true );

	$costo = getCostoCanastaTemporalidad($temporalidad, $regular_price);
	return (object) [
		'temporalidad' => $temporalidad,
		'costo' => $regular_price,
		'costoSemanal' => $costo
	];
}

/**
 * SUSPENDER LA CANASTA TEMPORALMENTE
 * @param  [array] $data [data suspencion]
 * @return [type]       [description]
 */
function suspenderCanastaTemporal($data, $clientId){
	extract($data);
	$proximo_viernes = date ("Y-m-d",strtotime("next Friday"));
	$fecha_inicio = date('Y-m-d');

	$fechaProximoCobro = getFechaProximoCobro($proximo_viernes, $suspension);
	$fecha_fin = getFechaFinSuspension($fechaProximoCobro);
	
	$idSuspension = updateSuspensionCanasta($clientId, $suspension, $fecha_inicio, $fecha_fin, $fechaProximoCobro);

	updateSuspensionOpcionesCliente($clientId, $idSuspension);
}

/**	
 * REGRESA LA FECHA PROXIMO COBRO
 * @param  [date] $proximo_viernes [inicio suspencion]
 * @param  [int] $tiempoSuspension      [semans de suspencion]
 * @return [type]                  [description]
 */
function getFechaProximoCobro($proximo_viernes, $tiempoSuspension = 1){
	$fechaCobro = date('Y-m-d',strtotime('+'.$tiempoSuspension.' weeks', strtotime($proximo_viernes)));
	return $fechaCobro;
}

/**	
 * REGRESA LA FECHA FIN DE LA SUSPENCION
 * @param  [date] $proximo_viernes [inicio suspencion]
 * @param  [int] $tiempoSuspension      [semans de suspencion]
 * @return [type]                  [description]
 */
function getFechaFinSuspension($proximo_cobro){
	$fechaFin = date('Y-m-d',strtotime('-1 weeks', strtotime($proximo_cobro)));
	return $fechaFin;
}


/**	
 * REGRESA UN ARREGLO CON LA INFORMACION DE LA SUSPENCION
 * @param  [type] $clineteId [description]
 * @return [type]            [description]
 */
function getSuspensionCanastas($clineteId){
	$suspension = getDataSuspensionActiva($clineteId);
	return (object) [
		'status' => !empty($suspension) ? 1 : 0,
		'temporalidad' => !empty($suspension) ? $suspension->tiempo_suspension : '',
		'fechaSuspension' => !empty($suspension) ? $suspension->fecha_inicio_suspension : '',
		'fechaFin' => !empty($suspension) ? $suspension->fecha_fin_suspension : '',
		'FechaProximoDescuento' =>!empty($suspension) ? $suspension->fecha_proximo_cobro : '',
	];
}


function reanudarCanasta($clienteId){
	updateSuspensionOpcionesCliente($clienteId, 0, 0);
}

/**	
 * COSTO SEMANAL DE LA CANASTA SEGUN LA TEMPORALIDAD
 * @param  [int] $temporalidad [temporalidad de la compra]
 * @param  [int] $costo        [costo de la canasta]
 * @return [int]               [costo semanal de la canasta]
 */
function getCostoCanastaTemporalidad( $temporalidad, $costo ){
	switch ($temporalidad) {
	    case 'mensual':
	        return $costo / 4;
	        break;
	    case 'trimestral':
	        return $costo / 12;
	        break;
	    case 'semestral':
	        return $costo / 24;
	        break;
	    case 'Mensual':
	        return $costo / 4;
	        break;
	    case 'Trimestral':
	        return $costo / 12;
	        break;
	    case 'Semestral':
	        return $costo / 24;
	        break;
	}
}


/**
 * PROXIMO CORTE PARA TODAS LAS CANASRTAS
 * @return [type] [description]
 */
function getProximoCorte(){
	return date("Y-m-d",strtotime("next Friday"));
}


function getClientUpdateClub($clienteId, $club_nuevo){
	$opCliente = getOpcionesCliente($clienteId);

	$club_actual = $opCliente->club_id;

	if ($club_actual == '' ) {
		$cupo_actual = get_post_meta( $club_nuevo, 'cupo-actual', true );
		$crece_a = $cupo_actual + 1;
		update_post_meta($club_nuevo, 'cupo-actual', $crece_a);
	}elseif($club_actual != $club_nuevo){
		
		$cupo_actual = get_post_meta( $club_actual, 'cupo-actual', true );
		$disminuye_a = $cupo_actual - 1;
		update_post_meta($club_actual, 'cupo-actual', $disminuye_a);

		$cupo_nuevo = get_post_meta( $club_nuevo, 'cupo-actual', true );
		$crece_a = $cupo_nuevo + 1;
		update_post_meta($club_nuevo, 'cupo-actual', $crece_a);

	}

}
