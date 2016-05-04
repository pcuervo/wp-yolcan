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
		
		$data = array(
			'ingredientes' => $model_ingredientes->getIngredientes()
			);

		return view('edit', $data);
	}

}