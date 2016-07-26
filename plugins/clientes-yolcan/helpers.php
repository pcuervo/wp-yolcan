<?php 
/**
 * MUESTRA UNA VISTA
 */
function viewCliente($view, $array=array()){
	global $errores;
	global $mesage_error;

	$view = ($errores != 1) ? $view : 'errors';
	
	extract($array);
	if (file_exists(PATH_CLIENTES.'/views/'.$view.'.php')):
		include_once(PATH_CLIENTES.'/views/'.$view.'.php');
	endif;
}

/**
 * ABRE UN MODELO ESPECIFICADO
 */
function modelCliente($model = ''){
	if ($model != ''):
		$file_exist = file_exists(PATH_CLIENTES.'/models/'.$model.'.php');

		if(! class_exists($model, FALSE) AND $file_exist):
			require_once(PATH_CLIENTES.'/models/'.$model.'.php');
		endif;

		if (class_exists($model, FALSE)):
			$class = new $model();
			return $class;
		else:
			show_error_cliente('El modelo solicitado en  models/'.$model.'.php no existe : '.$model);
		endif;
	else:
		show_error_cliente('No se encontro el archivo solicitado : models/'.$model.'.php');
	endif;
}

/**
 * Error Handler
 */
function show_error_cliente($message, $status_code = 500)
{
	global $errores;
	global $mesage_error;
	$mesage_error[] = $message;
	$errores = 1;
	return;
}

// Crea roles de usuario ////////////////////////////////////////////////////////

function yolcan_roles() {
	$rol_cliente = add_role(
    'cliente',
    __( 'Cliente' ),
    array(
        'read'         => false,
        'edit_posts'   => false,
        'delete_posts' => false,
        'edit_others_posts' => false
    )
	);
	if ( null !== $rol_cliente ) {
	    echo 'Cliente role created.';
	}
	else {
	    echo 'Cliente role already exists.';
	}
	
}

register_activation_hook( __FILE__, 'yolcan_roles' );