<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Scientifik_Widgets
 * @author    Ben Racicot <benjaminracicot@gmail.com>
 * @license   GPL-2.0+
 * @link      http://scientifik.com
 * @copyright 2014 Scientifik
 *
 * @wordpress-plugin
 * Plugin Name:       Responsive Widgets
 * Plugin URI:        http://scientifik.com
 * Description:       Widget pack adaptive to every common screen size and then some.
 * Version:           1.0.0
 * Author:            Ben Racicot
 * Author URI:        http://scientifik.com
 * Text Domain:       plugin-name-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Scientifik Custom Includes
 *----------------------------------------------------------------------------*/


require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/widgets.php' );


/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/class-scientifik-widgets.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Scientifik_Widgets with the name of the class defined in
 *   `class-plugin-name.php`
 */
register_activation_hook( __FILE__, array( 'Scientifik_Widgets', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Scientifik_Widgets', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace Scientifik_Widgets with the name of the class defined in
 *   `class-scientifik-widgets.php`
 */
add_action( 'plugins_loaded', array( 'Scientifik_Widgets', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name-admin.php` with the name of the plugin's admin file
 * - replace Scientifik_Widgets_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-scientifik-widgets-admin.php' );
	add_action( 'plugins_loaded', array( 'Scientifik_Widgets_Admin', 'get_instance' ) );

}
