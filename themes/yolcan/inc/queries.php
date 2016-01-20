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