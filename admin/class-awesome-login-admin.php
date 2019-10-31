<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://awesome-plugins.com
 * @since      1.0.0
 *
 * @package    Awesome_Login
 * @subpackage Awesome_Login/admin
 */


class Awesome_Login_Admin {

	private $plugin_name;
	private $version;
	
	const _SETTINGS_ACCESS_LEVEL = 'manage_options';
	const _NAMESPACE = 'awesome_login';

	
	public function __construct( $plugin_name, $version ) {
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;	
	
	}
	
	
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/awesome-login-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/awesome-login-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	
	/**
 	* Adds the admin menu under the options.php 
 	*
 	* @since 		1.0.0 
 	* @author 		Awesome Plugins 
 	*/
	public function admin_menu_aws_login() {
		
		add_options_page ( __('Awesome Login', 'awesome-login'), __('Awesome Login', 'awesome-login'), self::_SETTINGS_ACCESS_LEVEL, self::_NAMESPACE, array($this, 'render_admin_page' ) );
		
	}
	
	
	public function render_admin_page(){
		
		    include __DIR__ . "/partials/admin-display.php";
		
	} 
	
	

}
