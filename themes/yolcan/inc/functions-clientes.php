<?php global $opCliente;
add_action('get_header', function() {
	if (is_page('mi-cuenta') AND isset($_POST['club'])) saveClubCliente($_POST['club']);
	if (is_page('mi-cuenta')) checkStatusCliente();

});

function getCliente($clienteId){
	$opCliente = getOpcionesCliente($clienteId);

	$newArr = (object) [
		'status' => isset($opCliente->status) ? $opCliente->status : 0,
		'clubId' => isset($opCliente->club_id) ? $opCliente->club_id : '',
		'saldo' => isset($opCliente->saldo) ? $opCliente->saldo : '0.00',
		'suspendido' => isset($opCliente->suspendido) ? $opCliente->suspendido : 0,
		'id_suspencion' => isset($opCliente->id_suspencion) ? $opCliente->id_suspencion : 0
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
	setClubCliente($clubId, $current_user->ID);
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