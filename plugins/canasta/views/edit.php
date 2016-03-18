<?php $completa = isset($actualizacion->valor_puntos_completa) ? $actualizacion->valor_puntos_completa : 0;
$mitad = isset($actualizacion->valor_puntos_mitad) ? $actualizacion->valor_puntos_mitad : 0; ?>
<div class="wrap">
	<h1>Editar Canasta</h1>
	<hr>
	<form action="" method="POST">
		<label for="valor_puntos_completa" class="label-paquetes">Puntos Canasta completa: </label>
		<input type="text" name="valor_puntos_completa" value="<?php echo $completa; ?>" id="valor_puntos_completa" placeholder=""/> 

		<label for="valor_puntos_mitad" class="label-paquetes">Puntos media Canasta: </label>
		<input type="text" name="valor_puntos_mitad" value="<?php echo $mitad; ?>" id="valor_puntos_mitad" placeholder=""/> 
		<hr>
		<table class="table-ingredientes">
	      	<thead>
	      	  	<tr>
	      	  	  	<th>Ingrediente</th>
	      	  	  	<th>Canasta Completa</th>
	      	  	  	<th>Media canasta</th>
	      	  	  	<th>Adicional</th>
	      	  	  	<th>Puntos</th>
	      	  	</tr>
	      	</thead>
	      	<tbody>
				<?php if(! empty($ingredientes) ):
					foreach ($ingredientes as $key => $ingrediente) :
						$status = $ultimos_ingredientes[$key]; 
						$check_a = $status->canasta_completa == 1 ? 'checked' : '';
						$check_b = $status->media_canasta == 1 ? 'checked' : '';
						$check_c = $status->adicional == 1 ? 'checked' : ''; ?>
			      	  	<tr>
			      	  	  	<td class="ingrediente"><?php echo $ingrediente['nombre']; ?></td>
			      	  	  	<td><input type="checkbox" name="ingredientes_canasta[<?php echo $key ?>][canasta_completa]" value="1" <?php echo $check_a; ?> ></td>
			      	  	  	<td><input type="checkbox" name="ingredientes_canasta[<?php echo $key ?>][media_canasta]" value="1" <?php echo $check_b; ?>></td>
			      	  	  	<td><input type="checkbox" name="ingredientes_canasta[<?php echo $key ?>][adicional]" value="1" <?php echo $check_c; ?>></td>
			      	  	  	<td><?php echo $ingrediente['puntos']; ?></td>

			      	  	</tr>
		      		<?php endforeach;
		      	endif; ?>
	      	</tbody>
	    </table>
	    <input class="button button-primary" type="submit" name="" id="" value="Enviar">
     </form>
</div>