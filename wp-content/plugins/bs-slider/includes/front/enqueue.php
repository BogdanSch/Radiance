<?php
function kc_enqueue_scripts()
{
    $version = BOOTSTRAPTOPIC_DEV_MODE ? time() : false;
    wp_register_style('bs_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], $version);
    wp_register_style('bs_bootslider', plugins_url('/assets/css/slider.css', KC_PLUGIN_URL), [], $version);
    wp_register_script('bs_bootstrap-js-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', [], $version);
    //Enqueue
    wp_enqueue_style('bs_bootstrap');
    wp_enqueue_style('bs_bootslider');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bs_bootstrap-js-bundle');
}