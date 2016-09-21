<?php
class ClientesController {

	public $dataPost;
	public $club;
	public $clienteId;
	public $modelClientes;

	function __construct() {
        $this->dataPost = !empty($_POST) ? $_POST : [];
        $this->club = isset($_GET['club']) ? $_GET['club'] : 0;
        $this->clienteId = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : 0;
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
	public function noActivos()
	{
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
	public function suspendidos()
	{
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
	public function proximosCaducar()
	{
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
	public function clubes()
	{
		$cliestesClub = $this->modelClientes->getCountClientesPorClub();
		return viewCliente('clubes', [
			'clubes' => method_exists("CanastaModel", "clubes") ? CanastaModel::clubes() : [],
			'totalClientes' => $this->organizaClientesPorClub($cliestesClub)
		]);
	}

	/**	
	 * CLIENTES QUE SU SALDO NO ALCANSA NI PARA UNA CANASTA
	 * @return [type] [description]
	 */
	public function saldoInsuficiente()
	{
		$clinetes = $this->modelClientes->getClientesSaldoInsuficiente($this->club);
		return viewCliente('saldo-insuficiente', [
			'clientes' => $clinetes,
			'total' => count($clinetes)
		]);
	}

	/**
	 * ORGANIZA LOS CLIENTES POR CLUBE
	 */
	private function organizaClientesPorClub($cliestesClub)
	{
		$newArr = [];
		if (!empty($cliestesClub)) {
			foreach ($cliestesClub as $key => $clientes) {
				$newArr[$clientes->club_id] = $clientes;
			}
		}

		return $newArr;
	}

	/**	
	 * PERFIL CLIENTE
	 * @return [type] [description]
	 */
	public function cliente()
	{
		return viewCliente('cliente', [
			'clubes' => method_exists("CanastaModel", "clubes") ? CanastaModel::clubes() : [],
			'cliente' => $this->modelClientes->getOpcionesClienteById($this->clienteId),
			'historySaldo' => $this->modelClientes->getHistorySaldoClienteById($this->clienteId)
		]);
	}

	/**
	 * EDITAR EL CLIENTE
	 * @return [type] [description]
	 */
	public function editarCliente()
	{
		return viewCliente('editar-cliente', [
			'clubes' => method_exists("CanastaModel", "clubes") ? CanastaModel::clubes() : [],
			'cliente' => $this->modelClientes->getOpcionesClienteById($this->clienteId),
			'historySaldo' => $this->modelClientes->getHistorySaldoClienteById($this->clienteId)
		]);
	}

	/**
	 * ACTUALIZAR SALDO Y SUSPENDER CANASTAS
	 * @return [type] [description]
	 */
	public function updateCliente()
	{
		if (isset($this->dataPost['saldo']) AND function_exists('updateSaldoCliente')) {
			updateSaldoCliente($this->clienteId, $this->dataPost['saldo']);
			if ($this->dataPost['saldo'] != $this->dataPost['saldo-anterior']) {
				$this->modelClientes->storeHistoryUpdateSaldoAdmin($this->clienteId, $this->dataPost['saldo'], $this->dataPost['saldo-anterior']);
			}
		}

		if (isset($this->dataPost['suspensionHasta']) AND function_exists('suspenderCanastaTemporal')) {
			suspenderCanastaTemporal($this->dataPost, $this->clienteId);
		}

		if (isset($this->dataPost['suspension']) AND function_exists('suspenderCanastaTemporal')) {
			suspenderCanastaTemporal($this->dataPost, $this->clienteId);
		}

		$urlRedirect = admin_url().'admin.php?page=cliente&id_cliente='.$this->clienteId;
		wp_redirect($urlRedirect);
	}

	/**	
	 * REANUDAR ENTREGAS DE CANASTAS
	 */
	public function reanudarEntregas()
	{
		if (function_exists('updateSuspensionOpcionesCliente')) {
			updateSuspensionOpcionesCliente($this->clienteId, 0, 0);
		}
		$urlRedirect = admin_url().'admin.php?page=cliente&id_cliente='.$this->clienteId;
		wp_redirect($urlRedirect);
	}
	
	/**
	 * HISTORIAL DE CANASTAS DEL CLIENTE
	 * @return [type] [description]
	 */
	public function historialCanastas()
	{
		$historial = $this->modelClientes->getHistorialCanastas($this->clienteId);

		return viewCliente('historial-cliente', [
			'historial' => $historial,
			'clienteId' => $this->clienteId
		]);
	}

	/**
	 * INGREDIENTES DE LA CANASTA DEL CLIENTE
	 * @return [type] [description]
	 */
	public function ingredientesCanasta()
	{
		$idActualizacion = isset($_GET['id_actualizacion']) ? $_GET['id_actualizacion'] : 0;
		$idCanasta = isset($_GET['id_canasta']) ? $_GET['id_canasta'] : 0;

		$ingredientes = $this->modelClientes->getIngredientesCanasta($idCanasta, $idActualizacion);
		$canasta = $this->modelClientes->getCanastaCliente($this->clienteId, $idActualizacion);

		return viewCliente('ingredientes-canasta', [
			'ingredientes' => $ingredientes,
			'canasta' => $canasta,
			'clienteId' => $this->clienteId
		]);
	}

	/**	
	 * CORTE DE COMPRAS CLIENTE
	 */
	public function corteSemanal()
	{
		if (isset($this->dataPost['action']) AND $this->dataPost['action'] == 'realizar-corte') {
			
			if (function_exists('getClientUpdate')) {
				getClientUpdate();

				$urlRedirect = admin_url().'admin.php?page=corte_semanal&corte=ok';
				wp_redirect($urlRedirect);
				exit;
			}
		}
		
		return viewCliente('corte-semanal', [
			'cortes' => $this->modelClientes->getHistorialCortes(),
		]);
	}

}