<?php
/*---------------------PRUEBA DE CANASTA--------------------------*/
function nacin_register_slideshows_post_type() {
        register_post_type( 'ingredientes', array(
                'labels' => array(
                        'name' => 'Slideshows',
                        'singular_name' => 'Slideshow',
                ),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => 'editar-canasta.php',
                'supports' => array( 'title' ,'thumbnail', 'editor' ),
        ) );
}
add_action( 'init', 'nacin_register_slideshows_post_type' );