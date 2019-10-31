<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://awesome-plugins.com
 * @since      1.0.0
 *
 * @package    Awesome_Login
 * @subpackage Awesome_Login/includes
 */


class Awesome_Login {

	
	protected $loader;

	
	protected $plugin_name;

	protected $version;

	
	public function __construct() {
		if ( defined( 'AWESOME_LOGIN_VERSION' ) ) {
			$this->version = AWESOME_LOGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'awesome-login';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	
	private function load_dependencies() {
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-awesome-login-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-awesome-login-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-awesome-login-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-awesome-login-public.php';

		$this->loader = new Awesome_Login_Loader();

	}

	
	private function set_locale() {

		$plugin_i18n = new Awesome_Login_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	
	private function define_admin_hooks() {

		$plugin_admin = new Awesome_Login_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu_aws_login' );

	}

	private function define_public_hooks() {

		$plugin_public = new Awesome_Login_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}


	public function run() {
		$this->loader->run();
	}

	
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	public function get_loader() {
		return $this->loader;
	}


	public function get_version() {
		return $this->version;
	}

}
