<?php /**
 * Pasos a realizar en el update de la canasta
 * El update debe de ejecutar esta función los viernes a las 09:00hrs
 *
 * 1.- Descontar saldo a los clientes de su proxima canasta
 * 2.- Guardar la canasta descontada al cliente y sus adicionales
 * 3.- Generar nueva actualizacion de canastas para el historial
 * 4.- Desactivar suspensiones qeu vensan en la fecha del update
 */

/**
 * UPDATE CANASTAS
 * @return [type] [description]
 */
function getClientUpdate(){
	descontarSaldoClientes();
	nuevasCanastasSemanales();
	cambioStatusSuspenciones();
}


/**
 * DESCONTAR SALDO A LOS CLIENTES ACTIVOS.
 * @return [type] [description]
 */
function descontarSaldoClientes(){
	$clientes = getClientesActivos();
	
	if (!empty($clientes)) {
		foreach ($clientes as $key => $cliente) {
			$variacion = getCostoVariationID($cliente->producto_id);
			$adicionales = unserialize(getIngredientesAdicionales($cliente->cliente_id));

			$porCobrar = $variacion->costoSemanal + $adicionales['total_adicionales'];
			$saldoFinal = $cliente->saldo - $porCobrar;
			if($porCobrar <= $cliente->saldo){
				updateSaldoCliente($cliente->cliente_id, $saldoFinal);
				storeCanastaAlCorteCliente($cliente, $variacion, $adicionales);
			}
		}
	}
}


function storeCanastaAlCorteCliente($cliente, $variacion, $adicionales){
	$actualizacionID = getActualizacionCanasta($cliente->club_id);
	$producto = wp_get_post_parent_id( $cliente->producto_id );
	$canasta = getIdCanastaClube($cliente->club_id, $producto);
	$actualizacionId = getIdActualizacionCanasta($cliente->club_id, $producto, $actualizacionID);
	$arr = [
		'cliente_id' => $cliente->cliente_id,
		'saldo_anterior' => $cliente->saldo,
		'costo_canasta' => $variacion->costoSemanal,
		'variation_id' => $cliente->producto_id,
		'club_id' => $cliente->club_id,
		'adicionales' => serialize($adicionales),
		'fecha_corte' => date('Y-m-d'),
		'actualizacion_id' => $actualizacionId,
		'canasta_id' => $canasta
	];

	saveCanastaAlCorteCliente($arr);
	destroyAdicionalesCliente($cliente->cliente_id, $adicionales);
}


function destroyAdicionalesCliente($clienteId, $adicionales){
	$ingredientes = $adicionales['ingredientes'];
	$total = 0;
	if (! empty($ingredientes)) {
		foreach ($ingredientes as $key => $ingrediente) {
			if ($ingrediente['periodo'] == 'Sólo esta ocación') {
				unset($adicionales['ingredientes'][$ingrediente['ingredienteID']]);
			}else{
				$total = $total + $ingrediente['total'];
			}
		}
		$adicionales['total_adicionales'] = $total;
	}

	updateIngredientesAdicionales(serialize($adicionales), $clienteId);
}

/**
 * CANBIA EL STATUS DE LOS CLIENTES QUE PUEDEN VOLVER A COMPRAR
 * @return [type] [description]
 */
function cambioStatusSuspenciones(){
	// para test puede pasar como parametro una fecha
	$clientes = getClientesDesactivarSuspension();
	if (!empty($clientes)) {
		foreach ($clientes as $key => $cliente) {
			updateSuspensionOpcionesCliente($cliente->cliente_id, 0, 0);
		}
	}
}


function nuevasCanastasSemanales(){
	$canastas =  method_exists("CanastaModel", "canastasActivas") ? CanastaModel::canastasActivas() : [];
	$canastas = canastasPorClub($canastas);
	if ( method_exists("CanastaModel", "desactivarCanastas") ) CanastaModel::desactivarCanastas();
	
	$clubes = method_exists("CanastaModel", "clubes") ? CanastaModel::clubes() : [];

	if (!empty($clubes) AND method_exists("CanastaModel", "storeCanasta")) {
		$canasta = new CanastaModel;
		$modelIngredientes = function_exists('model') ? model('IngredientesModel') : [];
		
		foreach ($clubes as $key => $club) {
			
			$actualizacionId = $canasta->storeCanasta($club->ID, 1, '0000-00-00');
			if(isset($canastas[$club->ID]) AND method_exists("IngredientesModel", "storeIngredienteCanasta")){
			
				foreach ($canastas[$club->ID] as $key => $ingrediente) {
					$canastaID = $ingrediente->canasta_id;
					$ingredienteId = $ingrediente->ingrediente_id;
					$cantidad = $ingrediente->cantidad;
					$modelIngredientes->storeIngredienteCanasta($canastaID, $actualizacionId, $ingredienteId, $cantidad);
				}

			}
			
		}

		$actualizacionId = $canasta->storeCanasta(1, 1, '0000-00-00');
		if(isset($canastas[1]) AND method_exists("IngredientesModel", "storeIngredienteCanasta")){
			
			foreach ($canastas[1] as $key => $ingrediente) {
				$canastaID = $ingrediente->canasta_id;
				$ingredienteId = $ingrediente->ingrediente_id;
				$cantidad = $ingrediente->cantidad;
				$modelIngredientes->storeIngredienteCanasta($canastaID, $actualizacionId, $ingredienteId, $cantidad);
			}

		}

	}
}


/**	
 * ORGANIZA LAS CANASTAS POR CLUB
 * @param  [object] $canastas [todas las canastas]
 * @return [type]           [description]
 */
function canastasPorClub($canastas){
	$newArr = [];
	if (!empty($canastas)) {
		foreach ($canastas as $key => $canasta) {
			$newArr[$canasta->club_id][] = $canasta;
		}
	}
	return $newArr;
}