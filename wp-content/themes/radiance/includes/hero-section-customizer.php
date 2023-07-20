<?php
function hero_section_customize_register($wp_customize) {
    $wp_customize->add_section('hero_section', array(
        'title' => 'Hero Section',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default' => 'We offer modern solutions for growing your business',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => 'Title',
        'section' => 'hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_description', array(
        'default' => 'We are a team of talented designers making websites with Bootstrap',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_description', array(
        'label' => 'Description',
        'section' => 'hero_section',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('hero_button_text', array(
        'default' => 'Get Started',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_button_text', array(
        'label' => 'Button Text',
        'section' => 'hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_button_link', array(
        'default' => '#about',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_button_link', array(
        'label' => 'Button Link',
        'section' => 'hero_section',
        'type' => 'url',
    ));

    $wp_customize->add_setting('hero_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => 'Hero Image',
        'section' => 'hero_section',
        'settings' => 'hero_image',
    )));
}
