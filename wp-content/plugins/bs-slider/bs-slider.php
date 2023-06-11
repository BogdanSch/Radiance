<?php
/*
 * Plugin Name: Bs Slider
 * Description: Simple slider for the posts with pictures
 * Version: 1.0
 * Author: RoCreator
 * Author URI: https://github.com/BogdanSch/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

if (!function_exists('add_action')) {
    echo "Hi there! I'm just a plugin, no much I can do when called directly.";
    exit;
}

// Setup
define('KC_PLUGIN_URL', __FILE__);
// Includes
include 'includes/admin/admin.php';
include "includes/front/enqueue.php";
include 'process/bs_show_slider.php';
// Hooks
add_action('wp_enqueue_scripts', 'kc_enqueue_scripts', 100);
add_action('admin_menu', 'bs_create_menu');
// Shortcodes
function bs_show_slider_shortcode($content)
{
    return bs_show_slider($content);
}
add_shortcode('bs_show_slider', 'bs_show_slider_shortcode');
