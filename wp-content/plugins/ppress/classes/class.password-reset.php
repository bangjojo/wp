<?php

/**
 * Parent class that handles password reset
 *
 * Class ProfilePress_Password_Reset
 */
class ProfilePress_Password_Reset {


	public static function validate_password_reset_form($id) {
		// if password reset form have been submitted process it

		// filter to change password reset submit button name to avoid validation for forms on same page
		$submit_name = apply_filters('pp_password_reset_submit_name', 'password_reset_submit', $id);
		if ( isset( $_POST[$submit_name] ) ) {
			$password_reset = self::password_reset_status( esc_attr( $_POST['user_login'] ), $id );
		}

		// display form generated messages
		if ( isset( $password_reset ) ) {
			$password_reset_status = html_entity_decode( $password_reset );
		} else {
			$password_reset_status = '';
		}

		return $password_reset_status;

	}
	/**
	 * Does the heavy lifting of resetting password
	 *
	 * @param $user_login string username or email
	 *
	 * @return bool|WP_Error
	 */
	public static function retrieve_password_func( $user_login ) {
		global $wpdb, $wp_hasher;

		$errors = new WP_Error();

		if ( empty( $user_login ) ) {
			$errors->add( 'empty_username', __( 'Enter a username or e-mail address.' ) );
		} else if ( strpos( $user_login, '@' ) ) {
			$user_data = get_user_by( 'email', trim( $user_login ) );
			if ( empty( $user_data ) ) {
				$errors->add( 'invalid_email', __( 'There is no user registered with that email address.' ) );
			}
		} else {
			$login = trim( $user_login );
			$user_data = get_user_by( 'login', $login );
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 */
		do_action( 'lostpassword_post' );

		if ( $errors->get_error_code() ) {
			return $errors;
		}

		if ( !$user_data ) {
			$errors->add( 'invalidcombo', __( 'Invalid username or e-mail.' ) );

			return $errors;
		}

		// redefining user_login ensures we return the right case in the email
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.0
		 * @deprecated 1.5.1 Misspelled. Use 'retrieve_password' hook instead.
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retreive_password', $user_login );
		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.1
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retrieve_password', $user_login );

		/**
		 * Filter whether to allow a password to be reset.
		 *
		 * @since 2.7.0
		 *
		 * @param bool true           Whether to allow the password to be reset. Default true.
		 * @param int $user_data ->ID The ID of the user attempting to reset a password.
		 */
		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( !$allow ) {
			return new WP_Error( 'no_password_reset', __( 'Password reset is not allowed for this user' ) );
		} else if ( is_wp_error( $allow ) ) {
			return $allow;
		}

		// Generate something random for a password reset key.
		$key = wp_generate_password( 20, false );

		/**
		 * Fires when a password reset key is generated.
		 *
		 * @since 2.5.0
		 *
		 * @param string $user_login The username for the user.
		 * @param string $key The generated password reset key.
		 */
		do_action( 'retrieve_password_key', $user_login, $key );

		// Now insert the key, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

		$message = __( 'Someone requested that the password be reset for the following account:' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.' ) . "\r\n\r\n";
		$message .= __( 'To reset your password, visit the following address:' ) . "\r\n\r\n";
		$message .= '<' . network_site_url(
				"wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ),
				'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
		{
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title = sprintf( __( '[%s] Password Reset' ), $blogname );

		/**
		 * Filter the subject of the password reset email.
		 *
		 * @since 2.8.0
		 *
		 * @param string $title Default email title.
		 */
		$title = apply_filters( 'retrieve_password_title', $title );
		/**
		 * Filter the message body of the password reset mail.
		 *
		 * @since 2.8.0
		 *
		 * @param string $message Default mail message.
		 * @param string $key The activation key.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key );

		/** BEGIN custom added code to change the mail header name and email */

		$db_settings_data = get_option( 'pp_settings_data' );

		// sender name
		if ( empty( $db_settings_data['password_reset_sender_name'] ) || !isset( $db_settings_data['password_reset_sender_name'] ) ) {

			$password_reset_sender_name = get_option( 'blogname' );
		} else {
			$password_reset_sender_name = $db_settings_data['password_reset_sender_name'];
		}

		// sender email
		if ( empty( $db_settings_data['password_reset_sender_email'] ) || !isset( $db_settings_data['password_reset_sender_email'] ) ) {

			$password_reset_sender_email = pp_admin_email();
		} else {
			$password_reset_sender_email = $db_settings_data['password_reset_sender_email'];
		}

		// content type
		if ( empty( $db_settings_data['password_reset_type'] ) || !isset( $db_settings_data['password_reset_type'] ) ) {
			$password_reset_type = 'text/plain';
		} else {
			$password_reset_type = $db_settings_data['password_reset_type'];
		}

		$headers[] = "From: $password_reset_sender_name <$password_reset_sender_email>";
		$headers[] = "Content-type: $password_reset_type";

		/** END custom added code to change the mail header name and email */

		if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message, $headers ) ) {
			wp_die( __( 'The e-mail could not be sent.' ) . "<br />\n" . __( 'Possible reason: your host may have disabled the mail() function.' ) );
		}

		return true;
	}

	/**
	 * The error or success message received from the retrieve_password_func
	 *
	 * @param $user_login string username/email
	 * @param $form_id int password_reset id
	 *
	 * @return string
	 */
	public static function password_reset_status( $user_login, $form_id ) {

		/**
		 * Fires before password reset is processed
		 * @param $user_login string username/email
		 * @param $form_id int password reset builder ID
		 */
		do_action( 'pp_before_password_reset', $user_login, $form_id );

		/** filter to validate additional password field */
        $errors = '';
		$password_reset_validation = apply_filters( 'pp_password_reset_validation', $errors, $form_id );

		// if the action is contain WP_Error message, set the password response to the object
		// for reuse further down to return its WP_Error message
		if ( is_wp_error( $password_reset_validation ) && $password_reset_validation->get_error_code() != '' ) {
			$password_reset_response = $password_reset_validation;
		} else {
			$password_reset_response = self::retrieve_password_func( $user_login );
		}


		/**
		 * Fires after password reset is processed
		 * @param $user_login string username/email
		 * @param $password_reset_response string password reset response message
		 */
		do_action( 'pp_after_password_reset', $form_id, $user_login, $password_reset_response );

        // filter for the css class of the error message
        $password_reset_status_css_class = apply_filters('pp_password_reset_error_css_class', 'profilepress-reset-status', $form_id );

		// return the response of the password reset process
		if ( is_wp_error( $password_reset_response ) ) {

			return '<div class="' . $password_reset_status_css_class . '">' . $password_reset_response->get_error_message() . '</div>';
		} else {
			$message_on_password_reset = PROFILEPRESS_sql::get_db_success_password_reset( $form_id );

			return isset( $message_on_password_reset ) ? $message_on_password_reset : apply_filters( 'pp_default_password_reset_text', '<h4>' . __( 'Check your e-mail for further instruction', 'profilepress' ) . '</h4>' );
		}
	}
}