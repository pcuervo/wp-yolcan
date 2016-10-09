<?php
class RestaurantesController {

	public $dataPost;
	public $dataGet;
	public $restauranteId;
	public $modelRestaurantes;

	function __construct() {
        $this->dataPost = !empty($_POST) ? $_POST : [];
        $this->dataGet = !empty($_GET) ? $_GET : [];
        $this->restauranteId = isset($_GET['id_restaurante']) ? $_GET['id_restaurante'] : 0;
        $this->modelRestaurantes = modelRestaurantes('RestaurantesModel');
    }

	static function index($method, $name_menu, $slug_page)
	{
		$clientes = new RestaurantesController;

		if ($slug_page == 'restaurantes_activos'){
			add_menu_page( $name_menu, $name_menu, 'edit_pages', $slug_page, array($clientes, $method), '', 13 );
		}else{
			add_submenu_page('restaurantes_activos', $name_menu, $name_menu, 'edit_pages', $slug_page, array($clientes, $method));          
		}
	}


	/**	
	 * MUESTRA RESTAURANTES ACTIVOS
	 * @return [type] [description]
	 */
	public function activos()
	{
		// $clinetes = $this->modelClientes->getClientesActivos($this->club);
		$restaurantes = [];

		return viewRestaurantes('show', [
			'restaurantes' => $restaurantes,
			'total' => count($restaurantes)
		]);
	}


}