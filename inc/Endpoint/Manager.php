<?php

namespace Mam\SalesBoard\Endpoint;

/**
 * Class Manager
 *
 * @package Mam\SalesBoard\Endpoint
 */
class Manager {

	/**
	 * @var EndpointInterface[]
	 */
	private $endpoints = [];

	/**
	 * Add page.
	 *
	 * @param EndpointInterface $endpoint
	 */
	public function add_endpoint( EndpointInterface $endpoint ) {

		$this->endpoints[ $endpoint->get_slug() ] = $endpoint;
	}

	/**
	 * Register all Endpoints.
	 *
	 * @wp-hook add_rewrite_endpoint
	 */
	public function add_endpoints() {

		foreach ( $this->endpoints as $slug => $endpoint ) {
			/**
			 * @param string        $slug
			 */
			add_rewrite_endpoint( $slug, EP_ROOT );
		}

		// load scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'register_js' ] );

		// flush rules when the rewrites are done
		flush_rewrite_rules();
	}

	/**
	 * Render all endpoints templates on request.
	 *
	 * @hook template_include
	 */
	public function render() {
		global $wp_query;
		foreach ( $this->endpoints as $slug => $endpoint ) {
			if (isset( $wp_query->query_vars[$slug] ) ) {
				$endpoint->display_errors();
				$endpoint->render();
				exit();
				break;
			}
		}
	}

	/**
	 * Registers the Plugin stylesheet.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function enqueue_endpoint_styles() {

		wp_register_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap');

		wp_register_style('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css');
		wp_enqueue_style('datatables');

		wp_register_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('fontawesome');

		wp_register_style('ali-task', ALI_TASK_BASEDIR.'assets/css/ali-task.css');
		wp_enqueue_style('ali-task');
	}

	/**
	 * Registers the Plugin javascript.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_js() {

		wp_register_script('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js', array('jquery'), '3.3.5' );
		wp_enqueue_script('datatables');

		wp_register_script('ali-task', ALI_TASK_BASEDIR.'assets/js/ali-task.js', array('jquery'), '3.3.5' );
		wp_enqueue_script('ali-task');

		// used in user javascript files
		$wnm_custom = array( 'user_details_endpoint' => home_url().'/sales-board-data/' );
		wp_localize_script( 'ali-task', 'ali_task', $wnm_custom );
	}
}
