<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.webaccessibility.de/
 * @since      1.0.0
 *
 * @package    Blogfoster_Tt
 * @subpackage Blogfoster_Tt/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Blogfoster_Tt
 * @subpackage Blogfoster_Tt/includes
 * @author     Martin Stehle <m.stehle@webaccessibility.de>
 */
class Blogfoster_Tt_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// store the flag into the db to trigger the display of a message after activation
		set_transient( 'blogfoster-tt-show-message', '1', 60 );

	}

}
