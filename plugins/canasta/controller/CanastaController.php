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


	/**	
	 * MUESTRA LOS CLUBS PARA VER SUS CANASTAS
	 * @return [type] [description]
	 */
	public function canasta()
	{
		return view('show', [
			'clubes' => CanastaModel::clubes(),
			'clubesCanastaBase' => get_option('clubes_usan_canasta_base')
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
			'productos' => array_merge($productos->productos(), getObjetAdicionales() ),
			'canastasActivas' => $canastasActivas,
			'canastasProgramadas' => $canastasProgramadas
		]);
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
			'productos' => array_merge($productos->productos(), getObjetAdicionales() ),
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
		$fecha_activa = isset($this->dataPost['fecha_activar_canasta']) ? $this->dataPost['fecha_activar_canasta'] : '0000-00-00';
		$idActualizacion = $mCanasta->storeCanasta($this->idClub, 1, $fecha_activa);

		if (!empty($this->dataPost['ingredientes_canastas']['ingredientes'])) {
			foreach ($this->dataPost['ingredientes_canastas']['ingredientes'] as $idCanasta => $canasta) {
				$unidades = $this->dataPost['ingredientes_canastas']['unidades'];
				$this->updateIngredientesCanasta($idCanasta, $canasta, 'no', $idActualizacion, $unidades);
			}
		}
		$urlRedirect = admin_url().'admin.php?page=canastas_club&id_club='.$this->idClub;
		wp_redirect($urlRedirect);
	}

	/**
	 * EDITAR CANASTA
	 * @return [type] [description]
	 */
	public function editCanastas()
	{
		$productos = model('ProductosModel');
		$mCanasta = model('CanastaModel');

		$ingredientesCanastas = getGroupCanastas($mCanasta->getCanastasClub($this->idClub));

		return view('editar-canasta', [
			'titulo' => 'Editar canastas',
			'ingredientes' => $this->modelIngredientes->getIngredientes(),
			'ingredientesCanastas' => $ingredientesCanastas,
			'idClub' => $this->idClub,
			'productos' => array_merge($productos->productos(), getObjetAdicionales() ),
			'action' => 'update'
		]);
	}

	/**
	 * ACTUALIZAR CANASTA
	 * @return [type] [description]
	 */
	public function updateCanastas()
	{
		$mCanasta = model('CanastaModel');
		$idActualizacion = $this->dataPost['idActualizacion'];
		$fecha_activa = isset($this->dataPost['fecha_activar_canasta']) ? $this->dataPost['fecha_activar_canasta'] : '0000-00-00';
		$mCanasta->updateDateEditCanasta($idActualizacion, $fecha_activa);
		$unidades = $this->dataPost['ingredientes_canastas']['unidades'];

		if (!empty($this->dataPost['ingredientes_canastas']['ingredientes'])) {
			foreach ($this->dataPost['ingredientes_canastas']['ingredientes'] as $idCanasta => $canasta) {

				$this->updateIngredientesCanasta($idCanasta, $canasta, 'si', $idActualizacion, $unidades);
			}
		}

		$urlRedirect = admin_url().'admin.php?page=canastas_club&id_club='.$this->idClub;
		wp_redirect($urlRedirect);
	}


	/**	
	 * CREAR CANASTA PROGRAMADA
	 * @return [type] [description]
	 */
	public function createCanastasProgramadas()
	{
		$productos = model('ProductosModel');

		return view('editar-canasta', [
			'titulo' => 'Programar canastas',
			'idClub' => $this->idClub,
			'ingredientes' => $this->modelIngredientes->getIngredientes(),
			'productos' => array_merge($productos->productos(), getObjetAdicionales() ),
			'action' => 'store_programar'
		]);
	}

	/**
	 * GUARDA LAS CANASTAS
	 * @return [type] [description]
	 */
	public function storeCanastasProgramadas()
	{
		$mCanasta = model('CanastaModel');
		$fecha_activa = isset($this->dataPost['fecha_activar_canasta']) ? $this->dataPost['fecha_activar_canasta'] : '0000-00-00';
		$idActualizacion = $mCanasta->storeCanasta($this->idClub, 2, $fecha_activa);
		$unidades = $this->dataPost['ingredientes_canastas']['unidades'];

		if (!empty($this->dataPost['ingredientes_canastas']['ingredientes'])) {
			foreach ($this->dataPost['ingredientes_canastas']['ingredientes'] as $idCanasta => $canasta) {
				$this->updateIngredientesCanasta($idCanasta, $canasta, 'no', $idActualizacion, $unidades);
			}
		}
		$urlRedirect = admin_url().'admin.php?page=canastas_club&id_club='.$this->idClub;
		wp_redirect($urlRedirect);
	}


	/**
	 * EDITAR CANASTA
	 * @return [type] [description]
	 */
	public function editCanastasProgramadas()
	{
		$productos = model('ProductosModel');
		$mCanasta = model('CanastaModel');

		$ingredientesCanastas = getGroupCanastas($mCanasta->getCanastasClub($this->idClub, 2));

		return view('editar-canasta', [
			'titulo' => 'Editar canastas programadas',
			'ingredientes' => $this->modelIngredientes->getIngredientes(),
			'ingredientesCanastas' => $ingredientesCanastas,
			'idClub' => $this->idClub,
			'productos' => array_merge($productos->productos(), getObjetAdicionales() ),
			'action' => 'update'
		]);
	}


	/**
	 * ACTUALIZA LOS INGREDIENTES DE LAS CANASTAS
	 * @param  [int] $idCanasta       [id de la canasta]
	 * @param  [object] $ingredientes     ingredientes de la canasta]
	 * @param  [string] $actualizacion   [si se edita o crea la actualizacion]
	 * @param  [id] $idActualizacion [id de la actualizacion]
	 * @return [bool]                  [true ó false]
	 */
	private function updateIngredientesCanasta($idCanasta, $ingredientes, $actualizacion, $idActualizacion, $unidades)
	{
		if (!empty($ingredientes)) {
			if ($actualizacion == 'si') $this->modelIngredientes->destroyIngredientesCanasta($idActualizacion, $idCanasta);
			
			foreach ($ingredientes as $key => $ingrediente) {
				$unidad = $unidades[$idCanasta][$ingrediente];
				$this->modelIngredientes->storeIngredienteCanasta($idCanasta, $idActualizacion, $ingrediente, $unidad);
			}
		}

		return true;
	}

	/**
	 * CONFIGURACION DE LA CANASTA BASE
	 * @return [type] [description]
	 */
	public function configCanastaBase()
	{
		if(! empty($this->dataPost)) $this->updateConfigCanastaBase($this->dataPost);
		return view('config-canasta-base', [
			'titulo' => 'Configuración canasta base',
			'clubes' => CanastaModel::clubes(),
			'clubesAplica' => get_option('clubes_usan_canasta_base')
		]);
	}


	/**
	 * GUARDA LA CONFIGURACION DE CANASTA BASE
	 */
	public function updateConfigCanastaBase($dataPost)
	{
		$optionName = 'clubes_usan_canasta_base';
		$newValue = $dataPost['clubes'];

		if (get_option( $optionName ) !== false){
		    update_option( $optionName, $newValue );
		}else{
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( $optionName, $newValue, $deprecated, $autoload );
		}
	}


	/**
	 * HISTORIAL DE CANASTAS
	 * @return [type] [description]
	 */
	public function historialCanasta()
	{
		$mCanasta = model('CanastaModel');
		return view('historial-canastas', [
			'titulo' => 'Historial de canastas',
			'clubId' => $this->idClub,
			'historial' => $mCanasta->getHistorialCanastasByClub($this->idClub)
		]);
	}

	/**
	 * INGREDIENTES DE CANASTAS
	 * @return [type] [description]
	 */
	public function showCanastas()
	{
		$idActualizacion = isset($_GET['id_actualización']) ? $_GET['id_actualización'] : 0;

		$productos = model('ProductosModel');
		$mCanasta = model('CanastaModel');
		$canastas = getGroupCanastas($mCanasta->getCanastasClubByActualizacion($idActualizacion));

		return view('canastas-club', [
			'idClub' => $this->idClub,
			'productos' => array_merge( $productos->productos(), getObjetAdicionales() ),
			'canastasActivas' => $canastas,
			'historial' => TRUE
		]);
		
	}

}