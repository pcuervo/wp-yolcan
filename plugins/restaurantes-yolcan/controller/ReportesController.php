<?php
class ReportesController {

	public $dataPost;
	public $dataGet;
	public $restauranteId;
	public $modelRestaurantes;
	public $compraId;

	function __construct() {
        $this->dataPost = !empty($_POST) ? $_POST : [];
        $this->dataGet = !empty($_GET) ? $_GET : [];
        $this->restauranteId = isset($_GET['id_restaurante']) ? $_GET['id_restaurante'] : 0;
        $this->compraId = isset($_GET['id_compra']) ? $_GET['id_compra'] : 0;

        $this->modelRestaurantes = modelRestaurantes('RestaurantesModel');
    }

    static function index($method, $name_menu, $slug_page)
	{
		$restaurantes_m = new ReportesController;
		add_submenu_page('restaurantes_activos', $name_menu, $name_menu, 'edit_pages', $slug_page, array($restaurantes_m, $method));          
	}

	/**	
	 * MUESTRA RESTAURANTES ACTIVOS
	 * @return [type] [description]
	 */
	public function reporteDiario()
	{
		return viewRestaurantes('reportes/diario', [
			'search' => isset($this->dataGet['reporteDiario']) ? 'si' : 'no',
			'results' => isset($this->dataGet['resporte_del']) ? $this->modelRestaurantes->getComprasRestaurantes($this->dataGet['resporte_del']) : [],
			'date' => isset($this->dataGet['resporte_del']) ? $this->dataGet['resporte_del'] : '',
		]);
	}

}