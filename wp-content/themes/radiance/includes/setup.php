<?php
function radiance_setup_theme()
{
    add_theme_support('post-thumbnails');
    add_theme_support('social-media-links', array('facebook', 'twitter', 'instagram'));
    register_nav_menu('primary', __('Primary Menu', 'radiance'));
    register_nav_menu('footer', __('Footer Menu', 'radiance'));
}