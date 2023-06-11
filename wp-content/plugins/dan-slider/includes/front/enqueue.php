<?php
function kc_enqueue_scripts()
{
    // Подключение jQuery slim
    wp_enqueue_script(
        'jquery-slim',
        'https://code.jquery.com/jquery-3.2.1.slim.min.js',
        [],
        '3.2.1',
        true
    );

    // Подключение Popper.js
    wp_enqueue_script(
        'popper',
        'https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js',
        ['jquery-slim'],
        '1.12.9',
        true
    );

    // Подключение Bootstrap JS
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js',
        ['jquery-slim', 'popper'],
        '4.0.0',
        true
    );

    // Подключение Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css'
    );

    wp_register_style('kc_theme', plugins_url('/assets/styles.css', KC_PLUGIN_URL));
    wp_enqueue_style('kc_theme');
}

