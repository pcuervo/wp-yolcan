<div class="wrap">
	<h1>Editar <?php echo $nombre_canasta; ?></h1>
	<hr>
	<form action="" method="POST">
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
						$status = isset($ingredientes_canasta[$key]) ? $ingredientes_canasta[$key] : ['canasta_completa' => '']; 
						$check_a = (isset($status->canasta_completa) AND $status->canasta_completa) == 1 ? 'checked' : '';
						$check_b = (isset($status->media_canasta) AND $status->media_canasta == 1) ? 'checked' : '';
						$check_c = (isset($status->adicional) AND $status->adicional == 1) ? 'checked' : ''; ?>
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
	    <input class="button button-primary" type="submit" name="" id="" value="Actualizar canasta">
     </form>
</div>