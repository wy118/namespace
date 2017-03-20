<?php
/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name: Namespace Demo
 *
 */

use Wy_Namespace\Admin;
use Wy_Namespace\Admin\Util;
 
// If this file is accessed directory, then abort.
if (!defined('WPINC')) {
  die;
}

require_once( trailingslashit( dirname( __FILE__ ) ) . 'inc/autoload.php' );
 
add_action('add_meta_boxes', 'wy_namespace');
/**
 * Starts the plugin by initializing the meta box, its display, and then
 * sets the plugin in motion.
 */
function wy_namespace() {
  $meta_box = new Admin\Meta_Box(
        new Admin\Meta_Box_Display(
            new Util\Question_Reader()
        )
    );
 
    $meta_box->init();
}