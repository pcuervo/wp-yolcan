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
		$results = isset($this->dataGet['resporte_del']) ? $this->modelRestaurantes->getComprasRestaurantes($this->dataGet['resporte_del']) : [];

		if (isset($this->dataGet['generate']) AND $this->dataGet['generate'] == 'pdf') {
			$this->generaPdfReporteDiario($this->dataGet['resporte_del'], $results);
		}

		return viewRestaurantes('reportes/diario', [
			'search' => isset($this->dataGet['reporteDiario']) ? 'si' : 'no',
			'results' => $results,
			'date' => isset($this->dataGet['resporte_del']) ? $this->dataGet['resporte_del'] : '',
		]);
	}

	/**
	 * GENERA EL PDF DEL REPORTE DIARIO
	 */
	public function generaPdfReporteDiario($resporte_del, $results)
	{
		require_once(PATH_RESTAURANTES."/inc/dompdf/dompdf_config.inc.php");

		ob_start();
		include PATH_RESTAURANTES.'/views/reportes/htmlPdfDiario.php';

	  	$html = ob_get_clean();
		// echo $html;
		$mipdf = new DOMPDF();
		 
		$mipdf->set_paper("A4", "portrait");
		 
		$mipdf->load_html( utf8_decode( utf8_encode($html) ) );
		 
		$mipdf->render();

		header('Content-type: application/pdf');
		
		$mipdf->stream('reporteDiarioRestaurantes-'.$resporte_del.'pdf', array("Attachment" => 0) );
		echo $mipdf->output();
	}

}