<?php
/**
 * Settings class.
 *
 * @package vass-login-with-google
 */

namespace WP_Google_Login\Inc;

use WP_Google_Login\Inc\Traits\Singleton;

/**
 * Class Settings
 */
class Settings {

	use Singleton;

	/**
	 * Plugin constructor.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To setup actions/filters.
	 *
	 * @return void
	 */
	public function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'settings_init' ] );
	}

	/**
	 * Add admin menu.
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		if ( current_user_can( 'manage_options' ) ) {
			add_filter( 'plugin_action_links', [ $this, 'plugin_action_links' ], 10, 2 );
		}
		add_options_page( __( 'Log in with Google', 'vass-login-with-google' ), __( 'Log in with Google', 'vass-login-with-google' ),  'manage_options', 'vass-login-with-google', [
			$this,
			'options_page'
		] );
	}

	/**
	 * Adds a "Settings" link to this plugin's entry on the plugin list.
	 *
	 * @param array  $links Array of links for plugin actions.
	 * @param string $file Path to the plugin file relative to the plugins directory.
	 *
	 * @return array $links Array of links for plugin actions.
	 */
	public function plugin_action_links( $links, $file ) {
		if ( 'vass-login-with-google/vass-login-with-google.php' === $file ) {
			$links[] = "<a href='options-general.php?page=vass-login-with-google'>" . __( 'Settings', 'vass-login-with-google' ) . '</a>';
		}

		return $links;
	}

	/**
	 * Add admin menu.
	 *
	 * @return void
	 */
	public function settings_init() {
		register_setting( 'wp_google_login', 'wp_google_login_settings' );

		add_settings_section(
			'wp_google_login_section',
			__( 'Log in with Google Settings', 'vass-login-with-google' ),
			[ $this, 'settings_section_callback' ],
			'wp_google_login'
		);

		add_settings_field(
			'wp_google_login_client_id',
			__( 'Client ID', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_client_id_render' ],
			'wp_google_login',
			'wp_google_login_section',
			[ 'label_for' => 'client-id' ]
		);

		add_settings_field(
			'wp_google_login_client_secret',
			__( 'Client Secret', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_client_secret_render' ],
			'wp_google_login',
			'wp_google_login_section',
			[ 'label_for' => 'client-secret' ]
		);

		add_settings_field(
			'wp_google_login_whitelisted_domains',
			__( 'Whitelisted Domains', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_whitelisted_domains_render' ],
			'wp_google_login',
			'wp_google_login_section',
			[ 'label_for' => 'whitelisted-domains' ]
		);

		add_settings_field(
			'wp_google_login_enable_registration',
			__( 'Create new user', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_enable_registrationr' ],
			'wp_google_login',
			'wp_google_login_section',
			[ 'label_for' => 'enable-registration' ]
		);

		add_settings_field(
			'wp_google_login_group_key',
			__( 'Group Key', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_group_key_render' ],
			'wp_google_login',
			'wp_google_login_section',	
			[ 'label_for' => 'group-key' ]
		);

		add_settings_field(
			'wp_google_login_service_account',
			__( 'File Service Account', 'vass-login-with-google' ),
			[ $this, 'wp_google_login_service_account_render' ],
			'wp_google_login',
			'wp_google_login_section',	
			[ 'label_for' => 'service-account' ]
		);
	}

	/**
	 * Render Client ID settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_client_id_render() {
		$client_id = wp_google_login_get_client_id();
		$disabled  = '';
		if ( defined( 'WP_GOOGLE_LOGIN_CLIENT_ID' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='text' name='wp_google_login_settings[client_id]' id="client-id" <?php echo esc_attr( $disabled ); ?> value='<?php echo esc_attr( $client_id ); ?>'>
		<p class="description">
		<?php
		echo wp_kses_post( sprintf( 
			'<p>%1s <a target="_blank" href="%2s">%3s</a>.</p>', 
			esc_html__( 'Create oAuth Client ID and Client Secret at', 'vass-login-with-google' ), 
			'https://console.developers.google.com/apis/dashboard',
			'console.developers.google.com'
		) );
		?>
		</p>
		<?php
	}

	/**
	 * Render Client Secret settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_client_secret_render() {
		$client_secret = wp_google_login_get_client_secret();
		$disabled      = '';
		if ( defined( 'WP_GOOGLE_LOGIN_SECRET' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='text' name='wp_google_login_settings[client_secret]' id="client-secret" <?php echo esc_attr( $disabled ); ?> value='<?php echo esc_attr( $client_secret ); ?>'>
		<?php

	}

	/**
	 * Render Whitelisted Domains settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_whitelisted_domains_render() {
		$whitelisted_domains = wp_google_login_get_whitelisted_domains();
		$disabled            = '';
		if ( defined( 'WP_GOOGLE_LOGIN_WHITELIST_DOMAINS' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='text' name='wp_google_login_settings[whitelisted_domains]' id="whitelisted-domains" <?php echo esc_attr( $disabled ); ?> value='<?php echo esc_attr( $whitelisted_domains ); ?>'>
		<p class="description"><?php esc_html_e( 'Optional field, add comma-separated list of whitelisted domains.', 'vass-login-with-google' ); ?></p>
		<?php

	}

	/**
	 * Render Google Login Registration settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_enable_registrationr() {
		$registration_enabled = wp_google_login_is_registration_enabled();
		$disabled             = '';
		if ( defined( 'WP_GOOGLE_LOGIN_USER_REGISTRATION' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='hidden' name='wp_google_login_settings[registration_enabled]' value='0' <?php echo esc_attr( $disabled ); ?> >
		<label style='display:block;margin-top:6px;'><input type='checkbox' name='wp_google_login_settings[registration_enabled]' id="enable-registration" <?php echo esc_attr( checked( $registration_enabled ) ); ?> <?php echo esc_attr( $disabled ); ?> value='1'>
			<?php esc_html_e( __( 'Create a new user account if it doesn’t exist already', 'vass-login-with-google' ) ) ?>
		</label>
		<p class="description"><?php 
			echo wp_kses_post( sprintf( 
				__( 'If this setting is checked, a new user will be created even if <a target="_blank" href="%1s">membership setting</a> is off.', 'vass-login-with-google' ), 
				is_multisite() ? 'network/settings.php' : 'options-general.php'
			) );
		?>
		</p>
		<?php
	}

	
	/**
	 * Render Group	key settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_group_key_render() {
		$group_key = wp_google_login_get_group_key();
		$disabled      = '';
		if ( defined( 'WP_GOOGLE_LOGIN_GROUPKEY' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='text' name='wp_google_login_settings[group_key]' id="group-key" <?php echo esc_attr( $disabled ); ?> value='<?php echo esc_attr( $group_key ); ?>'>
		<?php
	}

	/**
	 * Render Service Account settings field.
	 *
	 * @return void
	 */
	public function wp_google_login_service_account_render() {
		$service_account = wp_google_login_get_service_account();
		$disabled      = '';
		if ( defined( 'WP_GOOGLE_LOGIN_GROUPKEY' ) ) {
			$disabled = 'disabled';
		}
		?>
		<input type='text' name='wp_google_login_settings[service_account]' id="service-account" <?php echo esc_attr( $disabled ); ?> value='<?php echo esc_attr( $service_account ); ?>'>
		<?php
	}


	/**
	 * Settings Section callback
	 *
	 * @return void
	 */
	public function settings_section_callback() {
		
	}

	/**
	 * Render option page.
	 *
	 * @return void
	 */
	public function options_page() {
		?>
		<div class="wrap">
			<form action='options.php' method='post'>
				<?php
				settings_fields( 'wp_google_login' );
				do_settings_sections( 'wp_google_login' );
				submit_button();
				?>
			</form>
			<hr>
		</div>
		<?php
	}
}


function wp_google_login_get_group_key() {
	$options   = get_option( 'wp_google_login_settings' );
	$group_key = '';
	if ( defined( 'WP_GOOGLE_LOGIN_GROUP_KEY' ) ) {
		$group_key = WP_GOOGLE_LOGIN_GROUP_KEY;
	} else {
		$group_key = ! empty( $options['group_key'] ) ? $options['group_key'] : '';
	}

	return $group_key;
}

function wp_google_login_get_service_account() {
	$options   = get_option( 'wp_google_login_settings' );
	$service_account = '';
	if ( defined( 'WP_GOOGLE_LOGIN_SERVICE_ACCOUNT' ) ) {
		$service_account = WP_GOOGLE_LOGIN_SERVICE_ACCOUNT;
	} else {
		$service_account = ! empty( $options['service_account'] ) ? $options['service_account'] : '';
	}

	return $service_account;
}