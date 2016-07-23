<?php global $opCliente;
global $clubCanasta;
global $procesoRegistro;
add_action('get_header', function() {
	if(isset($_POST['action']) AND $_POST['action'] == 'delete-aditional') deleteIngredienteAdicional($_POST);
	if(isset($_POST['action']) AND $_POST['action'] == 'save-additional-ingredient') setIngredienteAdicional($_POST);
	if(is_page('mi-cuenta') AND isset($_POST['club'])) saveClubCliente($_POST['club']);
	if(is_page('mi-cuenta')) checkStatusCliente();
	if(is_page('mi-cuenta')) getClubAndCanasta();
	getClientDescountPoints();
});

if(isset($_POST['action']) AND $_POST['action'] == 'create-client') setNuevoCliente($_POST);


function setNuevoCliente($data){
	global $procesoRegistro;
	extract($data);
	$user_id = username_exists( $emailCliente );
	if ( !$user_id and email_exists($emailCliente) == false ) {
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		$user_id = wp_create_user( $nombreCliente, $passwordCliente, $emailCliente );
		if(!is_wp_error($user_id)){
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
		'id_suspencion' => isset($opCliente->id_suspencion) ? $opCliente->id_suspencion : 0,
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
		updateOpcionesCliente($clubId, $opCliente->producto_id, $opCliente->saldo, $current_user->ID);
	}else{
		setOpcionesCliente($clubId, 0, 0.00,$current_user->ID);
	}
	return true;
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
			$newArr[$club->ID] = $club->post_title;
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
			'adicionalesAgregados' => unserialize(getIngredientesAdicionales($opCliente->clineteId))
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
	$var = new WC_Product_Variation($variant_id);
	$attr = $var->get_variation_attributes();
	$costo = getCostoCanastaTemporalidad($attr['attribute_pa_temporalidad'], $var->regular_price);
	return (object) [
		'temporalidad' => $attr['attribute_pa_temporalidad'],
		'costo' => $var->regular_price,
		'costoSemanal' => $costo
	];
}


/**	
 * COSTO SEMANAL DE LA CANASTA SEGUN LA TEMPORALIDAD
 * @param  [int] $temporalidad [temporalidad de la compra]
 * @param  [int] $costo        [costo de la canasta]
 * @return [int]               [costo semanal de la canasta]
 */
function getCostoCanastaTemporalidad($temporalidad, $costo){
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
 * UPDATE POINTS CLIENT
 * @return [type] [description]
 */
function getClientDescountPoints(){

}