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
		"CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."creates_a_club_of_consumption (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			nombre text COLLATE utf8mb4_unicode_ci NOT NULL,
			correo text COLLATE utf8mb4_unicode_ci NOT NULL,
			telefono text COLLATE utf8mb4_unicode_ci NOT NULL,
			ubicacion varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
			mensaje varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
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

add_action('init', function() use (&$wpdb){
	$wpdb->query(
		"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}corte_general_clientes (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL DEFAULT '0',
			fecha_corte datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			clubes longtext COLLATE utf8mb4_unicode_ci,
			UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
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


function recipesByIngredient($ingrediente_id, $post_page, $offset ){
	global $wpdb;

	return $wpdb->get_results( "SELECT receta_id as ID FROM {$wpdb->prefix}ingredients_relationships WHERE ingrediente_id = $ingrediente_id AND receta_id != 0 LIMIT $offset, $post_page;", OBJECT );

}


/**	
 * REGRESA EL NUMERO DE PAGINAS DE RECETAS POR INGREDIENTES
 * @return [type]                 [description]
 */
function recipesByIngredientCount($ingrediente_id, $post_page){
	global $wpdb;

	$count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}ingredients_relationships WHERE ingrediente_id = $ingrediente_id AND receta_id != 0;");
	
	$pages = $count / $post_page;

	return ceil($pages);

}


/**	
 * REGRESA LOS RESULTADOS DE BUSQUEDA
 * @return [type]            [description]
 */
function recipesBySearch($search, $post_page, $offset){
	global $wpdb;

	return $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts 
		WHERE post_type = 'recetas' AND post_status = 'publish' AND (post_title LIKE '%$search%' || post_content LIKE '%$search%') LIMIT $offset, $post_page;", OBJECT );

}


/**	
 * REGRESA EL NUMERO DE PAGINAS DE RECETAS POR BUSQUEDA
 * @return [type]                 [description]
 */
function recipesBySearchCount($search, $post_page){
	global $wpdb;

	$count = $wpdb->get_var( "SELECT count(*) FROM {$wpdb->prefix}posts 
		WHERE post_type = 'recetas' AND post_status = 'publish' AND (post_title LIKE '%$search%' || post_content LIKE '%$search%');");
	
	$pages = $count / $post_page;

	return ceil($pages);

}

/**
 * GUARDA LOS DATOS DEL CORTE, FECHA Y USUARIO QUE GENERO EL CORTE
 */
function storeCorteClientes($clubes){
	global $wpdb;
	global $current_user;
	$wpdb->insert(
		$wpdb->prefix.'corte_general_clientes',
		array(
			'user_id' => $current_user->ID,
			'fecha_corte' => date('Y-m-d h:i:s'),
			'clubes' => serialize($clubes)
		),
		array(
			'%d',
			'%s',
			'%s'
		)
	);

	return $wpdb->insert_id;
}

function getVisitasAgendadas(){
	global $wpdb;

	$fecha = date('Y-m-d');
	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}sitas_agendadas 
		WHERE fecha >= '$fecha' ORDER BY fecha ASC;", OBJECT );
}

function getCreaTuClub(){
	global $wpdb;

	return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}creates_a_club_of_consumption
	 	ORDER BY id DESC;", OBJECT );
}

/**
 * INGREDIENTES RELACIONADOS A UNA RECETA
 * @return [type] [description]
 */
function getIngredientesRecetas(){
	global $wpdb;

	return $wpdb->get_results( "SELECT ingrediente_id as ID FROM {$wpdb->prefix}ingredients_relationships ip
		INNER JOIN {$wpdb->prefix}posts as p
		ON ip.receta_id = p.ID
		WHERE p.post_status = 'publish'
		GROUP BY ingrediente_id;", OBJECT );
			
}
