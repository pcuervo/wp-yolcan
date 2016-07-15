<?php
class CanastaController {

	public $actualizacion;
	public $model_ingredientes;
	public $idClube;


	function __construct() {
	    $this->model_ingredientes = model('IngredientesModel');
        $this->actualizacion = $this->model_ingredientes->getUltimaActualizacion();
        $this->idClube = isset($_GET['id_club']) ? $_GET['id_club'] : 0;
    }

	static function index($method, $name_menu, $slug_page)
	{
		$canasta = new CanastaController;

		if ($slug_page == 'canasta'){
			add_menu_page( $name_menu, $name_menu, 'edit_pages', $slug_page, array($canasta, $method), '', 13 );
		}else{
			add_submenu_page('canasta', $name_menu, $name_menu, 'edit_pages', $slug_page, array($canasta, $method));          
		}
	}
        
 //    static function ingrediente($method, $name_menu, $slug_page)
 //    {		
 //    	$ingrediente = new CanastaController;
 //        add_submenu_page('canasta', $name_menu, $name_menu, 'edit_pages', $slug_page, array($ingrediente, $method));               
	// }
        
 //    static function agregar_ingrediente($method, $name_menu, $slug_page){
	// 	$agregaringrediente = new CanastaController;
	// 	add_submenu_page('canasta', $name_menu, $name_menu, 'edit_pages', $slug_page, array($agregaringrediente, $method));    
	// }
        

	/**	
	 * MUESTRA LOS CLUBS PARA VER SUS CANASTAS
	 * @return [type] [description]
	 */
	public function canasta()
	{
		return view('show', [
			'clubes' => CanastaModel::clubes()
		]);
	}

	/**
	 * [canastasClube description]
	 * @return [type] [description]
	 */
	public function canastasClube()
	{
		$productos = model('ProductosModel');

		return view('canastas-club', [
			'idClube' => $this->idClube,
			'productos' => $productos->productos()
		]);
	}

	// /**	
	//  * VISTA PARA EDITAR
	//  * @return [type] [description]
	//  */
	// public function edit()
	// {
	// 	$page = getClubeProductoPage($_GET['page']);

	// 	if (! empty($_POST)) $this->model_ingredientes->setIngredientesCanasta($_POST);

	// 	$data = $this->getCanasta();
	// 	$data['ingredientes'] = $this->model_ingredientes->getIngredientes();
	// 	$data['nombre_canasta'] = $page['nombre_canasta'];
	// 	$data['id_canasta'] = $page['id_canasta'];

	// 	return view('edit', $data);
	// }

	// /**
	//  * ACTUALIZA EL INDEX DEL ARREGLO POR EL ID DEL INGREDIENTE
	//  * @param  [object] $ingredientes [ingredientes de la ultima actualización]
	//  * @return [object]               [ingredientes]
	//  */
	// public function getActualizaIndexIngredientes($ingredientes)
	// {
	// 	$new_array = array();
	// 	if (! empty($ingredientes)) {
	// 		foreach ($ingredientes as $key => $ingrediente) {
	// 			$new_array[$ingrediente->ingrediente_id] = $ingrediente;
	// 		}
	// 	}

	// 	return $new_array;
	// }

	// /**
	//  * REGRESA LA ACTUALIZACIÓN COMPLETA DE LA CANASTA
	//  * @return [array] [actualización canasta]
	//  */
	// public function getCanasta()
	// {
	// 	$ultimos_ingredientes = ! empty($this->actualizacion) ? $this->model_ingredientes->getIngredientesCanasta($this->actualizacion->id) : array();
	// 	return array(
	// 		'actualizacion_canasta' => ! empty($this->actualizacion) ? $this->actualizacion  : array(),
	// 		'ingredientes_canasta' => $this->getActualizaIndexIngredientes($ultimos_ingredientes)
	// 	);
	// }

	// /**	
	//  * REGRESA LA CANASTA COMPLETA ACTUAL
	//  * @return [type] [description]
	//  */
	// public function getCanastaCompleta()
	// {
	// 	return $this->model_ingredientes->getIngredientesCanasta($this->actualizacion->id, 'completa');
	// }

	// /**	
	//  * REGRESA LA MEDIA CANASTA ACTUAL
	//  * @return [type] [description]
	//  */
	// public function getMediaCanasta()
	// {
	// 	return $this->model_ingredientes->getIngredientesCanasta($this->actualizacion->id, 'media');
	// }

	// /**	
	//  * REGRESA INGREDIENTES ADICIONALES
	//  * @return [type] [description]
	//  */
	// public function getIngredientesAdicionales()
	// {
	// 	return $this->model_ingredientes->getIngredientesCanasta($this->actualizacion->id, 'adicionales');
	// }

}