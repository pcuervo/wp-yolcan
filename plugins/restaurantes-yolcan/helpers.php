<?php 
/**
 * MUESTRA UNA VISTA
 */
function viewRestaurantes($view, $array=array()){
	global $errores;
	global $mesage_error;

	$view = ($errores != 1) ? $view : 'errors';
	
	extract($array);
	if (file_exists(PATH_RESTAURANTES.'/views/'.$view.'.php')):
		include_once(PATH_RESTAURANTES.'/views/'.$view.'.php');
	endif;
}

/**
 * ABRE UN MODELO ESPECIFICADO
 */
function modelRestaurantes($model = ''){
	if ($model != ''):
		$file_exist = file_exists(PATH_RESTAURANTES.'/models/'.$model.'.php');

		if(! class_exists($model, FALSE) AND $file_exist):
			require_once(PATH_RESTAURANTES.'/models/'.$model.'.php');
		endif;

		if (class_exists($model, FALSE)):
			$class = new $model();
			return $class;
		else:
			show_error_restaurante('El modelo solicitado en  models/'.$model.'.php no existe : '.$model);
		endif;
	else:
		show_error_restaurante('No se encontro el archivo solicitado : models/'.$model.'.php');
	endif;
}

/**
 * Error Handler
 */
function show_error_restaurante($message, $status_code = 500)
{
	global $errores;
	global $mesage_error;
	$mesage_error[] = $message;
	$errores = 1;
	return;
}