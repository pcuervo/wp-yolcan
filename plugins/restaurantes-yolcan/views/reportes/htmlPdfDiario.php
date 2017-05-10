<html>
	<head>
	 	<title>Reporte diario PDF</title>
	 	<link href="http://fonts.googleapis.com/css?family=Roboto:300,500,400,700" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo PATH_RESTAURANTES; ?>/resources/style-pdf.css" type="text/css"/>
	</head>
	<body>
  		<center>
   			<h3>Reporte diario restaurantes con fecha <?php echo $resporte_del; ?></h3>
  		</center>
  		<br />
  		<?php if(!empty($results)):
			$resporte_del = isset($_GET['resporte_del']) ? $_GET['resporte_del'] : '';
		
			foreach ($results as $key => $restaurante):
				$user = get_user_by( 'id', $restaurante->restaurante_id ); ?>
				<div class="container-restaurant-report">
					<h3><?php echo $user->user_login; ?></h3>
					<table>
						<?php $ingredientes = unserialize($restaurante->ingredientes);
						if(!empty($ingredientes)): 
							foreach (array_chunk($ingredientes, 3) as $key => $ingredientes_r) : 
								echo '<tr>';
								foreach ($ingredientes_r as $key => $ingrediente):
									$terms = wp_get_post_terms( $ingrediente['id'], 'unidades' );
		                			$unidad = isset($terms[0]) ? $terms[0]->name : ''; ?>
		                			
							    	<td width="240px">(<?php echo $ingrediente['cantidad']; ?> <strong><?php echo $unidad ?></strong>) <?php echo get_the_title($ingrediente['id']); ?> ($<?php echo $ingrediente['costo']; ?>)</td>
							
								<?php endforeach;
								echo '</tr>';
							endforeach;
						endif;  ?>
					</table>
					<p class="total-corte">Total del corte: $<?php echo $restaurante->total_corte; ?></p>
				</div>
			<?php endforeach;
		else:
			echo '<p>No se encontraron resultados para la fecha <strong>'.$resporte_del.'</strong></p>';
		endif; ?>
 	</body>
</html>