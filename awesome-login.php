<?php

/**

 * Plugin Name:       Awesome Login
 * Plugin URI:        http://awesome-plugins.com
 * Description:       Users management plugin with login, logout, login page, shortcodes and roles management. 
 * Version:           1.0.0
 * Author:            Njengah 
 * Author URI:        http://njengah.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       awesome-login
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AWESOME_LOGIN_VERSION', '1.0.0' );
define( 'AWESOME_LOGIN_DIR', __DIR__);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-awesome-login-activator.php
 */
function activate_awesome_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-awesome-login-activator.php';
	Awesome_Login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-awesome-login-deactivator.php
 */
function deactivate_awesome_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-awesome-login-deactivator.php';
	Awesome_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_awesome_login' );
register_deactivation_hook( __FILE__, 'deactivate_awesome_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-awesome-login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_awesome_login() {

	$plugin = new Awesome_Login();
	$plugin->run();

}
run_awesome_login();
