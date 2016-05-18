<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/admin/partials
 */
?>

<div class="wrap">
  <h2><span class="bfinsights_logo">blogfoster </span>Insights</h2>
  <div class="bfinsights_wrapper">

    <!-- main -->
    <div id="bfinsights_main">
      <div class="bfinsights_content">
        <form method="post" action="options.php">
<?php
settings_fields( $this->settings_fields_slug );
do_settings_sections( $this->main_options_page_slug );
submit_button();
?>
        </form>
      </div>
    </div>

    <!-- footer -->
    <div id="bfinsights_footer">
      <div class="bfinsights_content">
        <h3><?php _e( 'Helpful links', 'wp-blogfoster-insights' ); ?></h3>
        <ul>
          <li><a target="_blank" href="https://app.blogfoster.com/"><?php _e( 'Login to your blogfoster account', 'wp-blogfoster-insights' ); ?></a></li>
          <li><a target="_blank" href="http://www.blogfoster.com/"><?php _e( 'blogfoster Website', 'wp-blogfoster-insights' ); ?></a></li>
        </ul>
      </div>
    </div>

  </div>
</div>
