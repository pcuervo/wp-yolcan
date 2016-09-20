(function($){

	"use strict";

	$(function(){

		$('.bt-corte').on('click', function(event){
			event.preventDefault();
			var response = confirm("Esta seguro de generar el corte");
			if (response == true) {
			   	$('#form-corte').submit();
			}
		});

	});

})(jQuery);