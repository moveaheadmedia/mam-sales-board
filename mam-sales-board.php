<?php
/**
 * Plugin Name: Sales Board - Moveaheadmedia
 * Plugin URI: https://github.com/Watchout1992/mam-sales-board
 * Description: a Wordpress plugin to add mam sales board functionalty.
 * Version: 1.0
 * Author: AliSal
 * Author URI: https://github.com/Watchout1992

 * Sales Board - Moveaheadmedia is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Sales Board - Moveaheadmedia is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Sales Board - Moveaheadmedia. If not, see <http://www.gnu.org/licenses/>.
 */

// prevent direct access
defined('ABSPATH') or die('</3');


//use Inpsyde\SearchReplace\Database;
use Mam\SalesBoard\Page;

add_action( 'plugins_loaded', function(){
	mam_sales_board_load();
} );

register_activation_hook( __FILE__, 'mam_sales_board_activate' );


/**
 * Validate requirements on activation
 *
 * Runs on plugin activation.
 * Check if php min 5.6.0 if not deactivate the plugin.
 *
 * @since 1.0
 *
 * @return void
 */
function mam_sales_board_activate() {

	$required_php_version = '5.6.0';
	$correct_php_version  = version_compare( PHP_VERSION, $required_php_version, '>=' );

	mam_sales_board_textdomain();

	if ( ! $correct_php_version ) {
		deactivate_plugins( basename( __FILE__ ) );

		wp_die(
			'<p>' .
			sprintf(
			// translators: %1$s will replace with the PHP version of the client.
				esc_attr__(
					'This plugin can not be activated because it requires at least PHP version %1$s. ',
					'mam-sales-board'
				),
				$required_php_version
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">'
			. esc_attr__( 'back', 'mam-sales-board' ) . '</a>'
		);

	}

}

/**
 * Load the plugin
 *
 * @since 1.0
 *
 * @return bool
 */
function mam_sales_board_load() {

	define( 'ALI_TASK_BASEDIR', plugin_dir_url( __FILE__ ) );

	mam_sales_board_textdomain();

	$file     = __DIR__ . '/vendor/autoload.php';

	if ( ! file_exists( $file ) ) {
		return false;
	}

	/** @noinspection PhpIncludeInspection */
	include_once $file;

	// Manage Admin Pages
	$page_manager = new Page\Manager();

	// add Sales Board Admin Page
	$page_manager->add_page(new Page\SalesBoard());


	//$endpoint_manager->add_endpoint(new Endpoint\UserDetails());

	// scripts
	//add_action( 'admin_enqueue_scripts', [ $endpoint_manager, 'register_css' ] );
	//add_action( 'admin_enqueue_scripts', [ $endpoint_manager, 'register_js' ] );

	return true;
}

/**
 * Loading the plugin translations.
 */
function mam_sales_board_textdomain() {

	return load_plugin_textdomain(
		'mam-sales-board',
		false,
		plugin_basename( __DIR__ ) . '/languages/'
	);
}
