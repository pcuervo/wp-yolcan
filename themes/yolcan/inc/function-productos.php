<?php

function getNameVariation($variationId){
	$variation = wc_get_product($variationId);
	$format = $variation->get_formatted_name();
	$porciones = explode(" ", $format);
	
	switch ($porciones[6]) {
	    case 'Mensual':
	        return "1 mes";
	        break;
	    case 'Trimestral':
	        return "3 meses";
	        break;
	    case 'Semestral':
	        return "6 meses";
	        break;
	}
}
 