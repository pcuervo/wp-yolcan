<?php
add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."sitas_agendadas (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			nombre text COLLATE utf8mb4_unicode_ci NOT NULL,
			correo text COLLATE utf8mb4_unicode_ci NOT NULL,
			telefono text COLLATE utf8mb4_unicode_ci NOT NULL,
			numero_personas BIGINT(20) NOT NULL,
			fecha date NOT NULL DEFAULT '0000-00-00',
			PRIMARY KEY (id)
		) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;"
	);
});

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."ingredients_relationships (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			receta_id BIGINT(20) NOT NULL,
			ingrediente_id BIGINT(20) NOT NULL,
			PRIMARY KEY (id)
		) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8;"
	);
});

/**
 * REGRESA LOS INGREDIENTES DE LA RECETA
 * @param  [integer] $receta_id [id de la receta]
 * @return [abject]            [Objeto con las actividades del barco]
 */
function getIngredientsShip($receta_id){
	global $wpdb;

	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}ingredients_relationships 
		WHERE receta_id = $receta_id;", OBJECT );
}

/**	
 * ELIMINA LOS INGREDIENTES DE LA RECETA
 * @param  [type] $post_id [id de la receta]
 * @return [type]          [description]
 */
function destroyShipIngredients($receta_id){
	global $wpdb;
	$wpdb->delete( $wpdb->prefix.'ingredients_relationships', array( 'receta_id' => $receta_id ), array( '%d' ) );
}

/**
 * GUARDA LOS INGREDIENTES DE LA RECETA
 * @param  [integer] $post_id  [id dela receta]
 * @param  [integer] $activity [id del ingrediente]
 * @return [integer]           [id de la relación]
 */
function storeShipIngredients($post_id, $ingredient){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'ingredients_relationships',
		array(
			'receta_id'      => $post_id,
			'ingrediente_id' => $ingredient,
		),
		array(
			'%d',
			'%d'
		)
	);

	return $wpdb->insert_id;
}


function recipesByIngredient($ingrediente_id){
	global $wpdb;

	return $wpdb->get_results( "SELECT p.* FROM {$wpdb->prefix}ingredients_relationships as ir
			INNER JOIN {$wpdb->prefix}posts as p
			ON ir.receta_id = p.ID
			WHERE ingrediente_id = $ingrediente_id;", OBJECT );

}