<?php global $opCliente;
add_action('get_header', function() {
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