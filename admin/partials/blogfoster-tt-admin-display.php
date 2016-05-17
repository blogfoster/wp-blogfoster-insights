<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.webaccessibility.de/
 * @since      1.0.0
 *
 * @package    Blogfoster_Tt
 * @subpackage Blogfoster_Tt/admin/partials
 */
?>

<div class="wrap">

	<h2><span class="bftt_logo">blogfoster</span> Traffic Tracker</h2><?php #echo esc_html( get_admin_page_title() ); ?>
	<div class="bftt_wrapper">
		<div id="bftt_main">
			<div class="bftt_content">
				<form method="post" action="options.php">
<?php 
settings_fields( $this->settings_fields_slug );
do_settings_sections( $this->main_options_page_slug );
submit_button(); 
?>
				</form>
			</div><!-- .bftt_content -->
		</div><!-- #bftt_main -->
		<div id="bftt_footer">
			<div class="bftt_content">
				<h3><?php _e( 'Helpful links', 'blogfoster-tt' ); ?></h3>
				<ul>
					<li><a href="https://app.blogfoster.com/"><?php _e( 'Login to your blogfoster account', 'blogfoster-tt' ); ?></a></li>
					<li><a href="http://www.blogfoster.com/"><?php _e( 'blogfoster Website', 'blogfoster-tt' ); ?></a></li>
				</dl>
			</div><!-- .bftt_content -->
		</div><!-- #bftt_footer -->
	</div><!-- .bftt_wrapper -->
</div><!-- .wrap -->

