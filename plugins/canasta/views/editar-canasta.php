<div class="wrap">
	<h1><?php echo $titulo; ?></h1>
	<h3>
        <?php echo $idClub != 1 ? 'Club - '.get_the_title($idClub) : 'Canastas base'; ?>
    </h3>
	<?php if($idClub == 0): ?>
		<div class="update-nag">
			IMPORTANTE!. Al actualizar ó crear las siguientes canastas, se actualizarán todas las canastas de los clubes con los mismos ingredientes
		</div>
	<?php endif; ?>
	<hr>
	<form action="<?php echo admin_url().'admin.php?page='.$action.'_canastas&id_club='.$idClub; ?>" method="POST">

		<?php $actualizacion = isset($ingredientesCanastas['actualizacion']) ? $ingredientesCanastas['actualizacion'] : []; 
		if ($_GET['page'] == 'programar_canastas' || $_GET['page'] == 'editar_canastas_programadas'):
			$activar = isset($actualizacion->fecha_activar_canasta) ? $actualizacion->fecha_activar_canasta : ''; ?>
			<label for="fecha_activar_canasta">Fecha en que se mostarara</label>
			<input type="text" class="date-picker" name="fecha_activar_canasta" value="<?php echo $activar; ?>">
			<hr>
		<?php endif; ?>
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
					$ingrdientesCheck = isset($ingredientesCanastas['canastas']) ? $ingredientesCanastas['canastas'] : [];
					foreach ($ingredientes as $key => $ingrediente) :
						$terms = wp_get_post_terms( $ingrediente['ID'], 'unidades' ); ?>
			      	  	<tr>
			      	  	  	<td class="ingrediente"><?php echo $ingrediente['nombre']; ?> ( <?php echo isset($terms[0]) ? $terms[0]->name : ''; ?> )</td>
			      	  	  	<?php if(!empty($productos)): 
			      	  	  		foreach ($productos as $key => $producto):
			      	  	  			$idCanasta = $idClub.$producto->ID;
			      	  	  			$unidad = isset($ingrdientesCheck[$idCanasta][$ingrediente['ID']]) ? $ingrdientesCheck[$idCanasta][$ingrediente['ID']]->cantidad : '';
			      	  	  			$check = isset($ingrdientesCheck[$idCanasta][$ingrediente['ID']]) ? 'checked' : ''; ?>
			      	  	  			<td>
			      	  	  				<input type="checkbox" name="ingredientes_canastas[ingredientes][<?php echo $idCanasta; ?>][]" value="<?php echo $ingrediente['ID']; ?>" <?php echo $check; ?>>
			      	  	  				<input type="text" name="ingredientes_canastas[unidades][<?php echo $idCanasta; ?>][<?php echo $ingrediente['ID']; ?>]" value="<?php echo $unidad; ?>" placeholder="unidades">
			      	  	  			</td>
			      	  	  			
			      	  	  		<?php endforeach;
			      	  	  	endif; ?>
			      	  	</tr>
		      		<?php endforeach;
		      	endif; ?>
	      	</tbody>
	    </table>
		<?php $base = $idClub != 0 ? 'club' : 'base'; 
		if ($action == 'update'):
			echo '<input type="hidden" name="idActualizacion" value="'.$actualizacion->actualizacion_id.'">';
		endif; ?> 
		<input type="hidden" name="type" value="<?php echo $base; ?>">
		<input type="hidden" name="action" value="<?php echo $action; ?>">

	    <input class="button button-primary" type="submit" name="" id="" value="Guardar canastas">
     </form>
</div>