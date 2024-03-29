<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @package WordPress
 * @subpackage Radiance
 * @since Radiance 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>FlexStart Bootstrap Template - Index</title>
    <meta content="Custom wordpress theme" name="description">
    <meta content="custom, theme, wordpress" name="keywords">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0">
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?php _e(site_url()); ?>" class="logo d-flex align-items-center">
                <img src="<?php bloginfo('template_directory') ?>/assets/img/logo.png" alt="logo">
                <span>
                    <?php _e(get_bloginfo("title")) ?>
                </span>
            </a>
            <nav id="navbar" class="navbar">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => '',
                            'fallback_cb' => false,
                            'walker' => new Radiance_Nav_Walker(),
                        )
                    );
                }
                ?>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <main id="main" class="main">
        <?php if (is_front_page()) { ?>
            <section id="hero" class="hero d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <h1 data-aos="fade-up">
                                <?php echo get_theme_mod('hero_title', 'We offer modern solutions for growing your business'); ?>
                            </h1>
                            <h2 data-aos="fade-up" data-aos-delay="400">
                                <?php echo get_theme_mod('hero_description', 'We are a team of talented designers making websites with Bootstrap'); ?>
                            </h2>
                            <div data-aos="fade-up" data-aos-delay="500">
                                <div class="text-center text-lg-start">
                                    <a href="<?php echo esc_url(get_theme_mod('hero_button_link', '#about')); ?>"
                                        class="btn-get-started d-inline-flex align-items-center justify-content-center align-self-center">
                                        <span>
                                            <?php echo get_theme_mod('hero_button_text', 'Get Started'); ?>
                                        </span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                            <img src="<?php bloginfo('template_directory') ?>/assets/img/hero-img.png" class="img-fluid"
                                alt="hero-image">
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>