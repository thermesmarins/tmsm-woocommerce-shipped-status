<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nicomollet
 * @since             1.0.0
 * @package           Tmsm_Woocommerce_Shipped_Status
 *
 * @wordpress-plugin
 * Plugin Name:       TMSM WooCommerce Shipped Status
 * Plugin URI:        https://github.com/thermesmarins/tmsm-woocommerce-shipped-status
 * Description:       Adds a "Shipped" status to WooCommerce order statuses
 * Version:           1.0.4
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tmsm-woocommerce-shipped-status
 * Domain Path:       /languages
 * Github Plugin URI: https://github.com/thermesmarins/tmsm-woocommerce-shipped-status
 * Github Branch:     master
 * Requires PHP:      7.1
 * WC requires at least: 4.5.0
 * WC tested up to: 5.0.0
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
define( 'TMSM_WOOCOMMERCE_SHIPPED_STATUS_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tmsm-woocommerce-shipped-status-activator.php
 */
function activate_tmsm_woocommerce_shipped_status() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-shipped-status-activator.php';
	Tmsm_Woocommerce_Shipped_Status_Activator::activate();
	
}

add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tmsm-woocommerce-shipped-status-deactivator.php
 */
function deactivate_tmsm_woocommerce_shipped_status() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-shipped-status-deactivator.php';
	Tmsm_Woocommerce_Shipped_Status_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tmsm_woocommerce_shipped_status' );
register_deactivation_hook( __FILE__, 'deactivate_tmsm_woocommerce_shipped_status' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-shipped-status.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tmsm_woocommerce_shipped_status() {

	$plugin = new Tmsm_Woocommerce_Shipped_Status();
	$plugin->run();

}
run_tmsm_woocommerce_shipped_status();
