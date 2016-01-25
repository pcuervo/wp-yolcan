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


		if (document.getElementById("ubicaciones_clubes")) {
			var autocomplete = new google.maps.places.Autocomplete($("#ubicaciones_clubes")[0], {});

	        google.maps.event.addListener(autocomplete, 'place_changed', function() {
	        	var clube = $('#clube_n').val();
	        	console.log(clube);

	       	 	var place = autocomplete.getPlace();
	       	 	var name  = $('#ubicaciones_clubes').val();
	       	 	var lat   = place.geometry.location.lat();
	       	 	var lng   = place.geometry.location.lng();

	       	 	var html = '<div class="cont-direccion-clube"><strong>Dirección:</strong> '+name+
	       	 			'<input type="hidden" name="direcciones['+clube+'][name]" value="'+name+'">'+
	       	 			'<input type="hidden" name="direcciones['+clube+'][lat]" value="'+lat+'"> '+
	       	 			'<input type="hidden" name="direcciones['+clube+'][long]" value="'+lng+'">'+
	       	 			' - <span class="eliminar-club">Eliminar</span>'+
	       	 		'</div>';

	       	 	$('.cont-ubicaciones').append(html);

	       	 	var coun = parseInt(clube) + parseInt(1);
	       	 	$('#ubicaciones_clubes').val('');
	       	 	clube = $('#clube_n').val(coun);

	        });

		};


		$(document).on('click', '.eliminar-club', function(){
			$(this).parent().remove();
		});


		
	});

})(jQuery);