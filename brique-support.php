<?php
/**
 * @package Brique
 */
/*
Plugin Name: Brique Support Plugin
Plugin URI: https://brique.in/
Description: This plugin will enable all shortcodes required for the website rendering and customization.
Version: 1.0
Author: Brique
Text Domain: brique
*/

/*
This plugin will enable all shortcodes required for the website rendering and customization.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'BRIQUE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BRIQUE__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Brique Support Plugin'
, 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Brique Support Plugin'
, 'plugin_deactivation' ) );

// .............................
// Include products shortcodes
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/shortcodes/products.inc.php');

// .............................
// Include cosellers shortcodes
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/shortcodes/cosellers.inc.php');

// .............................
// Include brands shortcodes
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/shortcodes/brands.inc.php');

// .............................
// Include communities shortcodes
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/shortcodes/communities.inc.php');

// .............................
// Include blogs shortcodes
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/shortcodes/blogs.inc.php');

// .............................
// Include login API
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/hooks/pre-login.php');

// .............................
// Include GLOBAL VARIABLES
// .............................
require_once(BRIQUE__PLUGIN_DIR.'/globals.inc.php');

// ................................
// Enqueue scripts and styles.
// ................................
// function brique_support_scripts() {
// 	// Include Shoptype Login JS
// 	wp_register_script( 'login-js-file', BRIQUE__PLUGIN_URL.'/js/st-login.min.js', null, null, true);
// 	wp_enqueue_script( 'login-js-file');
// }
// add_action( 'wp_enqueue_scripts', 'brique_support_scripts' );
