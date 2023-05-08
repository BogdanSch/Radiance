<?php
function radiance_widgets()
{
    register_sidebar([
        'name' => __('Radiance first Sidebar', 'radiance'),
        'id' => 'radiance_sidebar',
        'description' => __('Radiance first Sidebar for something.'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
    register_sidebar([
        'name' => __('Radiance footer Sidebar', 'radiance'),
        'id' => 'radiance_sidebar_footer',
        'description' => __('Radiance first Sidebar for something.'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
}