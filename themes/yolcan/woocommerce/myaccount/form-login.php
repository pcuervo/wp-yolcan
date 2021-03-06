<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="col2-set" id="customer_login">

		<div class="col-1">

	<?php endif; ?>
		<div class="[ container ]">
			<div class="[ row padding--sides--xsm ]">
				<div class="[ col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 ][ bg-primary-darken ][ margin-top-bottom--large padding ][ color-light ]">
					<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

					<form method="post" class="login [ no-border ]" data-parsley-validate>

						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<p class="form-row form-row-wide">
							<label class="[ sans-serif ]" for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input type="text" class="input-text [ form-control no-border-radius color-gray-xlight height-30 bg-light ] " name="username" id="username" required data-parsley-error-message="El nombre de usuario o email es obligatorio." value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
						</p>
						<p class="form-row form-row-wide">
							<label class="[ sans-serif ]" for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input class="input-text [ form-control no-border-radius color-gray-xlight height-30 bg-light ]" type="password" name="password" id="password" required data-parsley-required-message="Favor de ingresar una contraseña."/>
						</p>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<p class="form-row [ text-center ]">
							<?php wp_nonce_field( 'woocommerce-login' ); ?>
							<input type="submit" class="button btn btn-lg [ input-btn-secondary ]" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
						</p>
						<p class="lost_password [ text-center ]">
							<a class="[ link-light ][ color-light ]" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
						</p>

						<p class="[ text-center ]">
							<a data-toggle="modal" data-target="#unete" class="[ inline-block align-middle ][ btn btn-secondary margin-top--small ]">registrate</a>
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>

					</form>
				</div>
			</div>
		</div>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

		</div>

		<div class="col-2">

			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="form-row form-row-wide">
						<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>

				<?php endif; ?>

				<p class="form-row form-row-wide">
					<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="form-row form-row-wide">
						<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="password" class="input-text" name="password" id="reg_password" />
					</p>

				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>

	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
