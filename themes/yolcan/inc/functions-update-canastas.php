<?php /**
 * Pasos a realizar en el update de la canasta
 * El update debe de ejecutar esta función los viernes a las 09:00hrs
 *
 * 1.- Descontar saldo a los clientes de su proxima canasta
 * 2.- Guardar la canasta descontada al cliente y sus adicionales
 * 3.- Generar nueva actualizacion de canastas para el historial
 * 4.- Desactivar suspensiones qeu vensan en la fecha del update
 */

// add_action('get_header', function() {
// 	// getClientUpdate();
// });

/**
 * UPDATE CANASTAS
 * @return [type] [description]
 */
function getClientUpdate(){
	descontarSaldoClientes();
	// cambioStatusSuspenciones();
}


/**
 * DESCONTAR SALDO A LOS CLIENTES ACTIVOS.
 * @return [type] [description]
 */
function descontarSaldoClientes(){
	$clientes = getClientesActivos();
	
	if (!empty($clientes)) {
		foreach ($clientes as $key => $cliente) {
			echo '<pre>';
			print_r($cliente);
			echo '</pre>';
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
	$arr = [
		'cliente_id' => $cliente->cliente_id,
		'saldo_anterior' => $cliente->saldo,
		'costo_canasta' => $variacion->costoSemanal,
		'variation_id' => $cliente->producto_id,
		'club_id' => $cliente->club_id,
		'adicionales' => serialize($adicionales),
		'fecha_corte' => date('Y-m-d')
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