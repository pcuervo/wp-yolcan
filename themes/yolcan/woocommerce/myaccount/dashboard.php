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
            <?php if ($opCliente->clubId == ''): ?>
                <article class="[ padding--bottom margin-bottom ]">
                    <p>Para continuar favor de seleccionar un clube de consumo</p>
                    <form>
                        <table>
                            <tr>
                                <th></th>
                                <th>Club</th>
                            </tr>
                            <tr>
                                <td> <input type="radio" name="club" value="id"> </td>
                                <td>Maria Anders</td>
                            </tr>
                            
                        </table>
                        <input type="submit" value="Guardar">
                    </form>
                </article>

            <?php else:
                wc_get_template( 'myaccount/template/cuenta.php' );
            endif; ?>

		</section>
	</div>
</div>