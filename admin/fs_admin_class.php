<?php
/**
 * The admin class for this plugin that is called in /includes/fs-class.php
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class FS_Admin {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
      $this->plugin = FS_NAME;
      $this->version = FS_VERSION;
   }

   public function register_admin_css() {
     wp_enqueue_style(
       $this->plugin, plugin_dir_url( __FILE__ ) . 'css/styles.css',
       array(),
       FS_NAME,
       'all'
     );
   }

   public function register_admin_js() {
     wp_enqueue_script(
       $this->plugin,
       plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ),
       FS_NAME,
       false
     );
   }

}
