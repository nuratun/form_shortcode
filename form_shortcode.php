<?php
/**
 *
 * @link              https://www.urlhere.com
 * @since             0.1
 *
 * Plugin Name: Form Shortcode
 * Description: This shortcode: [fs_shortcode] will insert a form with jQuery
 * Version: 3.5
 * Author: Noora Chahine
 * Author URI: http://www.github.com/nuratun
 * Wordpress Version: 5.4 and above
**/

if ( !defined( 'ABSPATH' ) ) die;

define( 'FS_VERSION', '3.5' );
define( 'FS_NAME', 'Form Shortcode' );

// The core plugin file
require( plugin_dir_path( __FILE__ ) . 'includes/fs-class.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/activate.php' );

register_activation_hook( __FILE__, 'on_activate' );
register_deactivation_hook( __FILE__, 'on_deactivate' );

function register_fshortcode_cpost() {
	// Register the custom post type that
	// user form entries will be saved to
	register_post_type( 'letters', array(
		'labels' => array(
			'name' => __( 'Letters', 'textdomain' ),
			'singular_name' => __( 'Letter', 'textdomain' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array(
			'slug' => 'letters'
		),
	) );
}

// Using WP best practices, use the init hook
add_action( 'init', 'register_fshortcode_cpost' );

// Any code that will run when the plugin is activated, like table creation, etc.
function on_activate() {
	$activate = new FS_Activation();
	$activate->activate();
}

// Any deactivation code, like removing database entries, etc.
function on_deactivate() {
	if ( !function_exists( 'unregister_fs_cpost' ) ) {
    function unregister_fs_cpost() {
        unregister_post_type( 'letters' );
    }
	}
	add_action( 'init', 'unregister_fs_cpost' );
}

function run_FS() {
	$plugin = new FormShortcode();
	$plugin->run();
}

run_FS();
