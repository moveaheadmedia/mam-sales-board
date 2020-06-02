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

		// flush rules when the rewrites are done
		flush_rewrite_rules();
	}

	/**
	 * Render all endpoints templates on request.
	 */
	public function render() {
		global $wp_query;
		foreach ( $this->endpoints as $slug => $endpoint ) {

			if (isset( $wp_query->query_vars[$slug] ) ) {
				$endpoint->display_errors();
				$endpoint->render();
				break;
			}

		}
	}

	/**
	 * Registers the Plugin stylesheet.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_css() {
		wp_register_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap');

		wp_register_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
		wp_enqueue_style('fancybox');

		wp_register_style('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css');
		wp_enqueue_style('datatables');

		wp_register_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('fontawesome');

		wp_register_style('ali-task', plugins_url('ali-task.css', ALI_TASK_BASEDIR.'/assets/css/'));
		wp_enqueue_style('ali-task');
	}

	/**
	 * Registers the Plugin javascript.
	 *
	 * @wp-hook admin_enqueue_scripts
	 */
	public function register_js() {

		wp_register_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '3.3.5', true );
		wp_enqueue_script('fancybox');

		wp_register_script('datatables', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js', array('jquery'), '3.3.5', true );
		wp_enqueue_script('datatables');

		wp_register_script('ali-task', plugins_url('ali-task.js', __FILE__), array('jquery'), '3.3.5', true );
		wp_enqueue_script('ali-task');

		// used in user javascript files
		$wnm_custom = array( 'user_details_endpoint' => home_url().'/user-details/' );
		wp_localize_script( 'ali-task', 'ali_task', $wnm_custom );
	}
}
