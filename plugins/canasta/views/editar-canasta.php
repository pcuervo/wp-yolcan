<div class="wrap">
	<h1><?php echo $idClub != 0 ? 'Club - '.get_the_title($idClub) : 'Canastas base'; ?></h1>
	<?php if($idClub == 0): ?>
		<div class="update-nag">
			IMPORTANTE!. Al actualizar las siguientes canastas, se actualizarán todas las canastas de los clubes con los mismos ingredientes
		</div>
	<?php endif; ?>
	<hr>
	<form action="" method="POST">
		<input type="checkbox" name="actualizacion" value="si"> *Proxima canasta para el viernes de la proxima semana
		<br>
		<p>* Al seleccionar esta guardando la canasta que se mostrara en la fecha indicada apartir de las 9:00 am</p>
		<table class="table-ingredientes">
	      	<thead>
	      	  	<tr>
	      	  	  	<th>Ingrediente</th>
	      	  	  	<?php if(!empty($productos)): 
	      	  	  		foreach ($productos as $key => $producto): ?>
	      	  	  			<th><?php echo $producto->post_title; ?></th>
	      	  	  		<?php endforeach;
	      	  	  	endif; ?>
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
			      	  	  	<?php if(!empty($productos)): 
			      	  	  		foreach ($productos as $key => $producto): 
			      	  	  			$idCanasta = $idClub.$producto->ID; ?>
			      	  	  			<td><input type="checkbox" name="ingredientes_canastas[<?php echo $idCanasta; ?>][]" value="<?php echo $ingrediente['ID']; ?>" <?php echo $check_a; ?>></td>
			      	  	  		<?php endforeach;
			      	  	  	endif; ?>
			      	  	</tr>
		      		<?php endforeach;
		      	endif; ?>
	      	</tbody>
	    </table>
		<?php $base = $idClub != 0 ? 'club' : 'base'; ?> 
		<input type="hidden" name="type" value="<?php echo $base; ?>">
		<input type="hidden" name="idActualizacion" value="0">

	    <input class="button button-primary" type="submit" name="" id="" value="Guardar canastas">
     </form>
</div>