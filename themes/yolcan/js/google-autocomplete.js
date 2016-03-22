(function($){

	"use strict";

	$(function(){

		if (document.getElementById("addresscontacto")) {
			var autocomplete = new google.maps.places.Autocomplete($("#addresscontacto")[0], {});

	        google.maps.event.addListener(autocomplete, 'place_changed', function() {
	       	 	var place = autocomplete.getPlace();

	       	 	$('#latitud_contacto').val( place.geometry.location.lat() );
	       	 	$('#longitud_contacto').val( place.geometry.location.lng() );

	       	 	var iframe = '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='+place.geometry.location.lat()+','+place.geometry.location.lng()+'&hl=es;z=14&amp;output=embed"></iframe>';
	       	 	$('.iframe-cont').empty().append(iframe);

	        });

		};

		if (document.getElementById("ubicacion_club")) {
			var autocomplete = new google.maps.places.Autocomplete($("#ubicacion_club")[0], {});

	        google.maps.event.addListener(autocomplete, 'place_changed', function() {
	       	 	var place = autocomplete.getPlace();

	       	 	$('#latitud_club').val( place.geometry.location.lat() );
	       	 	$('#longitud_club').val( place.geometry.location.lng() );

	       	 	var iframe = '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='+place.geometry.location.lat()+','+place.geometry.location.lng()+'&hl=es;z=14&amp;output=embed"></iframe>';
	       	 	$('.iframe-cont').empty().append(iframe);

	        });

		};

		
	});

})(jQuery);