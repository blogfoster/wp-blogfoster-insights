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
  <h2>
    <span class="bfinsights_logo">blogfoster </span>Insights
  </h2>
  <?php #echo esc_html( get_admin_page_title() ); ?>
  <div class="bfinsights_wrapper">
    <div id="bfinsights_main">
      <div class="bfinsights_content">
        <form method="post" action="options.php">
<?php
settings_fields( $this->settings_fields_slug );
do_settings_sections( $this->main_options_page_slug );
submit_button();
?>
        </form>
      </div><!-- .bfinsights_content -->
    </div><!--#bfinsights_main -->
    <div id="bfinsights_footer">
      <div class="bfinsights_content">
        <h3><?php _e( 'Helpful links', 'blogfoster-insights' ); ?></h3>
        <ul>
          <li><a href="https://manage.blogfoster.com/"><?php _e( 'Login to your blogfoster account', 'blogfoster-insights' ); ?></a></li>
          <li><a href="http://www.blogfoster.com/"><?php _e( 'blogfoster Website', 'blogfoster-insights' ); ?></a></li>
        </dl>
      </div><!-- .bfinsights_content -->
    </div><!-- #bfinsights_footer -->
  </div><!-- .bfinsights_wrapper -->
</div><!-- .wrap -->
