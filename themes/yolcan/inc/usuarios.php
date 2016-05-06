<?php

//$wp_roles = new WP_Roles(); $wp_roles->remove_role("cobranza");
//$wp_roles = new WP_Roles(); $names = $wp_roles->get_names(); print_r($names);

add_action('admin_init','add_role_practicantes',999);
function add_role_practicantes() {

		$roles = array('practicantes','administrator','cobranza');

		foreach($roles as $the_role) {

		     $role = get_role($the_role);

	             $role->add_cap('read');
	             $role->add_cap('read_receta');
	             $role->add_cap('read_private_recetas');
	             $role->add_cap('edit_receta');
	             $role->add_cap('edit_recetas');
	             $role->add_cap('edit_others_recetas');
	             $role->add_cap('edit_published_recetas');
	             $role->add_cap('publish_recetas');
	             $role->add_cap('delete_others_recetas');
	             $role->add_cap('delete_private_recetas');
	             $role->add_cap('delete_published_recetas');
                     $role->add_cap('read_ingrediente');
	             $role->add_cap('read_private_ingredientes');
	             $role->add_cap('edit_ingrediente');
	             $role->add_cap('edit_ingredientes');
	             $role->add_cap('edit_others_ingredientes');
	             $role->add_cap('edit_published_ingredientes');
	             $role->add_cap('publish_ingredientes');
	             $role->add_cap('delete_others_ingredientes');
	             $role->add_cap('delete_private_ingredientes');
	             $role->add_cap('delete_published_ingredientes');
                     $role->add_cap('read_faq');
	             $role->add_cap('read_private_faqs');
	             $role->add_cap('edit_faq');
	             $role->add_cap('edit_faqs');
	             $role->add_cap('edit_others_faqs');
	             $role->add_cap('edit_published_faqs');
	             $role->add_cap('publish_faqs');
	             $role->add_cap('delete_others_faqs');
	             $role->add_cap('delete_private_faqs');
	             $role->add_cap('delete_published_faqs');
                     $role->add_cap('read_contacto');
	             $role->add_cap('read_private_contactos');
	             $role->add_cap('edit_contacto');
	             $role->add_cap('edit_contactos');
	             $role->add_cap('edit_others_contactos');
	             $role->add_cap('edit_published_contactos');
	             $role->add_cap('publish_contactos');
	             $role->add_cap('delete_others_contactos');
	             $role->add_cap('delete_private_contactos');
	             $role->add_cap('delete_published_contactos');
                     $role->add_cap('read_club-de-consumo');
	             $role->add_cap('read_private_club-de-consumos');
	             $role->add_cap('edit_club-de-consumo');
	             $role->add_cap('edit_club-de-consumos');
	             $role->add_cap('edit_others_club-de-consumos');
	             $role->add_cap('edit_published_club-de-consumos');
	             $role->add_cap('publish_club-de-consumos');
	             $role->add_cap('delete_others_club-de-consumos');
	             $role->add_cap('delete_private_club-de-consumos');
	             $role->add_cap('delete_published_club-de-consumos');

		}
}

add_role('cobranza', __('Cobranza'),
    array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => false,
        'publish_posts' => false,
        'upload_files' => true,
    )
);

add_role('practicantes', __('Practicantes'),
    array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => false,
        'publish_posts' => false,
        'upload_files' => true,
        'read_recetas' => true,
        'edit_recetas' => true,
        'read_ingredientes' => true,
        'edit_ingredientes' => true,
        'read_faq' => false,
        'read_faqs' => false,
        'edit_faq' => false,
        'edit_faqs' => false,

        'edit_contacto' => false,
        'edit_contactos' => false,
        'publish_contacto' => false,
        'publish_contactos' => false,
        'read_contacto' => false,
        'read_contactos' => false,


        'edit_club-de-consumo' => false,
        'edit_club-de-consumos' => false,
        'publish_club-de-consumo' => false,
        'publish_club-de-consumos' => false,
        'read_club-de-consumo' => false,
        'read_club-de-consumos' => false,

    )
);


