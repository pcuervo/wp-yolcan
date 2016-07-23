<?php 
/**
 * Pasos a realizar en el update de la canasta
 * El update debe de ejecutar esta función los viernes a las 09:00hrs
 *
 * 1.- Descontar saldo a los clientes de su proxima canasta
 * 2.- Guardar la canasta descontada al cliente y sus adicionales
 * 3.- Generar nueva actualizacion de canastas para el historial
 * 4.- Desactivar suspensiones qeu vensan en la fecha del update
 */

// add_action('init', 'getClientUpdate');
// getClientUpdate();

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
			$variacion = getCostoVariationID($cliente->producto_id);
			$adicionales = unserialize(getIngredientesAdicionales($cliente->cliente_id));

			$porCobrar = $variacion->costoSemanal + $adicionales['total_adicionales'];
			$saldoFinal = $cliente->saldo - $porCobrar;
			if($porCobrar <= $cliente->saldo AND $key == 0){
				updateSaldoCliente($cliente->cliente_id, $saldoFinal);	
			}
		}
	}
}

/**
 * CANBIA EL STATUS DE LOS CLIENTES QUE PUEDEN VOLVER A COMPRAR
 * @return [type] [description]
 */
function cambioStatusSuspenciones(){
	$clientes = getClientesDesactivarSuspension();
	if (!empty($clientes)) {
		foreach ($clientes as $key => $cliente) {
			updateSuspensionOpcionesCliente($cliente->cliente_id, 0, 0);
		}
	}
}