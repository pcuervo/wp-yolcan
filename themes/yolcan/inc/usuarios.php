<?php 
/**
 * CREA ROL DE BOOMER
 */

$administrator = get_role('customer');
add_role( 'restaurante', 'Restaurante', $administrator->capabilities );