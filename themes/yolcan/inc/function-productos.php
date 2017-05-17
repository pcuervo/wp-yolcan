<?php


function getNameOriginVariation($variationId){
	$variation = new WC_Product_Variation($variationId);
	$title_slug = current($variation->get_variation_attributes());
	$variation_attr = get_term_by( 'slug', $title_slug, 'pa_temporalidad' );

	return isset($variation_attr->name) ? $variation_attr->name : '';
}

/**
 * REGRESA EL HTML CON LOS INGREDIENTES DEL PRODUCTO
 */
function ajax_html_ingredientes_producto(){
	extract($_POST);
	if ( is_user_logged_in() ) {
		global $current_user;
		$opCliente = getCliente($current_user->ID);
		$canasta = getIdCanastaClube($opCliente->clubId, $producto);
		$ingredientes = getIngredientesCanasta($canasta);
	} else {
		$canasta = '1'.$producto;
	   	$ingredientes = getIngredientesCanasta($canasta);
	}

	$html = getHtmlIngredientes($ingredientes, $producto);

	wp_send_json($html);
}

/**
 * DEVUELVE EL HTML DE LOS INGREDIENTES
 */
function getHtmlIngredientes($ingredientes, $producto_id){
	$html = '<h2 class="[ text-center color-dark ][ no-margin--top ]">'.get_the_title($producto_id).'</h2>';
	$html .= '<div class="[ card__radio-options ][ text-center color-dark ]">';
		$html .= '<div class="[ radio-options__label ]">';
			$html .= 'Entregas semanales durante:';
		$html .= '</div>';
		if (!empty($variations)):
        $count = 1;
            foreach($variations as $variation):
                $check = $count == 1 ? 'checked' : '';
                $nombreVariacion = getNameOriginVariation($variation['variation_id']);
                $cansatSemanal = getCostoCanastaTemporalidad($nombreVariacion, $variation['display_price']);
                if($count == 1):
                    $addToCart = site_url('/mi-carrito/?add-to-cart=').$variation['variation_id'];
                    $costoVariationSemanal = $cansatSemanal;
                    $costoTotal = $variation['display_price'];
                endif;
                $html .= '<label class="[ radio-options__selector__label ]" for="c9_meals-'.$variation['variation_id'].'">';
                    $html .= '<input ';
                        $html .= 'id="c9_meals-'.$variation['variation_id'].'"';
                        $html .= 'data-costo="'.number_format($variation['display_price']).'"';
                        $html .= 'data-producto="'.$producto_id.'"';
                        $html .= 'data-variacion="'.$variation['variation_id'].'"';
                        $html .= 'data-semanal="'.$cansatSemanal.'"';
                        $html .= 'class="[ radio-options__selector ][ check-compra-modal ]" ';
                        $html .= 'type="radio"';
                        $html .= 'name="variaciones-00'.$producto_id.'"';
                        $html .= 'value="c9"';
                        $html .= $check;
                    $html .= '>'. $nombreVariacion;
                $html .= '</label>';
                $count++;
            endforeach;
        endif;
	$html .= '</div>';
	$html .= '<div class="[ text-center ][ margin-bottom ]">';
		$html .= '<a class="[ btn btn-secondary ] url-add-cart-product-modal-00'.$producto_id.'" href="'.$addToCart.'">Añadir al carrito</a>';
	$html .= '</div>';
	$html .= '<div class="[ row ]">';
		if(!empty($ingredientes)):
			foreach ($ingredientes as $key => $ingrediente):
				$html .= '<div class="[ col-xs-3 col-md-2 ]">';
					$html .= '<a class="[ box-content ]" href="'.site_url('/recetas/').'?ingrediente='.$ingrediente->ingrediente_id.'">';
						$url_img = attachment_image_url($ingrediente->ingrediente_id, 'medium');
						$html .= '<img class="[ image-responsive ]" alt="" src="'.$url_img.'">';
						$html .= '<p class="[ text-center ]">'.get_the_title($ingrediente->ingrediente_id).'</p>';
					$html .= '</a>';
				$html .= '</div>';
			endforeach;
		endif;
	$html .= '</div>';
	$producto = wc_get_product( $producto_id );
    $variations = $producto->get_available_variations();
    $addToCart = '';
    $costoVariationSemanal = 0;
    $costoTotal = 0;


	return $html;
}

add_action('wp_ajax_ajax_html_ingredientes_producto', 'ajax_html_ingredientes_producto');
add_action('wp_ajax_nopriv_ajax_html_ingredientes_producto', 'ajax_html_ingredientes_producto');

