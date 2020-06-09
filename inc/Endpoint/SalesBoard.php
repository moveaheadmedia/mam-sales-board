<?php
/**
 * @package mam-sales-board
 */

namespace Mam\SalesBoard\Endpoint;


use Mam\SalesBoard\WPApi\Endpoint;
use Mam\SalesBoard\Base\ServiceInterface;

class SalesBoard implements ServiceInterface {

	/**
	 * @var Endpoint
	 */
	public $endpoint_api;

	public function __construct() {
		$this->endpoint_api = new Endpoint();
	}

	/**
	 * Register SalesBoard Endpoint.
	 */
	public function register(){
		$this->endpoint_api->add_endpoint('sales-board')->with_teamplate('salesboard.php')->register_endpoints();
		$this->endpoint_api->add_endpoint('sales-board-data')->with_teamplate('salesboarddata.php')->register_endpoints();
	}
}
