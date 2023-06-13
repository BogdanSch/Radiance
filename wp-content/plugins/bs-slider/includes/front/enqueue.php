<?php
function kc_enqueue_scripts()
{
    $version = BOOTSTRAPTOPIC_DEV_MODE ? time() : false;
    // wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], $version);
    // wp_register_style('bootslider', plugins_url('/assets/css/slider.css', KC_PLUGIN_URL), [], $version);
    // wp_register_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], $version);
    // wp_register_script('bootstrap-js-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', [], $version);

    // wp_enqueue_style('bootstrap');
    // wp_enqueue_style('bootslider');
    // wp_enqueue_script('jquery');
    // wp_enqueue_script('bootstrap-js');
    // wp_enqueue_script('bootstrap-js-bundle');

    // Enqueue Bootstrap CSS if not already enqueued in the theme
    if (!wp_style_is('bootstrap', 'enqueued')) {
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], $version);
    }
    // Enqueue Bootslider CSS if not already enqueued in the theme
    if (!wp_style_is('bootslider', 'enqueued')) {
        wp_enqueue_style('bootslider', plugins_url('/assets/css/slider.css', KC_PLUGIN_URL), [], $version);
    }
    // Enqueue Bootstrap JS if not already enqueued in the theme
    if (!wp_script_is('bootstrap-js', 'enqueued')) {
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', ['jquery'], $version, true);
    }
    // Enqueue Bootstrap Bundle JS if not already enqueued in the theme
    if (!wp_script_is('bootstrap-js-bundle', 'enqueued')) {
        wp_enqueue_script('bootstrap-js-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', ['jquery'], $version, true);
    }
    // Enqueue jQuery if not already enqueued in the theme
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
}