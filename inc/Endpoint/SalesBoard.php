<?php
namespace Mam\SalesBoard\Endpoint;

/**
 * Class Users
 *
 * @package Mam\SalesBoard\Endpoint
 */
class SalesBoard extends AbstractEndpoint implements EndpointInterface {

	/**
	 * Return the static slug string.
	 *
	 * @return string
	 */
	public function get_slug() {

		return 'sales';
	}

	/**
	 * Callback function for users content
	 *
	 */
	public function render() {

		include  __DIR__ . '/../templates/salesboard.php';
	}
}
