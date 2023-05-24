<?php
function radiance_social_register($wp_customize)
{
    $wp_customize->add_section('social_media_links', array(
        'title' => 'Social Media Links',
        'priority' => 120,
    )
    );

    $social_media_platforms = array('facebook', 'twitter', 'instagram');

    foreach ($social_media_platforms as $platform) {
        $wp_customize->add_setting('social_media_links[' . $platform . ']', array(
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
        )
        );

        $wp_customize->add_control('social_media_links_' . $platform, array(
            'label' => ucfirst($platform),
            'section' => 'social_media_links',
            'settings' => 'social_media_links[' . $platform . ']',
            'type' => 'text',
        )
        );
    }
}