<?php
function kc_enqueue_scripts()
{
    $version = BOOTSTRAPTOPIC_DEV_MODE ? time() : false;
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], $version);
    wp_register_style('bootslider', plugins_url('/assets/css/slider.css', KC_PLUGIN_URL));
    wp_register_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], $version);
    wp_register_script('bootstrap-js-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', [], $version);

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('bootslider');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('bootstrap-js-bundle');
}