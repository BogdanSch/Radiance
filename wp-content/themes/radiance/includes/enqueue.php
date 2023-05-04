<?php
function radiance_enqueue()
{
    $version = BOOTSTRAPTOPIC_DEV_MODE ? time() : false;
    $url = get_theme_file_uri();
    //Fonts
    wp_register_style('radiance_google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i', [], $version);
    //Styles
    wp_register_style('radiance_bootstrap', $url . '/assets/vendor/bootstrap/css/bootstrap.min.css', [], $version);
    wp_register_style('radiance_aos_css', $url . '/assets/vendor/aos/aos.css', [], $version);
    wp_register_style('radiance_bootstrap_icons', $url . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', [], $version);
    wp_register_style('radiance_bootstrap_glightbox', $url . '/assets/vendor/glightbox/css/glightbox.min.css', [], $version);
    wp_register_style('radiance_bootstrap_remixicon', $url . '/assets/vendor/remixicon/remixicon.css', [], $version);
    wp_register_style('radiance_bootstrap_swiper', $url . '/assets/vendor/swiper/swiper-bundle.min.css', [], $version);
    wp_register_style('radiance_theme_css', $url . '/assets/css/theme.css', [], $version);
    wp_register_style('radiance_main', $url . '/assets/css/radiance-main.css', [], $version);
    //Scripts
    wp_register_script('radiance_bootstrap', $url . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', ['jquery'], $version, true);
    wp_register_script('radiance_precounter', $url . '/assets/vendor/purecounter/purecounter_vanilla.js', ['jquery'], $version, true);
    wp_register_script('radiance_aos_js', $url . '/assets/vendor/aos/aos.js', ['jquery'], $version, true);
    wp_register_script('radiance_glightbox', $url . '/assets/vendor/glightbox/js/glightbox.min.js', ['jquery'], $version, true);
    wp_register_script('radiance_isotope', $url . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', ['jquery'], $version, true);
    wp_register_script('radiance_swiper', $url . '/assets/vendor/swiper/swiper-bundle.min.js', ['jquery'], $version, true);
    wp_register_script('radiance_email', $url . '/assets/vendor/php-email-form/validate.js', ['jquery'], $version, true);
    wp_register_script('radiance_custom_script', $url . '/assets/js/main.js', ['jquery'], $version, true);
    //Apply
    wp_enqueue_style('radiance_google_fonts');
    wp_enqueue_style('radiance_bootstrap');
    wp_enqueue_style('radiance_aos_css');
    wp_enqueue_style('radiance_bootstrap_icons');
    wp_enqueue_style('radiance_bootstrap_glightbox');
    wp_enqueue_style('radiance_bootstrap_remixicon');
    wp_enqueue_style('radiance_bootstrap_swiper');
    wp_enqueue_style('radiance_theme_css');
    wp_enqueue_style('radiance_main');
    wp_enqueue_script('jquery');
    wp_enqueue_script('radiance_bootstrap');
    wp_enqueue_script('radiance_precounter');
    wp_enqueue_script('radiance_aos_js');
    wp_enqueue_script('radiance_glightbox');
    wp_enqueue_script('radiance_isotope');
    wp_enqueue_script('radiance_swiper');
    wp_enqueue_script('radiance_email');
    wp_enqueue_script('radiance_custom_script');
}