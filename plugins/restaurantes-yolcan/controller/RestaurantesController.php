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
		$restaurantes_m = new RestaurantesController;

		if ($slug_page == 'restaurantes_activos'){
			add_menu_page( $name_menu, $name_menu, 'edit_pages', $slug_page, array($restaurantes_m, $method), '', 13 );
		}else{
			add_submenu_page('restaurantes_activos', $name_menu, $name_menu, 'edit_pages', $slug_page, array($restaurantes_m, $method));          
		}
	}


	/**	
	 * MUESTRA RESTAURANTES ACTIVOS
	 * @return [type] [description]
	 */
	public function activos()
	{
		$restaurantes = $this->modelRestaurantes->getActivos();

		return viewRestaurantes('show', [
			'restaurantes' => $restaurantes,
			'total' => count($restaurantes)
		]);
	}


	/**	
	 * MUESTRA RESTAURANTES NO ACTIVOS
	 * @return [type] [description]
	 */
	public function noActivos()
	{
		$restaurantes = $this->modelRestaurantes->getInactivos();
		return viewRestaurantes('no-activos', [
			'restaurantes' => $restaurantes,
			'total' => count($restaurantes)
		]);
	}

	/**	
	 * MUESTRA EL RESTAURANTE
	 * @return [type] [description]
	 */
	public function restaurante()
	{
		return viewRestaurantes('restaurante', [
			'restauranteId' => $this->restauranteId,
			'restaurante' => $this->modelRestaurantes->getDataRestauranteById($this->restauranteId),
			'historySaldo' => $this->modelRestaurantes->getHistorySaldoRestauranteById($this->restauranteId)
		]);
	}


}