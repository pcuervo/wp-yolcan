<?php /**
 * Pasos a realizar en el update de la canasta
 * El update debe de ejecutar esta función los viernes a las 09:00hrs
 *
 * 1.- Descontar saldo a los clientes de su proxima canasta
 * 2.- Guardar la canasta descontada al cliente y sus adicionales
 * 3.- Generar nueva actualizacion de canastas para el historial
 * 4.- Desactivar suspensiones qeu vensan en la fecha del update
 *
 * crontab --- 00 09 * * 5 curl http://yolcan.dev/wp-content/update-canastas/update.php
 */

require("../../wp-load.php");

getClientUpdate();