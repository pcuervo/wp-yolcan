<?php global $current_user; 
global $opCliente; ?>
<article class="[ padding--bottom border-bottom margin-bottom ]">
	<h4>Tu próxima canasta - <span class="[ color-primary ]">$3,000</span></h4>
	<p>Media canasta para el 10 de junio:</p>
	<?php $ingredientes = array();
	if (isset($canasta->actualizacion)):
		if ($canasta->actualizacion->valor_puntos_completa < $saldo) $ingredientes = $canasta->getCanastaCompleta();
		if ($canasta->actualizacion->valor_puntos_completa > $saldo AND $canasta->actualizacion->valor_puntos_mitad < $saldo) $ingredientes = $canasta->getMediaCanasta();
	endif; ?>
	<ul class="[ list-style-none ][ padding--left ]">
		<?php if (!empty($ingredientes)):
			foreach ($ingredientes as $key => $ingrediente): ?>
				<li><?php echo $ingrediente->nombre_ingrediente; ?></li>
			<?php endforeach;
		else:
			echo '<p>Saldo insuficiente</p>';
		endif; ?>
	</ul>

	<h5>Productos agregados:</h5>
	<div class="[ margin-botton ]">
		<p>
            <span>
                <?php 
                $padicionalnombre = get_post_meta($current_user->ID, 'padicionalnombre', true);
                $padicionalprecio = get_post_meta($current_user->ID, 'padicionalprecio', true);
                $padicionalpeso = get_post_meta($current_user->ID, 'padicionalpeso', true);
                $padicionaltipo = get_post_meta($current_user->ID, 'padicionaltipo', true);
                $padicionalnumber = get_post_meta($current_user->ID, 'padicionalnumber', true);
                $padicionalocasion = get_post_meta($current_user->ID, 'padicionalocasion', true);
                ?>
                <?php echo $padicionalnumber; ?> | <?php echo $padicionalnombre; ?> - <?php echo $padicionalpeso; ?> <?php echo $padicionaltipo; ?> - $ <?php echo $padicionalprecio; ?>.00 | <?php echo $padicionalocasion; ?></span> 
            <small><a class="[ underline ][ color-secondary ]" href="#">eliminar</a></small>
        </p>
	</div>

	<a href="<?php echo site_url('/recetas/'); ?>" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
</article>

<article class="">
	<h4>Agrega productos</h4>
	<p>Selecciona los productos que deseas agregar a tu canasta:</p>
		<?php if (! empty($canasta) AND method_exists($canasta, 'getIngredientesAdicionales')) :
			$adicionales = $canasta->getIngredientesAdicionales();
			if ( ! empty($adicionales) ):
				foreach($adicionales as $data_ingrediente):
					$ingrediente = get_post($data_ingrediente->ingrediente_id);
                    $precio = get_post_meta($data_ingrediente->ingrediente_id, 'precio_ingrediente', true);
                    $peso = get_post_meta($data_ingrediente->ingrediente_id, 'cantidad_en_peso', true);
                    $tipo = get_post_meta($data_ingrediente->ingrediente_id, 'tipo_en_peso', true);
                    $user_id = get_current_user_id();
                    $user = get_userdata( $user_id );
                    if(isset($_POST['padicional'])) {
                            if($_POST['padicionalnumber']=='')
                            {
                                echo "Por favor indique el número.";
                            }
                            else
                            {
                                $postid = $current_user->ID;
                                $padicionalnombre = $_POST['padicionalnombre'];
                                $padicionalprecio = $_POST['padicionalprecio'];
                                $padicionalpeso = $_POST['padicionalpeso'];
                                $padicionaltipo = $_POST['padicionaltipo'];
                                $padicionalnumber = $_POST['padicionalnumber'];
                                $padicionalocasion = $_POST['padicionalocasion'];
                                update_post_meta($postid, 'padicionalnombre', $padicionalnombre );
                                update_post_meta($postid, 'padicionalprecio', $padicionalprecio );
                                update_post_meta($postid, 'padicionalpeso', $padicionalpeso );
                                update_post_meta($postid, 'padicionaltipo', $padicionaltipo );
                                update_post_meta($postid, 'padicionalnumber', $padicionalnumber );
                                update_post_meta($postid, 'padicionalocasion', $padicionalocasion );
                            }
                    }
                    $padicionalnombre = get_post_meta($current_user->ID, 'padicionalnombre', true);
                    $padicionalprecio = get_post_meta($current_user->ID, 'padicionalprecio', true);
                    $padicionalpeso = get_post_meta($current_user->ID, 'padicionalpeso', true);
                    $padicionaltipo = get_post_meta($current_user->ID, 'padicionaltipo', true);
                    $padicionalnumber = get_post_meta($current_user->ID, 'padicionalnumber', true);
                    $padicionalocasion = get_post_meta($current_user->ID, 'padicionalocasion', true);
                    ?>
                    <form method="post" id="contactus_form" action="">
					<div class="[ margin-bottom ]">
						<a data-toggle="collapse" href="#<?php echo $ingrediente->post_name; ?>" class="[ no-decoration color-dark color-dark-hover ]">
							<button type="submit" class="[ inline-block align-middle ][ btn btn-secondary ]">+</button>
							<p class="[ inline-block align-middle ][ no-margin ]"><?php echo $ingrediente->post_title; ?></p>
                            <input type="hidden" name="padicionalnombre" value="<?php echo $ingrediente->post_title; ?>">
						</a>
						<div id="<?php echo $ingrediente->post_name; ?>" class="[ panel-collapse collapse ][ padding--top ]">
							<p class="[ color-gray-xlight ]">Precio: $ <?php echo number_format($precio); ?>
                                <input type="hidden" name="padicionalprecio" value="<?php echo number_format($precio); ?>">
                            <br>Peso: <?php echo $peso; ?> <?php echo $tipo; ?></p>
                                <input type="hidden" name="padicionalpeso" value="<?php echo $peso; ?>">
                                <input type="hidden" name="padicionaltipo" value="<?php echo $tipo; ?>">
							<div class="[ row ]">
								<div class="[ col-xs-3 padding--right--small ]">
									<input type="number" name="padicionalnumber" class="[ width-90 padding--xsmall ][ form-control no-border no-border-radius bg-gray ]">
								</div>
								<div class="[ col-xs-5 no-padding ]">
									<div>
										<input type="radio" id="option11" name="padicionalocasion" value="Sólo esta ocación">
										<label for="option11"><span class="[ margin-right--xxsmall ]"></span> Sólo esta ocación</label>
									</div>
									<div>
										<input type="radio" id="option12" name="padicionalocasion" value="Cada semana">
										<label for="option12"><span class="[ margin-right--xxsmall ]"></span> Cada semana</label>
									</div>
								</div>
								<div class="[ col-xs-4 padding--left--small ]">
                                    <input type="submit" name="padicional" id="submit" class="[ btn btn-secondary padding--xsmall ][ margin-bottom ]" value="agregar"/>
								</div>
							</div>
						</div>
					</div>
                    </form>
				<?php endforeach;
			endif;
		endif; ?>
</article> <!-- /forms -->