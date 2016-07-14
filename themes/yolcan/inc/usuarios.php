<?php
//PRUEBA DE PLUGIN
//$wp_roles = new WP_Roles(); $wp_roles->remove_role("cobranza");
//$wp_roles = new WP_Roles(); $names = $wp_roles->get_names(); print_r($names);

add_action('admin_init','add_role_practicantes',999);
function add_role_practicantes() {

		$roles = array('practicantes','administrator','cobranza');

		foreach($roles as $the_role) {

		     $role = get_role($the_role);

	             $role->add_cap('read');
	             $role->add_cap('read_receta');
	             $role->add_cap('read_private_recetas');
	             $role->add_cap('edit_receta');
	             $role->add_cap('edit_recetas');
	             $role->add_cap('edit_others_recetas');
	             $role->add_cap('edit_published_recetas');
	             $role->add_cap('publish_recetas');
	             $role->add_cap('delete_others_recetas');
	             $role->add_cap('delete_private_recetas');
	             $role->add_cap('delete_published_recetas');
                     $role->add_cap('read_ingrediente');
	             $role->add_cap('read_private_ingredientes');
	             $role->add_cap('edit_ingrediente');
	             $role->add_cap('edit_ingredientes');
	             $role->add_cap('edit_others_ingredientes');
	             $role->add_cap('edit_published_ingredientes');
	             $role->add_cap('publish_ingredientes');
	             $role->add_cap('delete_others_ingredientes');
	             $role->add_cap('delete_private_ingredientes');
	             $role->add_cap('delete_published_ingredientes');
                     $role->add_cap('read_faq');
	             $role->add_cap('read_private_faqs');
	             $role->add_cap('edit_faq');
	             $role->add_cap('edit_faqs');
	             $role->add_cap('edit_others_faqs');
	             $role->add_cap('edit_published_faqs');
	             $role->add_cap('publish_faqs');
	             $role->add_cap('delete_others_faqs');
	             $role->add_cap('delete_private_faqs');
	             $role->add_cap('delete_published_faqs');
                     $role->add_cap('read_contacto');
	             $role->add_cap('read_private_contactos');
	             $role->add_cap('edit_contacto');
	             $role->add_cap('edit_contactos');
	             $role->add_cap('edit_others_contactos');
	             $role->add_cap('edit_published_contactos');
	             $role->add_cap('publish_contactos');
	             $role->add_cap('delete_others_contactos');
	             $role->add_cap('delete_private_contactos');
	             $role->add_cap('delete_published_contactos');
                     $role->add_cap('read_club-de-consumo');
	             $role->add_cap('read_private_club-de-consumos');
	             $role->add_cap('edit_club-de-consumo');
	             $role->add_cap('edit_club-de-consumos');
	             $role->add_cap('edit_others_club-de-consumos');
	             $role->add_cap('edit_published_club-de-consumos');
	             $role->add_cap('publish_club-de-consumos');
	             $role->add_cap('delete_others_club-de-consumos');
	             $role->add_cap('delete_private_club-de-consumos');
	             $role->add_cap('delete_published_club-de-consumos');

		}
}

add_role('cobranza', __('Cobranza'),
    array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => false,
        'publish_posts' => false,
        'upload_files' => true,
    )
);

add_role('practicantes', __('Practicantes'),
    array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => false,
        'publish_posts' => false,
        'upload_files' => true,
        'read_recetas' => true,
        'edit_recetas' => true,
        'read_ingredientes' => true,
        'edit_ingredientes' => true,
        'read_faq' => false,
        'read_faqs' => false,
        'edit_faq' => false,
        'edit_faqs' => false,

        'edit_contacto' => false,
        'edit_contactos' => false,
        'publish_contacto' => false,
        'publish_contactos' => false,
        'read_contacto' => false,
        'read_contactos' => false,


        'edit_club-de-consumo' => false,
        'edit_club-de-consumos' => false,
        'publish_club-de-consumo' => false,
        'publish_club-de-consumos' => false,
        'read_club-de-consumo' => false,
        'read_club-de-consumos' => false,

    )
);

/*-------------------------------------AGREGAR SALDO MANUALMENTE POR USUARIO - ADMINISTRADOR---------------*/

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Agregar saldo", "blank"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="address"><?php _e("Cantidad ($)"); ?></label></th>
            <td>
                <input type="text" name="cantidad_saldo" id="cantidad_saldo" value="<?php echo esc_attr( get_the_author_meta( 'cantidad_saldo', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e("Agregar cantidad a usuario."); ?></span>
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
    update_user_meta( $user_id, 'cantidad_saldo', $_POST['cantidad_saldo'] );
}

/*--------------------------------CUENTA POR USUARIO----------------------------------------*/

function cuentausuario_shortcode() {
    get_currentuserinfo();
    $order_count="1";
    global $current_user;
    global $post;
    //echo 'User email: ' . $current_user->user_email . "\n";
    $my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
        'order-number'  => __( 'Order', 'woocommerce' ),
        'order-date'    => __( 'Date', 'woocommerce' ),
        'order-status'  => __( 'Status', 'woocommerce' ),
        'order-total'   => __( 'Total', 'woocommerce' ),
        'order-actions' => '&nbsp;',
    ));
    $customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
        'numberposts' => $order_count,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types( 'view-orders' ),
        'post_status' => array_keys( wc_get_order_statuses())
    )));
    if ( $customer_orders ) : 
        $i="0";
        foreach ( $customer_orders as $customer_order ) :
                        $order      = wc_get_order( $customer_order );
                        $item_count = $order->get_item_count();
                        $item_meta = "";
                        $item_price = $order->get_total();
                        $items = $order->get_items();
                        
                        ?>
                        <article class="[ padding--bottom margin-bottom ]">
                        <h4>Tu cuenta <?php echo $current_user->user_login; ?>:</h4>
                        <p>Tu saldo es de <strong><?php echo sprintf( _n( '%s', '%s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); ?></strong> (Estado <?php echo wc_get_order_status_name( $order->get_status() ); ?>)</p>
                        <p>Sus productos:</p>
                        <ul>
                        <?php
                        echo $item_meta;
                            foreach ( $items as $item ) {
                              $product_id = $item['product_id'];
                              $product_name = $item['name'];
                              $variation_id = $item['variation_id'];
                              $variation_name = get_post_meta( $variation_id, 'attribute_pa_temporalidad', true);
                              echo '<li>';
                              echo $product_name;
                              //$product_id;
                              //$item_price;
                              //echo $variation_id;
                              //echo $variation_name;
                              echo '</li>';
                            }
                        ?>
                        </ul>
                        <p>Su saldo fue pagado el <strong><time datetime="<?php echo date( 'Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time></strong></p>                                        
                        <?php 
                            if (++$i == 1) break;
                            endforeach; 
                        endif;
                        //$saldo_agregado = get_the_author_meta( 'cantidad_saldo', $current_user->ID );
                        ?>
                            <a href="<?php echo site_url('nuestros-productos/'); ?>" class="[ btn btn-secondary btn-small ]">agrega saldo a tu cuenta</a>
                            </article>
    
                            <article class="[ padding--bottom border-bottom margin-bottom padding-top ]">
                                <?php
                                    if(isset($_POST['reanudar'])){
                                        echo "<p>Gracias ".$current_user->user_login.", tus entregas han sido reanudadas!</p>";
                                    }                        
                                    if(isset($_POST['proses'])){                        
                                        $suspension=$_POST['suspension'];                      
                                        echo '<p>'.$current_user->user_login.', tus entregas han sido suspendidas por: <strong class="[ color-primary ]">'.$suspension.'</strong></p>';
                                        echo '<p class="[ margin-top--large ]">Desea <strong>renudar</strong> sus entregas?</p>';
                                        ?>
                                            <form method="post">
                                                <input type="submit" name="reanudar" class="[ btn btn-secondary btn-small ][ margin-bottom--large ]" value="Reanudar entregas" />
                                            </form>
                                        <?php
                                    } else {
                                        ?>
                                        <p>Desea <strong>suspender</strong> sus entregas?</p>
                                            <form method="post">
                                              <div class="[ margin-bottom--small ]">
                                                    <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1 semana" checked="checked">
                                                    <label for="suspender-1">1 Semana</label>
                                              </div>
                                              <div class="[ margin-bottom--small ]">
                                                    <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2 semanas">
                                                    <label for="suspender-2">2 Semanas</label>
                                              </div>
                                              <div class="[ margin-bottom--small ]">
                                                    <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3 Semanas">
                                                    <label for="suspender-3">3 Semanas</label>
                                              </div>
                                              <div class="[ margin-bottom--small ]">
                                                    <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4 Semanas">
                                                    <label for="suspender-4">4 Semanas</label>
                                               </div>
                                               <input type="submit" name="proses" id="submit" class="[ btn btn-secondary btn-small ][ margin-bottom ]" value="suspender entrega"/>  
                                            </form>
                                    <?php
                                       }
                                ?>
                            </article>

                            <article class="[ padding--bottom border-bottom margin-bottom ]">
                                <?php
                                $day = date('w');
                                $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
                                $week_end = date('j M Y', strtotime('+'.(5-$day).' days'));
                                ?>
                                    <h4>Tu próxima canasta - <span class="[ color-primary ]">
                                        <?php $variation_name; 
                                        echo $item_meta;
                                            foreach ( $items as $item ) {
                                              $item_price = $order->get_total();
                                              $product_id = $item['product_id'];
                                              $variation_name = get_post_meta( $variation_id, 'attribute_pa_temporalidad', true);
                                              
                                              if ($variation_name==="mensual"){
                                                  $uno="4";
                                                  $totalmensual=$item_price/$uno;
                                                  echo '$ '.number_format($totalmensual,2);
                                              }
                                              if ($variation_name==="trimestral"){
                                                  $tres="12";
                                                  $totaltrimestral=$item_price/$tres;
                                                  echo '$ '.number_format($totaltrimestral,2);
                                              }
                                              if ($variation_name==="semestral"){
                                                  $seis="24";
                                                  $totalsemestral=$item_price/$seis;
                                                  echo '$ '.number_format($totalsemestral,2);
                                              }
                                              //echo $variation_name;
                                            }
                                        ?>
                                        </span></h4>
                                    <p>Media canasta para el <?php echo $week_end; ?>:</p>
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
                                                <?php echo $padicionalnumber; ?> | <?php echo $padicionalnombre; ?> - <?php echo $padicionalpeso; ?> <?php echo $padicionaltipo; ?> - $ <?php echo $padicionalprecio; ?>.00 | <?php echo $padicionalocasion; ?>
                                            </span> 
                                            <small><a class="[ underline ][ color-secondary ]" href="#">eliminar</a></small>
                                        </p>
                                    </div>
                                    <a href="<?php echo site_url('/recetas/'); ?>" class="[ underline ][ color-secondary ]"><em>Consulta recetas con estos ingredientes</em></a>
                            </article>
    
    
    
                            <article class="">
				<h4>Agrega productos</h4>
				<p>Selecciona los productos que deseas agregar a tu canasta:</p>
				<?php 
                                    $canasta = get_post_type( 'canastas' );
                                    if (! empty($canasta) AND method_exists($canasta, 'getIngredientesAdicionales')) :
                                    $adicionales = $canasta->getIngredientesAdicionales();
                                        if ( ! empty($adicionales) ):
                                            foreach($adicionales as $data_ingrediente):
                                                $ingrediente = get_post($data_ingrediente->ingrediente_id);
                                                $precio = get_post_meta($data_ingrediente->ingrediente_id, 'precio_ingrediente', true);
                                                $peso = get_post_meta($data_ingrediente->ingrediente_id, 'cantidad_en_peso', true);
                                                $tipo = get_post_meta($data_ingrediente->ingrediente_id, 'tipo_en_peso', true);
                                                $user_id = get_current_user_id();
                                                $user = get_userdata( $user_id );
                                                
                                                
                                                echo $precio;
                                                
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
    
                        <?php   
}
add_shortcode( 'yolcan-cuentausuario', 'cuentausuario_shortcode' );

/*-------------------------------------CANCELAR - REANUDAR ENTREGA DE CANASTAS POR USUARIO----------------------------------------*/

function suspension_form_code() {
    global $current_user;
    if(isset($_POST['reanudar'])){
        echo "<p>Gracias ".$current_user->user_login.", tus entregas han sido reanudadas!</p>";
    }                        
    if(isset($_POST['proses'])){                        
        $suspension=$_POST['suspension'];                      
        echo '<p>'.$current_user->user_login.', tus entregas han sido suspendidas por: <strong class="[ color-primary ]">'.$suspension.'</strong></p>';
        echo '<p class="[ margin-top--large ]">Desea <strong>renudar</strong> sus entregas?</p>';
        ?>
            <form method="post">
                <input type="submit" name="reanudar" class="[ btn btn-secondary btn-small ][ margin-bottom--large ]" value="Reanudar entregas" />
            </form>
        <?php
    } else {
        ?>
        <p>Desea <strong>suspender</strong> sus entregas?</p>
            <form method="post">
              <div class="[ margin-bottom--small ]">
                    <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1 semana" checked="checked">
                    <label for="suspender-1">1 Semana</label>
              </div>
              <div class="[ margin-bottom--small ]">
                    <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2 semanas">
                    <label for="suspender-2">2 Semanas</label>
              </div>
              <div class="[ margin-bottom--small ]">
                    <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3 Semanas">
                    <label for="suspender-3">3 Semanas</label>
              </div>
              <div class="[ margin-bottom--small ]">
                    <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4 Semanas">
                    <label for="suspender-4">4 Semanas</label>
               </div>
               <input type="submit" name="proses" id="submit" class="[ btn btn-secondary btn-small ][ margin-bottom ]" value="suspender entrega"/>  
            </form>
    <?php
       }
}

function suspensioncanastas() {
    if ( isset( $_POST['prosessss'] ) ) {
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $subject = sanitize_text_field( $_POST["cf-subject"] );
        $message = esc_textarea( $_POST["cf-message"] );
        $to = get_option( 'admin_email' );
        $headers = "From: $name <$email>" . "\r\n";
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p>Thanks for contacting me, expect a response soon.</p>';
            echo '</div>';
        } else {
            echo 'An unexpected error occurred';
        }
    }
}

function canastas_supendidas_shortcode() {
    ob_start();
    suspensioncanastas();
    suspension_form_code();

    return ob_get_clean();
}

add_shortcode( 'yolcan-suspension-canastas', 'canastas_supendidas_shortcode' );


/*-------------------------------ADMINISTRADOR DE USUARIO--------------------------------------------*/

/*---------------------------------------------------
register settings
----------------------------------------------------*/
function theme_settings_init(){
register_setting( 'theme_settings', 'theme_settings' );
}

function add_settings_page() {
add_menu_page( __('Panel YOLCAN'), __('Panel YOLCAN'), 'manage_options', 'settings', 'theme_settings_page');
}

add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );

function theme_settings_page() {
    global $wpdb;
    $args = array(
        'number' => 1000,
    );

    $user_query = new WP_User_Query( $args );
?>
    <div class="wrap">
        <div id="icon-options-general"></div>
        <h2>Administrador YOLCAN</h2>    
        <table class="widefat fixed" cellspacing="0">
            <thead>
            <tr>
                <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
                <th id="columnname" class="manage-column column-columnname" scope="col">USUARIO</th>
                <th id="columnname" class="manage-column column-columnname" scope="col">SALDO</th>
                <th id="columnname" class="manage-column column-columnname" scope="col">CLUB DE CONSUMO</th>
                <th id="columnname" class="manage-column column-columnname" scope="col">EMAIL</th>
                <th id="columnname" class="manage-column column-columnname" scope="col">INGREDIENTES ADICIONALES</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th class="manage-column column-cb check-column" scope="col"></th>
                <th class="manage-column column-columnname" scope="col"></th>
                <th class="manage-column column-columnname" scope="col"></th>
                <th class="manage-column column-columnname" scope="col"></th>
                <th class="manage-column column-columnname" scope="col" colspan="2">Administrador de acciones de usuarios YOLCAN</th>
            </tr>
            </tfoot>

            <tbody>
                <?php
                    if ( ! empty( $user_query->results ) ) {
                    foreach ( $user_query->results as $user ) {
                        
                        $usuarioiud= $user->ID;
                        $customer = new WP_User( $usuarioiud );
                        $last_order = $wpdb->get_row( "SELECT id, post_date_gmt
						FROM $wpdb->posts AS posts
						LEFT JOIN {$wpdb->postmeta} AS meta on posts.ID = meta.post_id
						WHERE meta.meta_key = '_customer_user'
						AND   meta.meta_value = {$customer->ID}
						AND   posts.post_type = 'shop_order'
						AND   posts.post_status IN ( '" . implode( "','", array_keys( wc_get_order_statuses() ) ) . "' )
						ORDER BY posts.ID DESC
					" );
                                                
                                                
                        $customer_data = array(
                            'id'               => $customer->ID,
                            'email'            => $customer->user_email,
                            'first_name'       => $customer->first_name,
                            'last_name'        => $customer->last_name,
                            'username'         => $customer->user_login,
                            'role'             => $customer->roles[0],
                            'last_order_id'    => is_object( $last_order ) ? $last_order->id : null,
                            'orders_count'     => wc_get_customer_order_count( $customer->ID ),
                            'total_spent'      => wc_format_decimal( wc_get_customer_total_spent( $customer->ID ), 2 ),
                            'billing_address'  => array(
                              'first_name' => $customer->billing_first_name,
                              'last_name'  => $customer->billing_last_name,
                              'company'    => $customer->billing_company,
                              'address_1'  => $customer->billing_address_1,
                              'address_2'  => $customer->billing_address_2,
                              'city'       => $customer->billing_city,
                              'state'      => $customer->billing_state,
                              'postcode'   => $customer->billing_postcode,
                              'country'    => $customer->billing_country,
                              'email'      => $customer->billing_email,
                              'phone'      => $customer->billing_phone,
                            ),
                            'shipping_address' => array(
                              'first_name' => $customer->shipping_first_name,
                              'last_name'  => $customer->shipping_last_name,
                              'company'    => $customer->shipping_company,
                              'address_1'  => $customer->shipping_address_1,
                              'address_2'  => $customer->shipping_address_2,
                              'city'       => $customer->shipping_city,
                              'state'      => $customer->shipping_state,
                              'postcode'   => $customer->shipping_postcode,
                              'country'    => $customer->shipping_country,
                            ),
                          );
                ?>
                <tr class="alternate" valign="top">
                    <th class="check-column" scope="row"></th>
                    <td class="column-columnname">
                        <?php echo '<span>' . $user->ID . '</span>'; ?> | 
                        <?php echo '<span>' . $customer->first_name . '</span>'; ?>
                        <?php echo '<span>' . $customer->billing_last_name . '</span>'; ?>
                        <div class="row-actions">
                            <span><a href="#">Editar</a> |</span>
                            <span><a href="#">Eliminar</a></span>
                        </div>
                    </td>
                    <td class="column-columnname">
                        <?php
                            $total=wc_format_decimal( wc_get_customer_total_spent( $customer->ID ), 2 );
                            if ($total != "0.00"){
                                echo '<span>$ ' . number_format($total) . '.00</span>';
                            } else {
                                echo 'Sin saldo';
                            }
                        ?>
                    </td>
                    <td class="column-columnname"></td>
                    <td class="column-columnname">
                        
                    </td>
                    <td class="column-columnname"></td>
                </tr>
                
                <?php
                        }
                } else {
                        echo 'No users found.';
                }

                ?>
            </tbody>   
        </table>
    </div>
<?php
}

add_action( 'init', 'yolcanastas_post_type' );
function yolcanastas_post_type() {
register_post_type( 'yolcanastas',
    array (
        'labels' => array(
        'name' => 'Canastas Yolcan',
        'singular_name' => 'Canastas Yolcan',
        'add_new' => 'Agregar Canasta',
        'add_new_item' => 'Agregar nueva canasta',
        'edit' => 'Editar',
        'edit_item' => 'Editar Canasta',
        'new_item' => 'Nueva Canasta',
        'view' => 'Ver',
        'view_item' => 'Ver Canasta',
        'search_items' => 'Buscar Canasta',
        'not_found' => 'No se encontraron Canastas',
        'not_found_in_trash' =>
        'No hay canastas en basura',
        'parent' => 'Parent Book Review'
        ),
        
        'public' => true,
        'menu_position' => 20,
        'supports' =>
        array( 'title', 'thumbnail'),
        'taxonomies' => array( '' ),
        'menu_icon' =>
            plugins_url( 'canasta.png', __FILE__ ),
        'has_archive' => true
    )
);
}

add_action( 'admin_init', 'ingreyolcan_admin_init' );
function ingreyolcan_admin_init() {
    add_meta_box( 'ingreyolcan_meta_box',
    'Ingredientes en canasta',
    'ingreyolcan_meta_box',
    'yolcanastas', 'normal', 'high' );
}
function ingreyolcan_meta_box( $yolcanastas ) {
$book_author = esc_html( get_post_meta( $yolcanastas->ID, 'book_author', true ) );
$ingrediente = esc_html( get_post_meta( $yolcanastas->ID, 'ingrediente', true ) );
$args = array('post_type' => 'ingredientes');
$loop = new WP_Query( $args );
echo "<ul>";
while ( $loop->have_posts() ) : $loop->the_post();
?>
     <li><label><input type="checkbox" value="<?php echo $ingrediente; ?>" name="<?php the_title(); ?>" /> <?php the_title(); ?></label></li>
<?php 
endwhile;
echo "</ul>";
?>
    <table>
        <tr>
            <td style="width: 100%">Club de Consumo</td>
            <td><input type="text" size="80" name="book_review_author_name" value="<?php echo $book_author; ?>" /></td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'yolcanastas_fields', 10, 2 );
function yolcanastas_fields( $yolcanastas_id, $yolcanastas ) {
if ( $yolcanastas->post_type == 'yolcanastas' ) {
    
    if ( isset( $_POST['book_review_author_name'] ) && $_POST['book_review_author_name'] != '' ) {
        update_post_meta( $yolcanastas_id, 'book_author',
        $_POST['book_review_author_name'] );
        }
    
    
    if ( isset( $_POST['ingrediente'] ) && $_POST['ingrediente'] != '' ) {
        update_post_meta( $yolcanastas_id, 'ingrediente',
        $_POST['ingrediente'] );
        }
    
}
}