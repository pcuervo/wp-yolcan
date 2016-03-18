<?php
class CanastaController {

	static function index($method, $name_menu, $slug_page){
		$canasta = new CanastaController;

		if ($slug_page == 'canasta'){
			add_menu_page( $name_menu, $name_menu, 'edit_pages', $slug_page, array($canasta, $method), '', 13 );
		}else{
			add_submenu_page('canasta', $name_menu, $name_menu, 'edit_pages', $slug_page, array($canasta, $method));
		}
			

	}

	/**	
	 * MUESTRA LA VISTA DE CANASRA
	 * @return [type] [description]
	 */
	public function canasta()
	{
		
		return view('show');
	}

	/**	
	 * VISTA PARA EDITAR
	 * @return [type] [description]
	 */
	public function edit()
	{
		$model_ingredientes = model('IngredientesModel');

		if (! empty($_POST)) $model_ingredientes->setIngredientesCanasta($_POST);
		$actualizacion = $model_ingredientes->getUltimaActualizacion();
		$ultimos_ingredientes = ! empty($actualizacion) ? $model_ingredientes->getIngredientesActuales($actualizacion->id)  : array();
		$data = array(
			'ingredientes' => $model_ingredientes->getIngredientes(),
			'actualizacion' => ! empty($actualizacion) ? $actualizacion  : array(),
			'ultimos_ingredientes' => $this->getActualizaIndexIngredientes($ultimos_ingredientes)
			);

		return view('edit', $data);
	}

	/**
	 * ACTUALIZA EL INDEX DEL ARREGLO POR EL ID DEL INGREDIENTE
	 * @param  [object] $ultimos_ingredientes [ingredientes de la ultima actualización]
	 * @return [object]                       [ingredientes]
	 */
	public function getActualizaIndexIngredientes($ingredientes)
	{
		$new_array = array();
		if (! empty($ingredientes)) {
			foreach ($ingredientes as $key => $ingrediente) {
				$new_array[$ingrediente->ingrediente_id] = $ingrediente;
			}
		}

		return $new_array;
	}

}