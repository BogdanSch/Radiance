<?php

function dan_show_slider($content)
{
    $args = [
        'post_type' => get_option('kc_post_type') ? get_option('kc_post_type') : 'post',
        'showposts' => get_option('kc_count') ? get_option('kc_count') : 3,
        'category_name' => get_option('kc_category_name'),
        'post_bg' => get_option('kc_background_type'),
        'default_post_bg' => get_option('kc_default_background_type'),
        'tag' => get_option('kc_tag'),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $query = new WP_Query($args);
    $html = '';
    if ($query->have_posts()) {
        $html = '<div class="container">
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">';
        $postNumber = 0;
        $post_indexes = array_keys($query->posts);
        foreach ($query->posts as $index => $post) {
            $extraClass = "";
            if ($postNumber === 0) $extraClass = "active";
            $postNumber = 1;
            $html .= '<li data-target="#carouselExampleCaptions" data-slide-to="' . $post_indexes[$index] . '" class="' . $extraClass . '"></li>';
        }
        $html .= ' </ol>
        <div class="carousel-inner">';
        $postNumber = 0;
        foreach ($query->posts as $index => $post) {
            $extraClass = "";
            if ($postNumber === 0) $extraClass = "active";
            $postNumber = 1;
            $html .= '<div class="carousel-item ' . $extraClass . '">';
            if ($args['post_bg'] === 'custom_color') $html .= '<div style="background-color: ' . get_option('kc_bg_color') . ';" class="d-block post_image w-100"></div>';
            if ($args['post_bg'] === 'post_image') {
                if (get_post_thumbnail_id($post->ID)) {
                    $html .= '<img class="d-block post_image w-100" alt="' . $post->post_title . '" src="' . wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'full') . '">';
                } else {
                    if ($args['default_post_bg'] === 'default_color') $html .= '<div style="background-color: ' . get_option('kc_bg_color') . ';" class="d-block post_image w-100"></div>';
                    if ($args['default_post_bg'] === 'default_image') $html .= '<img class="d-block post_image w-100" alt="' . $post->post_title . '" src="' . wp_get_attachment_image_url(get_option('image_attachment_id'), 'full')  . '">';
                }
            }
            if ($args['post_bg'] === 'custom_image') $html .= '<img class="d-block post_image w-100" alt="' . $post->post_title . '" src="' . wp_get_attachment_image_url(get_option('image_attachment_id'), 'full')  . '">';
            $html .= '<div class="carousel-caption d-none d-md-block">
                <h5><a style="color:' . get_option('kc_text_color') . ' !important;" class="post_name" href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></h5>';
            $post_content = get_post_field('post_content', $post->ID);
            $trimmed_content = wp_trim_words($post_content, 7, '...');
            $html .= '<p style="color:' . get_option('kc_text_color') . ';">' . $trimmed_content . '</p>
            </div>
        </div>';
        }
        $html .= '</div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>
</div>';
    }
    wp_reset_postdata();
    return $content . $html;
}
