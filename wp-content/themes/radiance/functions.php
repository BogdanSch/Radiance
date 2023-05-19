<?php
// Setup
define('BOOTSTRAPTOPIC_DEV_MODE', true);
// Includes
include get_theme_file_path('includes/enqueue.php');
include get_theme_file_path('includes/setup.php');
include get_theme_file_path('includes/widgets.php');
include get_theme_file_path('includes/custom-nav-walker.php');
include get_theme_file_path('includes/custom-pagination-links.php');
include get_theme_file_path('includes/custom-nav-footer-walker.php');
// Hooks
add_action('wp_enqueue_scripts', 'radiance_enqueue');
add_action('widgets_init', 'radiance_widgets');
add_action('after_setup_theme', 'radiance_setup_theme');
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
// Shortcodes