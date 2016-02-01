<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.webaccessibility.de/
 * @since      1.0.0
 *
 * @package    Blogfoster_Tt
 * @subpackage Blogfoster_Tt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blogfoster_Tt
 * @subpackage Blogfoster_Tt/public
 * @author     Martin Stehle <m.stehle@webaccessibility.de>
 */
class Blogfoster_Tt_Public {

	/**
	 * The name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The name of this plugin.
	 */
	private $plugin_name;

	/**
	 * The slug of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_slug    The slug of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $plugin_version;

	/**
	 * The settings of the plugin as stored in the WP options table, else default settings.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $plugin_settings    The settings of the plugin
	 */
	private $plugin_settings;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $name, $slug, $version, $settings ) {

		$this->plugin_name = $name;
		$this->plugin_slug = $slug;
		$this->plugin_version = $version;
		$this->plugin_settings = $settings;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/blogfoster-tt-public.css', array(), $this->plugin_version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/blogfoster-tt-public.js', array( 'jquery' ), $this->plugin_version, false );

	}

	/**
	 * Print the traffic tracker snippet with the stored website ID
	 *
	 * @since    1.0.0
	 */
	public function print_traffictracker_snippet () {
		$id = absint( $this->plugin_settings[ 'website_id' ] );
		if ( $id ) {
			printf( 
				'<script type="text/javascript">window.blogfosterAnalytics=window.blogfosterAnalytics||[],function(){var t="//analytics.blogfoster.com/analytics.js";window.blogfosterAnalytics.websiteId=%d;var e=document,s=e.createElement("script"),a=e.getElementsByTagName("script")[0];s.type="text/javascript",s.defer=true,s.async=true,s.src=t,a.parentNode.insertBefore(s,a)}();</script>',
				$id
			);
			print "\n";
		}
	}
}
