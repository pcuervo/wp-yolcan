<?php 
/**
 * MUESTRA UNA VISTA
 */
function view($view, $array=array()){
	global $errores;
	global $mesage_error;

	$view = ($errores != 1) ? $view : 'errors';
	
	extract($array);
	if (file_exists(PATH_CANASTA.'/views/'.$view.'.php')):
		include_once(PATH_CANASTA.'/views/'.$view.'.php');
	endif;
}

/**
 * ABRE UN MODELO ESPECIFICADO
 */
function model($model = ''){
	if ($model != ''):
		$file_exist = file_exists(PATH_CANASTA.'/models/'.$model.'.php');

		if(! class_exists($model, FALSE) AND $file_exist):
			require_once(PATH_CANASTA.'/models/'.$model.'.php');
		endif;

		if (class_exists($model, FALSE)):
			$class = new $model();
			return $class;
		else:
			show_error('El modelo solicitado en  models/'.$model.'.php no existe : '.$model);
		endif;
	else:
		show_error('No se encontro el archivo solicitado : models/'.$model.'.php');
	endif;
}

/**
 * Error Handler
 */
function show_error($message, $status_code = 500)
{
	global $errores;
	global $mesage_error;
	$mesage_error[] = $message;
	$errores = 1;
	return;
}

/**
 * EDITA EL FORMATO DE LA FECHA
 */
function getDateTransformUpdate($fecha){
	$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo');
	$dias_recortados = array('Lun','Mar','Mie','Jue','Vie','Sab','Dom');

	$dia_name = $dias[date('N', strtotime($fecha)) - 1];
	$dia_recortado = $dias_recortados[date('N', strtotime($fecha)) - 1];
	$fecha = explode('-', $fecha);
	$mes = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' =>'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

	return array($fecha[2], $mes[$fecha[1]], $fecha[0], $dia_name, $fecha[1], $dia_recortado);
}


/**
 * EDITA EL FORMATO DE LA FECHA
 */
function getDateTransformFormat($fecha){
	$fecha = date("Y-m-d", strtotime($fecha));
	$date = getDateTransformUpdate($fecha);

	return $date[3].', '.$date[0].' de '.$date[1].' del '.$date[2];
}

/**
 * AGRUPA LAS CANASTAS DE LA ACTUALIZACION
 */
function getGroupCanastas($ingredientes){
	if (!empty($ingredientes)) {
		$arrNew = [];
		$arrNew['actualizacion'] = $ingredientes[0];
		foreach ($ingredientes as $key => $ingrediente) {
			$arrNew['canastas'][$ingrediente->canasta_id][$ingrediente->ingrediente_id] = $ingrediente;
		}
		return $arrNew;
	}else{
		return [];
	}
}

/**
 * PRODUCTO ADICIONALES
 * @return [type] [description]
 */
function getObjetAdicionales(){
	$adicional = [];
	$adicional[] = (object) [
	    'ID' => 1,
	    'post_title' => 'Adicionales',
	 ];
	return $adicional;
}


/**
 * REGRESA LA FECHA PARA APLICAR LA CANASTA
 * @param  [type] $historia->fecha_creacion [description]
 * @return [type]                           [description]
 */
function getCorteCanasta($fecha_creacion){
	$dia = date('w',strtotime($fecha_creacion));
	$proximo_viernes=date ("Y-m-d",strtotime("next Friday", strtotime($fecha_creacion)));
	
	return getDateTransformFormat($proximo_viernes);
}
