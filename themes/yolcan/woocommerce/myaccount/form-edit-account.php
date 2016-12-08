<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

<div class="[ container ][ margin-bottom ]">
	<!-- foto usuario -->
	<div class="[ col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-5 ][ margin-top-bottom ]">
		<img class="[ img-user img-responsive ]" src="<?php echo THEMEPATH; ?>images/profile.png">
	</div>

	<div class="[ col-xs-12 col-sm-6 col-sm-offset-3 ]">
		<div class="[ margin-top-bottom ]">
			<input class="" type="file" id="exampleInputFile">
		</div>
	</div>

	<form class="edit-account" action="" method="post">
		<div class="[ col-xs-12 col-sm-6 col-sm-offset-3 ]">

			<p class="form-row form-row-wide ">
				<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</p>
			<div class="clear"></div>
			<p class="form-row form-row-wide">
				<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</p>

			<p class="form-row form-row-first">
				<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="tel" class="input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $user->user_tel ); ?>" />
			</p>

		</div>

		<div class="[ col-xs-12 col-sm-6 col-sm-offset-3 ][ margin-top ]">
			<fieldset>
				<legend><?php _e( 'Password Change', 'woocommerce' ); ?></legend>

				<p class="form-row form-row-wide">
					<label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_current" id="password_current" />
				</p>
				<p class="form-row form-row-wide">
					<label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_1" id="password_1" />
				</p>
				<p class="form-row form-row-wide">
					<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_2" id="password_2" />
				</p>
			</fieldset>
		</div>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

		<p class="[ col-xs-12 col-sm-6 col-sm-offset-3 ]">
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="button [ input-btn-secondary ][ pull-right ]" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</p>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

	</form>

</div>
