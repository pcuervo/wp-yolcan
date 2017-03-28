<?php
class ReportesCanastasController 
{
	public $modelIngredientes;
	public $idClub;
	public $dataPost;
	public $dataGet;


	function __construct() {
	    $this->modelIngredientes = model('IngredientesModel');
        $this->idClub = isset($_GET['id_club']) ? $_GET['id_club'] : 0;
        $this->dataPost = !empty($_POST) ? $_POST : [];
        $this->dataGet = !empty($_GET) ? $_GET : [];

    }

	static function index($method, $name_menu, $slug_page)
	{
		$reportes = new ReportesCanastasController;
		add_submenu_page('canasta', $name_menu, $name_menu, 'edit_pages', $slug_page, array($reportes, $method));
	}

	/**
	 * GENERATE REPORTS
	 * @return [type] [description]
	 */
	public function reportes()
	{
		return view('reportes/form', [
			'clubes' => CanastaModel::clubes(),
			'canastas' => CanastaModel::getCanastas()
		]);
	}

	/**
	 * RESULT REPORT CANASTAS
	 */
	public function reporteCanastas()
	{
		$mCanasta = model('CanastaModel');
		$results = $mCanasta->getReport($this->dataGet);
		echo '<pre>';
		print_r($results);
		echo '</pre>';
	}
}