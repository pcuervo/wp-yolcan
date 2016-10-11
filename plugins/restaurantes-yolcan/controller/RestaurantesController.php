<?php
class RestaurantesController {

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

	/**	
	 * AGREGR SALDO AL RESTAURANTE
	 * @return [type] [description]
	 */
	public function saldoRestaurante()
	{
		return viewRestaurantes('cargar-saldo-restaurante', [
			'restauranteId' => $this->restauranteId,
			'restaurante' => $this->modelRestaurantes->getDataRestauranteById($this->restauranteId)
		]);
	}

	/**
	 * ACTUALIZA SALDO DEL RESTAURANTE 
	 * @return [type] [description]
	 */
	public function updateSaldoRestaurante()
	{
		$exist = $this->modelRestaurantes->existRegistroRestaurante($this->restauranteId);
		if ($exist > 0) {
			$this->modelRestaurantes->updateSaldoRestaurante($this->restauranteId, $this->dataPost['saldo'], $this->dataPost['saldo-anterior']);
		}else{
			$this->modelRestaurantes->insertSaldoRestaurante($this->restauranteId, $this->dataPost['saldo']);
		}
		
		$this->modelRestaurantes->storeHistoryUpdateSaldoAdmin($this->restauranteId, $this->dataPost['saldo'], $this->dataPost['saldo-anterior']);

		$urlRedirect = admin_url().'admin.php?page=restaurante&id_restaurante='.$this->restauranteId;

		wp_redirect($urlRedirect);
	}

	/**
	 * VIST PARA COMPRAR PRODUCTOS
	 * @return [type] [description]
	 */
	public function comprar()
	{
		return viewRestaurantes('comprar', [
			'restauranteId' => $this->restauranteId,
			'restaurante' => $this->modelRestaurantes->getDataRestauranteById($this->restauranteId),
			'ingredientes' => $this->modelRestaurantes->getIngredientesRestaurantes()
		]);
	}


	/**
	 * GUARDA LA COMPRA
	 */
	public function saveCompra()
	{
		$saldo_final = $this->dataPost['saldo-actual'] - $this->dataPost['total']; 
		$this->modelRestaurantes->updateSaldoRestaurante($this->restauranteId, $saldo_final);
		$this->modelRestaurantes->storeHistorialCompra($this->restauranteId, $this->dataPost);

		$urlRedirect = admin_url().'admin.php?page=historial_restaurante&id_restaurante='.$this->restauranteId;
		wp_redirect($urlRedirect);
	}

	/**
	 * HISTORIAL DE COMPRAS RESTAURANTE
	 * @return [type] [description]
	 */
	public function historialCompras()
	{
		return viewRestaurantes('historial-compras', [
			'restauranteId' => $this->restauranteId,
			'restaurante' => $this->modelRestaurantes->getDataRestauranteById($this->restauranteId),
			'historial' => $this->modelRestaurantes->getHistorialComprasRestaurantes($this->restauranteId)
		]);
	}


	public function compraRestaurante()
	{
		return viewRestaurantes('compra-restaurante', [
			'restauranteId' => $this->restauranteId,
			'restaurante' => $this->modelRestaurantes->getDataRestauranteById($this->restauranteId),
			'compra' => $this->modelRestaurantes->getCompraRestaurantes($this->restauranteId, $this->compraId)
		]);
	}

}