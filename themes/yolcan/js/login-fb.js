(function($){

	"use strict";

	$(function(){

		/**************************************************
			  __                _                 _
			 / _| __ _  ___ ___| |__   ___   ___ | | __
			| |_ / _` |/ __/ _ \ '_ \ / _ \ / _ \| |/ /
			|  _| (_| | (_|  __/ |_) | (_) | (_) |   <
			|_|  \__,_|\___\___|_.__/ \___/ \___/|_|\_\

		 **************************************************/


		window.AppIdVive = 303514379772160;//alex
		// window.AppIdVive = 266024863813028;//produccion


		window.Yolcan_fb = {
			Settings: {
				appId: AppIdVive,
				status : true, // check login status
				cookie : true, // enable cookies to allow the server to access the session
				xfbml  : true,  // parse XFBML
				version  : 'v2.5',
			},
			Scope: { scope: 'public_profile, email' }
		};


		// INTEGRACION API FACEBOOK //////////////////////////////////////////////////////////


		$.ajaxSetup({ cache: true }); // Set default values for future Ajax requests.


		Yolcan_fb.loginCallback = function (response) {

			window.status_login = response.status;
			console.log(response.status);
			if (response.status === 'connected') {

				FB.api('/me', { locale: 'en_US', fields: 'first_name, last_name, email' },
				 	function(response) {
						console.log(response);
						console.log('asa');

						Yolcan_fb.ajax_save_user(response.first_name, response.last_name, response.email, response.id);
					}
				);

			}

		};


		Yolcan_fb.loginFacebookUser = function (){
			FB.login( Yolcan_fb.loginCallback, Yolcan_fb.Scope );
		};



		Yolcan_fb.getLoginStatusCallback = function (response){

			window.status_login = response.status;

			if (response.status === 'connected') { // mostrar contenido exclusivo para usuarios que autorizaron
				window.accessToken = response.authResponse.accessToken;
				console.log('entro');

				FB.api('/me', { locale: 'en_US', fields: 'name, email' },
					function(response) {
						console.log(response);
					}
				);


			}
		};



		/**
		 * GUARDA USUARIO EN LA TABLA
		 */
		Yolcan_fb.ajax_save_user = function (first_name, last_name, email, id_fb){
			$.post(ajax_url,{
				nombre: first_name,
				last_name: last_name,
				mail: email,
				id_fb: id_fb,
				action   : 'ajax_info_yolcan_fb_login'
			}, 'json')
			.done(function (data){
				console.log(data);
				if (data == 'creado') {
					location.replace(site_url+"mi-cuenta");
				}else{
					alert('Disculpa ya existe un usuario con el mismo correo');
				}

			});

		};


		Yolcan_fb.init = function (response) {
			$.getScript(
				'https://connect.facebook.net/en_US/sdk.js'
			).done(function () {
				FB.init( Yolcan_fb.Settings );
				// FB.getLoginStatus( Yolcan_fb.getLoginStatusCallback );
			});
		};

		$(document).ready(function(){
			Yolcan_fb.init();

			$('.bt-login-fb').on('click', function (event) {
				event.preventDefault();
				Yolcan_fb.loginFacebookUser();
			});

		});

		





	});

})(jQuery);