<?php
/**
 * The main class for this plugin
 * @since   0.1
 * @author  Noora Chahine
 *
**/
class FormShortcode {
   /**
    *
    * @since    0.1
    */
    public function __construct() {
  		$this->plugin = FS_NAME;
      $this->version = FS_VERSION;
  	}


  	/**
  	 * Register all the other classes in this plugin
  	 *
  	 * @since    0.1
  	 */
  	private function other_classes() {
      require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/fs_admin_class.php' );
      require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'public/fs_public_class.php' );
  	}

  	/**
  	 * Register all the admin related stuff
  	 *
  	 * @since    0.1
  	 */
  	private function admin_side() {
      $admin_side = new FS_Admin();

  		add_action( 'admin_enqueue_scripts', array( $admin_side, 'register_admin_css' ) );
  		add_action( 'admin_enqueue_scripts', array( $admin_side, 'register_admin_js' ) );
  	}


  	/**
  	 * Register all the public related stuff
  	 *
  	 * @since    0.1
  	 */
  	private function public_side() {
      $public_side = new FS_Public();

  		add_action( 'wp_enqueue_scripts', array( $public_side, 'register_public_css' ) );
  		add_action( 'wp_enqueue_scripts', array( $public_side, 'register_public_js' ) );

      add_shortcode( 'fs_shortcode', array( $public_side, 'return_form' ) );
      add_action( 'wp_ajax_submit_form', array( $public_side, 'submit_form' ) );
      add_action( 'wp_ajax_nopriv_submit_form', array( $public_side, 'submit_form' ) );
    }

    /**
     * @since    0.1
     */
    public function run() {
      $this->other_classes();
      $this->admin_side();
      $this->public_side();
    }

}
