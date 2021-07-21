<?php
/**
 * @package mam-sales-board
 */

namespace Mam\SalesBoard\Base;


class Enqueue implements ServiceInterface {

	/**
	 * Register Enqueue hooks.
	 *
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_js' ] );
	}

	/**
	 * Registers the Plugin stylesheet.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_css() {

		wp_register_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap');

		wp_register_style('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css');
		wp_enqueue_style('datatables');

		wp_register_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('fontawesome');

		wp_register_style('msp-plugin', MSB_URL.'assets/css/msp-plugin.css?v1');
		wp_enqueue_style('msp-plugin');
	}

	/**
	 * Registers the Plugin javascript.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_js() {
		wp_register_script('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js', array('jquery'), '3.3.5' );
		wp_enqueue_script('datatables');

		wp_register_script('msp-plugin', MSB_URL.'assets/js/msp-plugin.js?v2', array('jquery'), '3.3.5' );
		wp_enqueue_script('msp-plugin');

		// used in user javascript files
        $wnm_custom = array( 'sales_endpoint' => home_url().'/sales-board-data/' );
		wp_localize_script( 'msp-plugin', 'msp_plugin', $wnm_custom );
	}
}