<?php

namespace Mam\SalesBoard\Endpoint;

/**
 * Class AbstractEndpoint
 *
 * @package Mam\SalesBoard\Endpoint
 */
abstract class AbstractEndpoint {

	/**
	 * @var array
	 */
	protected $errors = array();

	/**
	 * @param string $msg
	 */
	public function add_error( $msg ) {

		$this->errors[] = (string) $msg;
	}

	/**
	 * Echoes the content of the $errors array as formatted HTML if it contains error messages.
	 */
	public function display_errors() {

		if ( count( $this->errors ) < 1 ) {
			return;
		}

		?>
		<div class="error notice is-dismissible">
			<p>
				<strong>
					<?php esc_html_e( 'Errors:', 'ali-task' ); ?>
				</strong>
			</p>
			<ul>
				<?php foreach ( $this->errors as $error ) : ?>
					<li><?= esc_html( $error ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php
	}
	
}
