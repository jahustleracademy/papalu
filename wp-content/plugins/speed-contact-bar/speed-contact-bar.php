<?php
/**
 * @package   Speed_Contact_Bar
 * @author    Kybernetik Services <wordpress@kybernetik.com.de>
 * @license   GPL-2.0+
 * @link      http://wordpress.org/plugins/speed-contact-bar/
 * @copyright 2021
 *
 * @wordpress-plugin
 * Plugin Name:       Speed Contact Bar
 * Plugin URI:        http://wordpress.org/plugins/speed-contact-bar/
 * Description:       Let your website visitors get in touch with you easily with permanent seen contact information
 * Version:           6.13.0
 * Requires at least: 3.5
 * Requires PHP:      5.2
 * Author:            Kybernetik Services
 * Author URI:        https://www.kybernetik-services.com/?utm_source=wordpress_org&utm_medium=plugin&utm_campaign=speed-contact-bar&utm_content=author
 * Text Domain:       speed-contact-bar
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-speed-contact-bar.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Speed_Contact_Bar', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Speed_Contact_Bar', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Speed_Contact_Bar', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
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

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-speed-contact-bar-admin.php' );
	add_action( 'plugins_loaded', array( 'Speed_Contact_Bar_Admin', 'get_instance' ) );

}
