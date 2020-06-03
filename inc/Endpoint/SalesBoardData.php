<?php
namespace Mam\SalesBoard\Endpoint;

/**
 * Class Users
 *
 * @package Mam\SalesBoard\Endpoint
 */
class SalesBoardData extends AbstractEndpoint implements EndpointInterface {

	/**
	 * Return the static slug string.
	 *
	 * @return string
	 */
	public function get_slug() {

		return 'sales-board-data';
	}

	/**
	 * Callback function for users content
	 *
	 */
	public function render() {

		include  __DIR__ . '/../templates/salesboarddata.php';
	}
}
