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

		$ventas = $this->getGroupResults($results);

		if (isset($this->dataGet['generate']) AND $this->dataGet['generate'] == 'pdf') {
			$this->generaPdf($this->dataGet, $ventas);
		}
		
		return view('reportes/index', [
			'data' => $this->dataGet,
			'ventas' => $ventas
		]);
	}

	private function getGroupResults($results)
	{
		$newArr = [];
		if (!empty($results)) {
			foreach ($results as $key => $result) {
				$newArr[$result->club_id][$result->canasta_id_real][] = $result;
			}
		}

		return $newArr;
	}

	/**
	 * GENERA EL PDF DEL REPORTE DIARIO
	 */
	public function generaPdf($data, $ventas)
	{
		if (!class_exists('DOMPDF')) {
			require_once(PATH_CANASTA."/inc/dompdf/dompdf_config.inc.php");
		}

		ob_start();
		include PATH_CANASTA.'/views/reportes/htmlPdf.php';

	  	$html = ob_get_clean();
		// echo $html;
		$mipdf = new DOMPDF();
		 
		$mipdf->set_paper("A4", "portrait");
		 
		$mipdf->load_html( utf8_decode( utf8_encode($html) ) );
		 
		$mipdf->render();

		header('Content-type: application/pdf');

		$mipdf->stream('reporteVentasClientes-'.date('Y-m-d').'.pdf', array("Attachment" => 0) );
		echo $mipdf->output();
	}
}