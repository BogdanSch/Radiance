<?php
/*
 * Plugin Name: Dan Slider
 * Plugin URI:
 * Description: Simple slider
 * Version: 1.0
 * Author: D. N. S.
 * Author URI: https://github.com/777dan
 * License:           GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

// Setup
define('KC_PLUGIN_URL', __FILE__);

// Includes
include 'includes/front/enqueue.php';
include 'process/dan-show-slider.php';
include 'includes/admin/admin.php';

// Hooks
add_action('wp_enqueue_scripts', 'kc_enqueue_scripts', 100);
// add_filter('the_content', 'kc_show_carousel');
add_action('admin_menu', 'kc_create_menu');

add_action('admin_enqueue_scripts', 'wp_enqueue_media');

// Shortcodes
function dan_show_slider_shortcode($content)
{
    return dan_show_slider($content);
}
add_shortcode('dan_show_slider', 'dan_show_slider_shortcode');
