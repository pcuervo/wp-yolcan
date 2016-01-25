(function($){

	"use strict";

	$(function(){

		jQuery('#fecha_visita').datepicker({
	        dateFormat : 'yy-mm-dd'
	    });

		imgToSvg();
		init_masonry();

		/**
		 * home
		**/
		if (is_home == 1 || is_conocenos == 1) {
			/**
			 * On ready
			**/
			
			$('.js-video-wrapper').fitVids();
			/**
			 * Triggered events
			**/

			//Chart.js

			//#mycanvas
			var ctx = $("#mycanvas").get(0).getContext("2d");
			//pie chart data
			//sum of values = 360
			var data = [
				{
					value: 46,
					color: "#f99134",
					highlight: "#f96234",
					label: "Local"
				},
				{
					value: 54,
					color: "#fff",
					highlight: "#fff",
					label: ""
				}
			];
			//draw
			var piechart = new Chart(ctx).Pie(data);

			//#mycanvas1
			var ctx = $("#mycanvas1").get(0).getContext("2d");
			//pie chart data
			//sum of values = 360
			var data = [
				{
					value: 14,
					color: "#c4681c",
					highlight: "#c4681c",
					label: "Macrotiendas"
				},
				{
					value: 54,
					color: "#fff",
					highlight: "#fff",
					label: ""
				}
			];
			//draw
			var piechart = new Chart(ctx).Pie(data);

		};

		

		if (is_recetas == 1) {
			/*------------------------------------*\
				#ON LOAD
			\*------------------------------------*/
			runMasonry('.results', '.result' );
			setHeaderHeightPadding('.main-wrapper', 'top');

			/*------------------------------------*\
				#Triggered events
			\*------------------------------------*/
			$('.tab-filter').on('click', function(){
				showFilters( this );
			});

			$('.filters__content .filter').on('click', function(){
				addFilter( this );
			});

			$('.filters__results .filter').on('click', function(){
				removeFilter( this );
			});

			$('.content-wrapper').scroll(function(){
				fixedHeader();
			});

			/*------------------------------------*\
				#RESPONSIVE
			\*------------------------------------*/
			$(window).resize(function(){
				setHeaderHeightPadding('.main-wrapper', 'top');
				setHeaderHeightPadding('.footer-wrapper', 'bottom');
			});
		};

		


		function imgToSvg(){
		    $('img.svg').each(function(){
		        var $img = $(this);
		        var imgID = $img.attr('id');
		        var imgClass = $img.attr('class');
		        var imgURL = $img.attr('src');

		        $.get(imgURL, function(data) {
		            // Get the SVG tag, ignore the rest
		            var $svg = $(data).find('svg');

		            // Add replaced image's ID to the new SVG
		            if(typeof imgID !== 'undefined') {
		                $svg = $svg.attr('id', imgID);
		            }
		            // Add replaced image's classes to the new SVG
		            if(typeof imgClass !== 'undefined') {
		                $svg = $svg.attr('class', imgClass+' replaced-svg');
		            }

		            // Remove any invalid XML tags as per http://validator.w3.org
		            $svg = $svg.removeAttr('xmlns:a').removeAttr('width').removeAttr('height');

		            // Replace image with new SVG
		            $img.replaceWith($svg);

		        }, 'xml');

		    });

		} //imgToSvg


		/*------------------------------------*\
		    #TOGGLE FUNCTIONS
		\*------------------------------------*/

		function init_masonry(){
		    var $container = $('#content');

		    $container.imagesLoaded( function(){
		        $container.masonry({
		          itemSelector: '.box-content',
		          isAnimated: true
		        });
		    });
		}




		/*------------------------------------*\
		    Customized check-box
		\*------------------------------------*/

		var input = document.querySelectorAll("label.check input");
		if(input !== null) {
		  [].forEach.call(input, function(el) {
		    if(el.checked) {
		      el.parentNode.classList.add('c_on');
		    }
		    el.addEventListener("click", function(event) {
		      event.preventDefault();
		      el.parentNode.classList.toggle('c_on');
		    }, false);
		  });
		}


		/*------------------------------------*\
		    #ON LOAD
		\*------------------------------------*/

		/**
		* Get the width of the window and apply it
		* as the height to the home secctions ( .square elements )
		**/

		function setSquareHeight(){
		    var windowWidth = $(window).width();
		    $('.j-square').height(windowWidth);
		}


		/**
		* Masonry layout for results
		**/
		function runMasonry(container, item){
		    var $container = $(container).masonry();
		    $container.imagesLoaded( function() {
		        $container.masonry({
		            itemSelector: item
		        });
		    });
		}

		//Get the header height
		function getHeaderHeight(){
		    return $('.header-wrapper').height();
		}

		//Get the window height
		function getWindowHeight(){
		    return $(window).height();
		}

		//Set the window height to another element
		function setWindowHeight(element){
		    $(element).height( getWindowHeight() );
		}

		//Set the padding
		function setPadding(element, direction, amount){
		    $(element).css('padding-'+direction, amount);
		}

		//Set the heather height as padding for another element
		function setHeaderHeightPadding(element, direction){
		    //Get the header height
		    var headerHeight = getHeaderHeight();
		    //Apply that height to the main wrapper as padding top
		    $(element).css('padding-'+direction, headerHeight);
		}

		// Set the height of an element substracting the
		// element's outer wrapper minus it's title
		function setHeightMinusElement(element, wrapper, title){
		    $.each($(element), function(index, val) {
		        var thisWrapper = $(this).closest(wrapper);
		        var thisTitle = thisWrapper.find(title+':first');
		        var thisWrapperHeight = thisWrapper.outerHeight();
		        var thisTitleHeight = thisTitle.outerHeight();
		        var heightForElement = getWindowHeight() - thisTitleHeight;
		        $(this).height(heightForElement);
		    });

		}



		/*------------------------------------*\
		    #Triggered events
		\*------------------------------------*/

		function showFilters(element){
		    //Check if this is already open and close it
		    if ( $(element).hasClass('tab-filter--active') ){
		        $('.tab-filter').removeClass('tab-filter--active');
		        $('.filters__content > div').css('height', '0px').removeClass('padding--small');
		        return;
		    }

		    //Make all .tab-filter un-active
		    $('.tab-filter').removeClass('tab-filter--active');
		    //Make this active
		    $(element).addClass('tab-filter--active');

		    //Get the filter category
		    var filterCategory = $(element).data('filter');
		    //Hide other filters category
		    $('.filters__content > div').css('height', '0px').removeClass('padding--small');
		    //Show this filter category
		    $('.filters__content .filter-'+filterCategory).addClass('padding--small').height('auto');
		}

		function addFilter(element){
		    //Clone this element so it won't get deleted by .append
		    // and manipulate ir instead of the clicked filter
		    var $clone = $(element).clone();

		    //If element is already added, then delete it
		    if ( $(element).hasClass('filter--active') ){
		        //Remove class active
		        $(element).removeClass('filter--active');

		        //Get its content so we can delete in the selected filters (.filters__results )
		        //If element has extra info, delete that info first
		        if ( $clone.hasClass('filter--info') ){
		            $clone.find('span').remove();
		        }
		        var filterContent = $clone.html();
		        $('.filters__results .filter:contains('+filterContent+')').remove();
		        return;
		    }

		    //Add active class to this element and its clone
		    $(element).addClass('filter--active');
		    $clone.addClass('filter--active');

		    //If element has extra info, delete that info
		    if ( $clone.hasClass('filter--info') ){
		        //First delete the info class
		        $clone.removeClass('filter--info')
		        //then delete the info
		        $clone.find('span').remove();
		    }

		    //And add this filter to the set of selected filters (.filters__results )
		    $clone.appendTo('.filters__results');
		}

		function removeFilter(element){
		    //Get its content so we can deactivate it
		    // in .filters__content
		    var filterContent = $(element).html();

		    //Delete it
		    $(element).remove();

		    //Deactive it in .filters__content
		    $('.filters__content .filter:contains('+filterContent+')').removeClass('filter--active');
		}

		function fixedHeader(){
		    //Get the header height so we can now when
		    //to change the heade state
		    var headerHeight = getHeaderHeight();
		    //Scrolled pixels in Y axis
		    var sy = scrollY();
		    //Compare the two numbers, when they are the same of less
		    //add fixed class to the header.
		    if ( sy >= headerHeight ) {
		        //Get the window height so we now how to position
		        //the header at the bottom
		        var windowHeight = $(window).outerHeight();
		        //Substract the header height feom the window height
		        //and apply it as its top
		        var topHeader =  windowHeight - headerHeight;
		        $('.header-wrapper').addClass('header-wrapper--fixed').css('top', topHeader);
		        setHeaderHeightPadding('.footer-wrapper', 'bottom');
		    } else {
		        $('.header-wrapper').removeClass('header-wrapper--fixed').css('top', 0);
		        setPadding('.footer-wrapper', 'bottom', 0);
		    }
		}

		//Get the scrolled pixels in Y axis
		function scrollY() {
		    return $('.content-wrapper').scrollTop();
		}

		//Show lightbox and run cycle
		function openLightbox(){
		    $('.cycle-slideshow').cycle({
		        slides      : ".image-single",
		        fx          : "scrollHorz",
		        swipe       : "true",
		        timeout     : "0",
		        centerHorz : "true",
		        centerVert : "true"
		    });
		    $('.lightbox').show();
		}



		$('#agenda-visita').on('submit', function(event){
			event.preventDefault();

			var nombre = $('#nombre_visita').val();
			var email = $('#email_visita').val();
			var telefono = $('#telefono_visita').val();
			var personas = $('#n_personas_visita').val();
			var fecha = $('#fecha_visita').val();


			if (nombre == '' || email == '' || telefono == '' || personas == '' || fecha == '') {
				alert('Favor de llenar todos los campos');
			}else{
				document.agendavisita.submit();
			};

		});


		$('#formcontacto').on('submit', function(event){
			event.preventDefault();

			var nombre = $('#nombre_contacto').val();
			var email = $('#correo_contacto').val();
			var telefono = $('#telefono_contacto').val();
			var mensaje = $('#mensaje_contacto').val();
			

			if (nombre == '' || email == '' || telefono == '' || mensaje == '' ) {
				alert('Favor de llenar todos los campos');
			}else{
				document.formcontacto.submit();
			};

		});


		/**	
		 * MAPS
		 */
		
		if (is_home == 1) {
			initialize();
		};
		
		

		function initialize() {
			
			var data_clubs = [];
			var infoWindowContent = [];

			$.each( clubes, function( key, value ) {
				var cada_uno = [value.name, value.lat, value.long];
				var data_uno = ['<div class="info_content"><h3>'+value.name+'</h3></div>'];
			 	data_clubs.push(cada_uno);
			 	infoWindowContent.push(data_uno);

			});


		    var map;
		    var bounds = new google.maps.LatLngBounds();
		    var mapOptions = {
		        mapTypeId: 'roadmap'
		    };
		                    
		    // Display a map on the page
		    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		    map.setTilt(45);
		        
		    // Multiple Markers
		    var markers = data_clubs;
		        
		    // Display multiple markers on a map
		    var infoWindow = new google.maps.InfoWindow(), marker, i;
		    
		    // Loop through our array of markers & place each one on the map  
		    for( i = 0; i < markers.length; i++ ) {
		        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
		        bounds.extend(position);
		        marker = new google.maps.Marker({
		            position: position,
		            map: map,
		            title: markers[i][0]
		        });
		        
		        // Allow each marker to have an info window    
		        google.maps.event.addListener(marker, 'click', (function(marker, i) {
		            return function() {
		                infoWindow.setContent(infoWindowContent[i][0]);
		                infoWindow.open(map, marker);
		            }
		        })(marker, i));

		        // Automatically center the map fitting all markers on the screen
		        map.fitBounds(bounds);
		    }

		    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
		    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
		        this.setZoom(14);
		        google.maps.event.removeListener(boundsListener);
		    });
		    
		}


	});

})(jQuery);
