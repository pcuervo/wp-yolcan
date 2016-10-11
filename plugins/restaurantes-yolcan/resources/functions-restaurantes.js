(function($){

	"use strict";

	$(function(){

		$('.bt-corte-restaurant').on('click', function(event){
			event.preventDefault();
			var response = confirm("Esta seguro de generar el corte del restaurant");
			if (response == true) {
			   	$('#form-corte-restaurant').submit();
			}
		});

		var total_ingredientes = 0;
		$('.add-ingrediente').on('click', function(){
			var id = $(this).data('id');
			var ingrediente = $(this).data('ingrediente');
			var unidad = $(this).data('unidad');
			var precio = $(this).data('precio');
			var cantidad = $('#cantidad-'+id).val();
			var total = precio * cantidad;
			total_ingredientes = total_ingredientes + total;
			var html = '<div class="caja-'+id+'">';
				html += '<span class="borrar-ingrediente" data-caja="'+id+'" data-total="'+total+'">x</span>';
				html += '<p>'+ingrediente+' <strong>('+cantidad+' '+unidad+')</strong> - $ '+total+'</p>';
				html += '<input type="hidden" name="ingredientes['+id+'][id]" value="'+id+'">';
				html += '<input type="hidden" name="ingredientes['+id+'][cantidad]" value="'+cantidad+'">';
				html += '<input type="hidden" name="ingredientes['+id+'][costo]" value="'+total+'">';

	
			html += '</div>';


			$('.ingredientes-agregados-compra').append(html);
			$('#total-compra').html(total_ingredientes);
			$('#cantidad-'+id).val('');

		});


		$(document).on('click', '.borrar-ingrediente', function(){
			var caja = $(this).attr('data-caja');
			var cantidad = $(this).attr('data-total');
			total_ingredientes = total_ingredientes - cantidad;
			$( this ).parent( '.caja-'+caja ).remove();
			$('#total-compra').html(total_ingredientes);
		});	

	});

})(jQuery);