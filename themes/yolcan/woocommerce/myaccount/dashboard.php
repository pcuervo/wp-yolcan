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
                                $direccion = get_post_meta(get_the_ID(), 'ubicacion-club', true); ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="club" value="<?php echo get_the_ID(); ?>">
                                        </td>
                                        <td>
                                            <?php the_title(); ?>
                                            <p><?php echo $direccion; ?></p>
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