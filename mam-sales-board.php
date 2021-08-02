<?php
/**
 * @package mam-sales-board
 */
/**
 * Plugin Name: Sales Board - Moveaheadmedia
 * Plugin URI: https://github.com/Watchout1992/mam-sales-board
 * Description: a Wordpress plugin to add mam sales board functionalty.
 * Version: 2.0
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

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The plugin path (eg: use for require templates).
 * Define constants for the plugin
 */
define('MSB_PATH', plugin_dir_path(__FILE__));

/**
 * The plugin url (eg: use for enqueue css/js files).
 * Define constants for the plugin
 */
define('MSB_URL', plugin_dir_url(__FILE__));

/**
 * The base name (eg: use for adding links to the plugin action links).
 * Define constants for the plugin
 */
define('MSB_BASENAME', plugin_basename(__FILE__));


/**
 * The code that runs during plugin activation
 */
function activate_alitask_plugin() {
	/** @noinspection PhpFullyQualifiedNameUsageInspection */
	\Mam\SalesBoard\Base\ActivateDeactivate::activate();
}
register_activation_hook( __FILE__, 'activate_alitask_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_alitask_plugin() {
	/** @noinspection PhpFullyQualifiedNameUsageInspection */
	\Mam\SalesBoard\Base\ActivateDeactivate::deactivate();
}

/**
 * Initialize and run all the core classes of the plugin
 */
if ( class_exists( '\\Mam\\SalesBoard\\Init' ) ) {
	/** @noinspection PhpFullyQualifiedNameUsageInspection */
	\Mam\SalesBoard\Init::registerServices();
}



function mam_getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig(dirname( __FILE__ ) . '/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = dirname( __FILE__ ) . '/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}