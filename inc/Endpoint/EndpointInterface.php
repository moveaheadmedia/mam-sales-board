<?php


namespace Mam\SalesBoard\Endpoint;

/**
 * Interface EndPointInterface
 *
 * @package Mam\SalesBoard\Endpoint
 */
interface EndpointInterface
{

    /**
     * @param string $msg
     */
    public function add_error( $msg );

    /**
     * Echoes the content of the $errors array as formatted HTML if it contains error messages.
     */
    public function display_errors();

    /**
     * Returns the page_slug for add_submenu_page().
     *
     * @return string
     */
    public function get_slug();

    /**
     * Page Template the page content.
     */
    public function render();


}