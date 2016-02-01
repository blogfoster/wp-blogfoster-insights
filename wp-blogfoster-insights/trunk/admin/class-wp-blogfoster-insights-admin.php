<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/admin
 */
class Blogfoster_Insights_Admin {

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
   * The settings of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_settings    The current settings of this plugin.
   */
  private $plugin_settings;

  /**
   * The slug of the plugin screen.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_screen_id   The slug of the plugin screen.
   */
  private $plugin_screen_id;

  /**
   * The structure of the form sections with headline, description and options
   *
   * @since    1.0.0
   * @access   private
   * @var      array    $form_structure    The structure of the form sections with headline, description and options
   */
  private $form_structure;

  /**
   * The slug of the form elements.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $settings_fields_slug    The slug of the form elements.
   */
  private $settings_fields_slug;

  /**
   * The slug of the options page.
   *
   * @since    1.0.0
   * @access   private
   * @var      array    $main_options_page_slug    The slug of the options page.
   */
  private $main_options_page_slug;

  /**
   * The slug of the plugin's settings in the WP options table
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $settings_db_slug    The options slug n of the plugin.
   */
  private $settings_db_slug;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param    string    $plugin_name       The name of this plugin.
   * @param    string    $plugin_version    The version of this plugin.
   */
  public function __construct( $name, $slug, $version, $db_slug, $settings ) {

    $this->plugin_name = $name;
    $this->plugin_slug = $slug;
    $this->plugin_version = $version;
    $this->settings_db_slug = $db_slug;
    $this->plugin_settings = $settings;
    $this->settings_fields_slug = $slug . '-options-fields';
    $this->main_options_page_slug = $slug . '-options-page';

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/wp-blogfoster-insights-admin.css', array(), $this->plugin_version, 'all' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/wp-blogfoster-insights-admin.js', array( 'jquery' ), $this->plugin_version, false );

  }

  /**
   * Print a message about the location of the plugin in the WP backend
   *
   * @since    1.0.0
   */
  public function display_activation_message () {
    $label = 'Settings';
    $url  = esc_url( admin_url( sprintf( 'options-general.php?page=%s', $this->plugin_slug ) ) );
    $link = sprintf( '<a href="%s">%s &rsaquo; %s</a>', $url, __( $label ), $this->plugin_name );
    $msg  = sprintf( __( 'Welcome to %s! You can find the plugin at %s.', 'wp-blogfoster-insights' ), $this->plugin_name, $link );
    $html = sprintf( '<div class="updated"><p>%s</p></div>', $msg );
    print $html;
  }

  /**
   * Register the administration menu for this plugin into the WordPress Dashboard menu.
   *
   * @since    1.0.0
   */
  public function add_plugin_admin_menu() {

    $label = 'Settings';
    $page_title = sprintf( '%s: %s', $this->plugin_name, __( $label ) );

    // Add a settings page for this plugin to the Settings menu.
    $this->plugin_screen_id = add_options_page(
      $page_title,
      $this->plugin_name,
      'manage_options',
      $this->plugin_slug,
      array( $this, 'main' )
    );

  }

  /**
   * Add settings action link to the plugins page.
   *
   * @since    1.0.0
   */
  public function add_action_links( $links ) {

    $label = 'Settings';

    return array_merge(
      $links,
      array(
        'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( $label ) . '</a>'
      )
    );

  }

  /**
   * Do the admin main function
   *
   * @since    1.0.0
   *
   */
  public function main() {

    // just for a translation on the plugins list
    $text = __( 'Integrate blogfoster Insights into your WordPress blog.', 'wp-blogfoster-insights' );
    // print options page
    include_once( 'partials/wp-blogfoster-insights-admin-display.php' );
  }

  /**
  * Define and register the options
  * Run on admin_init()
  *
  * @since    1.0.0
  */
  public function register_options () {

    $title = null;
    $html = null;

    $this->form_structure = array(
      '1st_section' => array(
        'headline' => __( 'Website Settings', 'wp-blogfoster-insights' ),
        'description' => __( 'This plugin integrates blogfoster Insights into your WordPress blog. It helps you to understand your blog and gives blogfoster the chance to offer you  the most suitable sponsored posts and campaigns. After you have configured the  plugin in the settings section, blogfoster Insights starts to work.', 'wp-blogfoster-insights' ),
        'options' => array(
          'website_id' => array(
            'type'    => 'textfield',
            'title'   => __( 'Website ID', 'wp-blogfoster-insights' ),
            'desc'    => __( 'Type in your blogfoster website ID and save it. The ID has to be a positive integer.', 'wp-blogfoster-insights' ),
          ),
        ),
      ),
    );

    // build form with sections and options
    foreach ( $this->form_structure as $section_key => $section_values ) {

      // assign callback functions to form sections (options groups)
      add_settings_section(
        // 'id' attribute of tags
        $section_key,
        // title of the section.
        $this->form_structure[ $section_key ][ 'headline' ],
        // callback function that fills the section with the desired content
        array( $this, 'print_section_' . $section_key ),
        // menu page on which to display this section
        $this->main_options_page_slug
      ); // end add_settings_section()

      // set labels and callback function names per option name
      foreach ( $section_values[ 'options' ] as $option_name => $option_values ) {
        // set default description
        $desc = '';
        if ( isset( $option_values[ 'desc' ] ) and '' != $option_values[ 'desc' ] ) {
          if ( 'checkbox' == $option_values[ 'type' ] ) {
            $desc =  $option_values[ 'desc' ];
          } else {
            $desc =  sprintf( '<p class="description">%s</p>', $option_values[ 'desc' ] );
          }
        }
        // build the form elements values
        switch ( $option_values[ 'type' ] ) {
          case 'radiobuttons':
            $title = $option_values[ 'title' ];
            $stored_value = isset( $this->plugin_settings[ $option_name ] ) ? esc_attr( $this->plugin_settings[ $option_name ] ) : '';
            $html = sprintf( '<fieldset><legend class="screen-reader-text"><span>%s</span></legend>', $title );
            foreach ( $option_values[ 'values' ] as $value => $label ) {
              $checked = $stored_value ? checked( $stored_value, $value, false ) : '';
              $html .= sprintf( '<label><input type="radio" name="%s[%s]" value="%s"%s /> <span>%s</span></label><br />', $this->settings_db_slug, $option_name, $value, $checked, $label );
            }
            $html .= '</fieldset>';
            $html .= $desc;
            break;
          case 'checkboxes':
            $title = $option_values[ 'title' ];
            $html = sprintf( '<fieldset><legend class="screen-reader-text"><span>%s</span></legend>', $title );
            foreach ( $option_values[ 'values' ] as $value => $label ) {
              $stored_value = isset( $this->plugin_settings[ $value ] ) ? esc_attr( $this->plugin_settings[ $value ] ) : '0';
              $checked = $stored_value ? checked( '1', $stored_value, false ) : '0';
              $html .= sprintf( '<label for="%s"><input name="%s[%s]" type="checkbox" id="%s" value="1"%s /> %s</label><br />' , $value, $this->settings_db_slug, $value, $value, $checked, $label );
            }
            $html .= '</fieldset>';
            $html .= $desc;
            break;
          case 'selection':
            $title = $option_values[ 'title' ];
            $stored_value = isset( $this->plugin_settings[ $option_name ] ) ? esc_attr( $this->plugin_settings[ $option_name ] ) : $option_values[ 'default' ];
            $html = sprintf( '<select id="%s" name="%s[%s]">', $option_name, $this->settings_db_slug, $option_name );
            foreach ( $option_values[ 'values' ] as $value => $label ) {
              $selected = $stored_value ? selected( $stored_value, $value, false ) : '';
              $html .= sprintf( '<option value="%s"%s>%s</option>', $value, $selected, $label );
            }
            $html .= '</select>';
            $html .= $desc;
            break;
          case 'checkbox':
            $title = $option_values[ 'title' ];
            $value = isset( $this->plugin_settings[ $option_name ] ) ? esc_attr( $this->plugin_settings[ $option_name ] ) : '0';
            $checked = $value ? checked( '1', $value, false ) : '';
            $html = sprintf( '<label for="%s"><input name="%s[%s]" type="checkbox" id="%s" value="1"%s /> %s</label>' , $option_name, $this->settings_db_slug, $option_name, $option_name, $checked, $desc );
            break;
          case 'url':
            $title = sprintf( '<label for="%s">%s</label>', $option_name, $option_values[ 'title' ] );
            $value = isset( $this->plugin_settings[ $option_name ] ) ? esc_url( $this->plugin_settings[ $option_name ] ) : '';
            $html = sprintf( '<input type="text" id="%s" name="%s[%s]" value="%s">', $option_name, $this->settings_db_slug, $option_name, $value );
            $html .= $desc;
            break;
          case 'textarea':
            $title = sprintf( '<label for="%s">%s</label>', $option_name, $option_values[ 'title' ] );
            $value = isset( $this->plugin_settings[ $option_name ] ) ? esc_textarea( $this->plugin_settings[ $option_name ] ) : '';
            $html = sprintf( '<textarea id="%s" name="%s[%s]" cols="30" rows="5">%s</textarea>', $option_name, $this->settings_db_slug, $option_name, $value );
            $html .= $desc;
            break;
          case 'colorpicker':
            $title = sprintf( '<label for="%s">%s</label>', $option_name, $option_values[ 'title' ] );
            $value = isset( $this->stored_settings[ $option_name ] ) ? esc_attr( $this->stored_settings[ $option_name ] ) : '#cccccc';
            $html = sprintf( '<input type="text" id="%s" class="wp-color-picker" name="%s[%s]" value="%s">', $option_name, $this->settings_db_slug, $option_name, $value );
            $html .= $desc;
            break;
          // else text field
          default:
            $title = sprintf( '<label for="%s">%s</label>', $option_name, $option_values[ 'title' ] );
            $value = isset( $this->plugin_settings[ $option_name ] ) ? esc_attr( $this->plugin_settings[ $option_name ] ) : '';
            $html = sprintf( '<input type="text" id="%s" name="%s[%s]" value="%s">', $option_name, $this->settings_db_slug, $option_name, $value );
            $html .= $desc;
        } // end switch()

        // register the option
        add_settings_field(
          // form field name for use in the 'id' attribute of tags
          $option_name,
          // title of the form field
          $title,
          // callback function to print the form field
          array( $this, 'print_option' ),
          // menu page on which to display this field for do_settings_section()
          $this->main_options_page_slug,
          // section where the form field appears
          $section_key,
          // arguments passed to the callback function
          array(
            'html' => $html,
          )
        ); // end add_settings_field()

      } // end foreach( section_values )

    } // end foreach( section )

    // finally register all options. They will be stored in the database in the wp_options table under the options name $this->settings_db_slug.
    register_setting(
      // group name in settings_fields()
      $this->settings_fields_slug,
      // name of the option to sanitize and save in the db
      $this->settings_db_slug,
      // callback function that sanitizes the option's value.
      array( $this, 'sanitize_options' )
    ); // end register_setting()

  } // end register_options()

  /**
  * Check and return correct values for the settings
  *
  * @since    1.0.0
  *
  * @param   array    $input    Options and their values after submitting the form
  *
  * @return  array              Options and their sanatized values
  */
  public function sanitize_options ( $input ) {
    foreach ( $this->form_structure as $section_name => $section_values ) {
      foreach ( $section_values[ 'options' ] as $option_name => $option_values ) {
        switch ( $option_values[ 'type' ] ) {
          // if checkbox is set assign '1', else '0'
          case 'checkbox':
            $input[ $option_name ] = isset( $input[ $option_name ] ) ? 1 : 0 ;
            break;
          // clean email value
          case 'email':
            $email = sanitize_email( $input[ $option_name ] );
            $input[ $option_name ] = is_email( $email ) ? $email : '';
            break;
          // clean url values
          case 'url':
            $input[ $option_name ] = esc_url_raw( $input[ $option_name ] );
            break;
          // clean all other form elements values
          default:
            $input[ $option_name ] = sanitize_text_field( $input[ $option_name ] );
        } // end switch()
      } // foreach( options )
    } // foreach( sections )
    return $input;
  } // end sanitize_options()

  /**
  * Print the option
  *
  * @since    1.0.0
  *
  */
  public function print_option ( $args ) {
    print $args[ 'html' ];
  }

  /**
  * Print the explanation for section 1
  *
  * @since    1.0.0
  */
  public function print_section_1st_section () {
    printf( "<p>%s</p>\n", $this->form_structure[ '1st_section' ][ 'description' ] );
  }

}
