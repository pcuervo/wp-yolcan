<?php

function nacin_register_slideshows_post_type() {
        register_post_type( 'ingredientesss', array(
                'labels' => array(
                        'name' => 'Slideshows',
                        'singular_name' => 'Slideshow',
                ),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => 'edit.php',
                'supports' => array( 'title' ,'thumbnail', 'editor' ),
        ) );
}
add_action( 'init', 'nacin_register_slideshows_post_type' );