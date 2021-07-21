<?php
/**
 * @package mam-sales-board
 */

namespace Mam\SalesBoard\Base;


class ActivateDeactivate {

	/**
	 * Flush Rewrite rules
	 */
	public static function activate(){
		flush_rewrite_rules();
	}

	/**
	 * Flush Rewrite rules
	 */
	public static function deactivate(){
		flush_rewrite_rules();
	}

}