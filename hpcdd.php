<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blacktiehost.com
 * @since             1.0.0
 * @package           Hpcdd
 *
 * @wordpress-plugin
 * Plugin Name:       Hierarchy Product Category Drop Down
 * Plugin URI:        https://wordpress.org/plugins/hpcdd/
 * Description:       Show hierarchy dropdown to search woocommerce products per category.
 * Version:           1.2.0
 * Author:            Milen Karaganski
 * Author URI:        https://bg.blacktiehost.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hpcdd
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
define('HPCDD_VERSION', '1.2.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hpcdd-activator.php
 */
function activate_hpcdd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hpcdd-activator.php';
	Hpcdd_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hpcdd-deactivator.php
 */
function deactivate_hpcdd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hpcdd-deactivator.php';
	Hpcdd_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hpcdd' );
register_deactivation_hook( __FILE__, 'deactivate_hpcdd' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hpcdd.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hpcdd() {

	$plugin = new Hpcdd();
	$plugin->run();

}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'hpc_add_plugin_page_settings_link');
function hpc_add_plugin_page_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'admin.php?page=hpcdd' ) .
        '">' . __('Settings') . '</a>';
    return $links;
}

run_hpcdd();
