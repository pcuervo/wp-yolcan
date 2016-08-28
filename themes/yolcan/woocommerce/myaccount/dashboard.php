<?php global $opCliente; ?>
<div class="[ container ]"><!-- end ina my-address -->
	<div class="[ row ]">

		<section class="[ col-sm-3 ][ bg-gray-lighter ]">
			<article class="[ margin-bottom ]">
				<?php
					printf(
						__( '<h2 class="[ no-margin ]">%1$s</h2> <a href="%2$s" class="[ underline ][ color-secondary ]"><em>salir</em></a>', 'woocommerce' ) . ' ',
						$current_user->display_name,
						wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
					);
					printf( __( '<a class="[ color-secondary ][ underline ]" href="%s"><em>editar</em></a>', 'woocommerce' ),
						wc_customer_edit_account_url()
					);
				?>
			</article>

			<article>
				<?php wc_get_template( 'myaccount/my-address.php' ); ?>
			</article>

		</section>

		<section class="[ col-xs-12 col-sm-8 ]">
            <?php if ($opCliente->clubId == '' || $opCliente->clubId == 0): ?>
                <article class="[ padding--bottom margin-bottom ]">
                    <p>Para continuar favor de seleccionar un club de consumo</p>
                    <form id="select-club" method="POST" class="select-club">
                        <table>
                            <tr>
                                <th></th>
                                <th>Club</th>
                            </tr>
                            <?php $clubes = new WP_Query([
                                'post_type' => 'clubes-de-consumo',
                                'posts_per_page' => -1

                                ]);
                            if ( $clubes->have_posts() ):
                                while ( $clubes->have_posts() ): $clubes->the_post();
                                $direccion = get_post_meta(get_the_ID(), 'ubicacion-club', true);
                                $latitud_club = get_post_meta(get_the_ID(), 'ubicacion-club', true);
                                $longitud_club = get_post_meta(get_the_ID(), 'ubicacion-club', true);
                                $dias_de_recoleccion = get_post_meta(get_the_ID(), 'dias-de-recoleccion', true);
                                $dias_de_recoleccion_a = get_post_meta(get_the_ID(), 'dias-de-recoleccion-a', true);
                                $horarios_de_recoleccion = get_post_meta(get_the_ID(), 'horarios-de-recoleccion', true);
                                $nombre_encargado_club = get_post_meta(get_the_ID(), 'nombre-encargado-club', true);
                                $telefono_encargado_club = get_post_meta(get_the_ID(), 'telefono-encargado-club', true); ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="club" value="<?php echo get_the_ID(); ?>">
                                        </td>
                                        <td>
                                            <?php the_title(); ?>
                                            <div class="map-wrap iframe-cont [ margin-top-bottom--small ]">
                                                <div class="overlay" onClick="style.pointerEvents='none'"></div><!-- wrap map iframe to turn off mouse scroll and turn it back on on click -->
                                                <iframe class="map" width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $latitud_club; ?>,<?php echo $longitud_club; ?>&hl=es;z=14&amp;output=embed"></iframe>
                                            </div>
                                            <p><?php echo $direccion; ?></p>
                                            <p>Recolección del <?php echo $dias_de_recoleccion; ?> al <?php echo $dias_de_recoleccion_a; ?> </p>
                                            <p>Horario de recolección: <?php echo $horarios_de_recoleccion; ?></p>
                                            <p>Encargado del Club: <?php echo $nombre_encargado_club; ?></p>
                                            <p>Teléfono del encargado: <?php echo $telefono_encargado_club; ?></p>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            endif; ?>

                        </table>
                        <br>
                        <input class="[ btn btn-secondary ]" type="submit" value="guardar">
                    </form>

                </article>

            <?php else:
                get_template_part('woocommerce/myaccount/templates/cuenta');
            endif; ?>

		</section>
	</div>
</div>