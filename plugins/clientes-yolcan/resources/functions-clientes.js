(function($){

	"use strict";

	$(function(){

		$('.bt-corte').on('click', function(event){
			event.preventDefault();
			var response = confirm("Esta seguro de generar el corte, para los club´s de consumo seleccionados.");
			if (response == true) {
			   	$('#form-corte').submit();
			}
		});

		$('.date-piker').datepicker({
	        dateFormat : 'yy-mm-dd',
	        beforeShowDay: nonWorkingDates,
	        minDate: 'today'
	    });

	    function nonWorkingDates(date){
	        var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
	        var closedDays = [[Sunday], [Monday], [Tuesday], [Wednesday], [Thursday], [Saturday]];

	        for (var i = 0; i < closedDays.length; i++) {
	            if (day == closedDays[i][0]) {
	                return [false];
	            }

	        }

	        return [true];
	    }

	});

})(jQuery);