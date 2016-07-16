<?php
class CanastaController {

	public $actualizacion;
	public $modelIngredientes;
	public $idClub;
	public $dataPost;


	function __construct() {
	    $this->modelIngredientes = model('IngredientesModel');
        $this->idClub = isset($_GET['id_club']) ? $_GET['id_club'] : 0;
        $this->dataPost = !empty($_POST) ? $_POST : array();
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
		$mCanasta = model('CanastaModel');
		$canastasActivas = getGroupCanastas($mCanasta->getCanastasClub($this->idClub));
		$canastasProgramadas = getGroupCanastas($mCanasta->getCanastasClub($this->idClub, 2));
		
		return view('canastas-club', [
			'idClub' => $this->idClub,
			'productos' => $productos->productos(),
			'canastasActivas' => $canastasActivas,
			'canastasProgramadas' => $canastasProgramadas
		]);
	}

	/**
	 * EDITCANASTA BASE 
	 * @return [type] [description]
	 */
	public function editCanastas()
	{
		// if (! empty($_POST)) $this->setCanastas($_POST);
		
		// $productos = model('ProductosModel');
		// return view('editar-canasta', [
		// 	'ingredientes' => $this->modelIngredientes->getIngredientes(),
		// 	'idClub' => $this->idClub,
		// 	'productos' => $productos->productos()
		// ]);
	}

	/**	
	 * CREAR CANASTA
	 * @return [type] [description]
	 */
	public function createCanastas()
	{
		$productos = model('ProductosModel');

		return view('editar-canasta', [
			'titulo' => 'Crear canastas',
			'idClub' => $this->idClub,
			'ingredientes' => $this->modelIngredientes->getIngredientes(),
			'productos' => $productos->productos(),
			'action' => 'store'
		]);
	}

	/**
	 * GUARDA LAS CANASTAS
	 * @return [type] [description]
	 */
	public function storeCanastas()
	{
		$mCanasta = model('CanastaModel');
		$idActualizacion = $mCanasta->storeCanasta($this->idClub, 1);
		if ($this->dataPost['type'] == 'base') { }

		if (!empty($this->dataPost['ingredientes_canastas'])) {
			foreach ($this->dataPost['ingredientes_canastas'] as $idCanasta => $canasta) {
				$this->updateIngredientesCanasta($idCanasta, $canasta, 'no', $idActualizacion);
			}
		}
		$urlRedirect = admin_url().'admin.php?page=canastas_club&id_club='.$this->idClub;
		wp_redirect($urlRedirect);
	}

	/**
	 * GUARDA LA ACTUALIZACION DE LA CANASTA
	 * @param  [type] $_POST [description]
	 * @return [type]        [description]
	 */
	private function setCanastas($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		// $mCanasta = model('CanastaModel');
		// $actualizacion = isset($data['actualizacion']) ? 'si' : 'no'; 
		// if ($data['type'] == 'base') { }

		// if (!empty($data['ingredientes_canastas'])) {
		// 	foreach ($data['ingredientes_canastas'] as $idCanasta => $canasta) {
		// 		$this->updateIngredientesCanasta($idCanasta, $canasta, $actualizacion, $data['idActualizacion']);
		// 	}
		// }
	}


	private function updateIngredientesCanasta($idCanasta, $canasta, $actualizacion, $idActualizacion)
	{
		$mCanasta = model('CanastaModel');
		if (!empty($canasta)) {
			if ($actualizacion == 'si') $mCanasta->destroyIngredientesCanasta($idCanasta);
			
			foreach ($canasta as $key => $ingrediente) {
				$this->modelIngredientes->storeIngredienteCanasta($idCanasta, $idActualizacion, $ingrediente);
			}
		}

		return true;
	}


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

	/**
	 * REGRESA LA ACTUALIZACIÓN COMPLETA DE LA CANASTA
	 * @return [array] [actualización canasta]
	 */
	public function getCanasta($idActualizacion)
	{
		$ultimosIngredientes = ! empty($this->actualizacion) ? $this->modelIngredientes->getIngredientesCanasta($idActualizacion) : array();
		return array(
			'actualizacion_canasta' => ! empty($this->actualizacion) ? $this->actualizacion  : array(),
			'ingredientes_canasta' => $this->getActualizaIndexIngredientes($ultimos_ingredientes)
		);
	}

	// /**	
	//  * REGRESA LA CANASTA COMPLETA ACTUAL
	//  * @return [type] [description]
	//  */
	// public function getCanastaCompleta()
	// {
	// 	return $this->modelIngredientes->getIngredientesCanasta($this->actualizacion->id, 'completa');
	// }

	// /**	
	//  * REGRESA LA MEDIA CANASTA ACTUAL
	//  * @return [type] [description]
	//  */
	// public function getMediaCanasta()
	// {
	// 	return $this->modelIngredientes->getIngredientesCanasta($this->actualizacion->id, 'media');
	// }

	// /**	
	//  * REGRESA INGREDIENTES ADICIONALES
	//  * @return [type] [description]
	//  */
	// public function getIngredientesAdicionales()
	// {
	// 	return $this->modelIngredientes->getIngredientesCanasta($this->actualizacion->id, 'adicionales');
	// }

}