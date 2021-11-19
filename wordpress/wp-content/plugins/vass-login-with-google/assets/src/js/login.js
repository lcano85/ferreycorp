/**
 * JS for Login and Register page.
 *
 * @package vass-login-with-google
 */

const wpGoogleLogin = {

	/**
	 * Init method.
	 *
	 * @return void
	 */
	init() {
		document.addEventListener( 'DOMContentLoaded', this.onContentLoaded );
	},

	/**
	 * Callback function when content is load.
	 * To render the google login button at after login form.
	 *
	 * @return void
	 */
	onContentLoaded() {

		// Form either can be login or register form.
		// this.form = document.getElementById( 'loginform' ) || document.getElementById( 'registerform' );

		// if ( null === this.form ) {
		// 	return;
		// }

		// this.googleLoginButton = this.form.querySelector( '.wp_google_login' ).cloneNode( true );
		// this.googleLoginButton.classList.remove( 'hidden' );

		// // HTML is cloned from existing HTML node.
		// this.form.append( this.googleLoginButton );

		var googleLoginButton = document.querySelector('.wp_google_login');
		var login = document.getElementById("login");
	
		if(window.location.search != "?superadminform=true") {
			googleLoginButton.classList.remove( 'hidden' );
		}
		
		if(window.location.search == "?action=lostpassword"){
			googleLoginButton.classList.add( 'hidden' );
		}

		if(window.location.search == "?superadminform=true" || window.location.search == "?action=lostpassword"){
			login.classList.add('login-development');
		}
	}

};

wpGoogleLogin.init();
