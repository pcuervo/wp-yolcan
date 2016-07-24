<?php
class ClientesController {

	public $dataPost;
	public $club;
	public $modelClientes;

	function __construct() {
        $this->dataPost = !empty($_POST) ? $_POST : array();
        $this->club = isset($_GET['club']) ? $_GET['club'] : 0;
        $this->modelClientes = modelCliente('ClientesModel');
    }

	static function index($method, $name_menu, $slug_page)
	{
		$clientes = new ClientesController;

		if ($slug_page == 'activos'){
			add_menu_page( $name_menu, $name_menu, 'edit_pages', $slug_page, array($clientes, $method), '', 13 );
		}else{
			add_submenu_page('activos', $name_menu, $name_menu, 'edit_pages', $slug_page, array($clientes, $method));          
		}
	}


	/**	
	 * MUESTRA CLIENTES ACTIVOS
	 * @return [type] [description]
	 */
	public function activos()
	{
		$clinetes = $this->modelClientes->getClientesActivos($this->club);
		return viewCliente('show', [
			'clientes' => $clinetes,
			'total' => count($clinetes)
		]);
	}


	/**	
	 * MUESTRA CLIENTES NO ACTIVOS
	 * @return [type] [description]
	 */
	public function noActivos(){
		$clinetes = $this->modelClientes->getClientesInactivos();
		return viewCliente('no-activos', [
			'clientes' => $clinetes,
			'total' => count($clinetes)
		]);
	}


	/**
	 * MUESTRA CLIENTES SUSPENDIDOS
	 * @return [type] [description]
	 */
	public function suspendidos(){
		$clinetes = $this->modelClientes->getClientesSuspendidos($this->club);
		return viewCliente('suspendidos', [
			'clientes' => $clinetes,
			'total' => count($clinetes)
		]);
	}


	/**	
	 * CLIENTES QUE ESTAN PROXIMOS A CADUCAR SU SALDO
	 * @return [type] [description]
	 */
	public function proximosCaducar(){
		$clinetes = $this->modelClientes->getClientesProximosCaducar($this->club);
		return viewCliente('proximos-caducar', [
			'clientes' => $clinetes,
			'total' => count($clinetes)
		]);
	}

	/**
	 * CLUBES 
	 * @return [type] [description]
	 */
	public function clubes(){
		$cliestesClub = $this->modelClientes->getCountClientesPorClub();
		return viewCliente('clubes', [
			'clubes' => method_exists("CanastaModel", "clubes") ? CanastaModel::clubes() : [],
			'totalClientes' => $this->organizaClientesPorClub($cliestesClub)
		]);
	}


	/**
	 * ORGANIZA LOS CLIENTES POR CLUBE
	 */
	private function organizaClientesPorClub($cliestesClub){
		$newArr = [];
		if (!empty($cliestesClub)) {
			foreach ($cliestesClub as $key => $clientes) {
				$newArr[$clientes->club_id] = $clientes;
			}
		}

		return $newArr;
	}
	

}