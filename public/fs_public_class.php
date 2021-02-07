<?php
/**
 * The public class for this plugin that is called in /includes/fs-class.php
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class FS_Public {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
      $this->plugin = FS_NAME;
      $this->version = FS_VERSION;
   }

   public function register_public_css() {
     wp_enqueue_style(
       $this->plugin, plugin_dir_url( __FILE__ ) . 'css/styles.css',
       array(),
       FS_NAME,
       'all'
     );
   }

   public function register_public_js() {
     wp_enqueue_script(
       $this->plugin,
       plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ),
       FS_NAME,
       false
     );

     wp_localize_script(
       $this->plugin,
       'ajaxcall',
       array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
     );

   }

   /**
   * Return the form for user submission.
   *
   * @since    0.1
   */
   public function return_form() {
     // Create a custom nonce
     $custom_nonce = wp_create_nonce( 'add_form_nonce' );

     echo '<div class="wrap">';
     echo '<h1 class="wp-heading-inline">User Submission Form</h1>';

     echo '<div class="form-response"></div>';

     echo '<div class="form-class">';
     echo '<form action="#" method="POST" class="user_form">';
     echo '<input type="hidden" name="custom_nonce" id="custom_nonce" value="' . $custom_nonce . '" />';

     echo '<div class="form-input">';
     echo '<label for="subject">Subject</label>';
     echo '<input type="text" id="subject"  name="subject" placeholder="Type your subject" />';
     echo '</div>';

     echo '<div ">';
     echo '<label for="subject">Message</label>';
     echo '<textarea class="form-input-textarea rows="4" cols="50" id="message"  name="message" placeholder="Type your message">Type your message here</textarea>';
     echo '</div>';

     echo '<button type="submit" id="submit" name="submit-form" class="submit">Submit</button>';
     echo '</form>';
     echo '</div>';

     echo '</div>';

   }

   /**
   * This form submission function is registered with admin-ajax, so
   * users can submit the form without the page reloading.
   * Check fs-class.php for the wp_ajax_{function} code.
   * The actual jQuery is in /public/js/jquery.js
   *
   * @since    0.1
   */
   public function submit_form() {
     // If the nonce couldn't be verified, for whatever reason
     if ( !isset( $_POST['custom_nonce'] )  || !wp_verify_nonce( $_POST['custom_nonce'], 'add_form_nonce' ) ) {
       echo 'Sorry, there was an error on this form. Please contact the administrator of this website.';
       exit;
     } else {
       // Insert to the Letters custom post type
       $post = array(
         'post_title' => $_POST['subject'],
         'post_content' => $_POST['message'],
         'post_status' => 'publish',
         'post_type' => 'letters'
       );
       $return_id = wp_insert_post( $post );

       return $return_id; // Not used currently
     }
   }
}
