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

use Mam\SalesBoard\Endpoint;

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

	// Register the option page using ACF
	if( function_exists('acf_add_options_page') ) {
		// Register options page.
		acf_add_options_page(array(
			'page_title'    => 'Sales Board',
			'menu_title'    => 'Sales Board',
			'menu_slug'     => 'mam-sales-board',
			'capability'    => 'read',
			'redirect'      => false
		));
	}

	$endpoint_manager = new Endpoint\Manager();
	$endpoint_manager->add_endpoint(new Endpoint\SalesBoard());
	$endpoint_manager->add_endpoint(new Endpoint\SalesBoardData());

	// add endpoints
	add_action('init', [ $endpoint_manager, 'add_endpoints' ]);
	// handle endpoints
	add_action('template_redirect', [ $endpoint_manager, 'render' ]);
	// Add custom fields
	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5ed5e628d23f7',
			'title' => 'Sales Board',
			'fields' => array(
				array(
					'key' => 'field_5ed5e63b86dd4',
					'label' => 'Sales',
					'name' => 'sales',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5ed5e65b86dd5',
							'label' => 'Name',
							'name' => 'name',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5ed5e66a86dd6',
							'label' => 'Country',
							'name' => 'country',
							'type' => 'select',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array(
								'AUD' => 'AUD',
								'THB' => 'THB',
								'GBP' => 'GBP',
							),
							'default_value' => false,
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'return_format' => 'value',
							'ajax' => 0,
							'placeholder' => '',
						),
						array(
							'key' => 'field_5ed5e68686dd7',
							'label' => 'Recurring Target',
							'name' => 'recurring_target',
							'type' => 'number',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
						array(
							'key' => 'field_5ed5e69a86dd8',
							'label' => 'Recurring Collected',
							'name' => 'recurring_collected',
							'type' => 'number',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => 0,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
						array(
							'key' => 'field_5ed5e6b886dd9',
							'label' => 'Singles',
							'name' => 'singles',
							'type' => 'number',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => 0,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'mam-sales-board',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	endif;
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
