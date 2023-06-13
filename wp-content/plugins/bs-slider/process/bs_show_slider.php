<?php
function bs_show_slider($content)
{
    $args = [
        'posts_per_page' => get_option('bs_count'),
        'category_name' => get_option('bs_category_name'),
        'post_type' => get_option('bs_post_type') ? get_option('kc_post_type') : 'post',
        'tag' => get_option('bs_tag'),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ];
    $query = new WP_Query($args);

    $html = '';
    if ($query->have_posts()) {
        $count_posts = $query->found_posts;
        $html = <<<EOD
        <section class="posts-slider">
            <div class="row">
                <div class="col-lg-12 columns">
                    <div class="carousel slide" data-bs-ride="carousel" id="bsSlider">
        EOD;
        if (get_option('bs_show_indicators')) {
            $html .= '<ol class="carousel-indicators">';
            for ($i = 0; $i < $count_posts; $i++) {
                if ($i == 0) {
                    $html .= '<li data-bs-ride="#bsSlider" data-bs-slide-to="' . $i . '" class="active"></li>';
                } else {
                    $html .= '<li data-bs-ride="#bsSlider" data-bs-slide-to="' . $i . '"></li>';
                }
            }
            $html .= '</ol>';
        }
        $html .= '<div class="carousel-inner">';
        $i = 0;
        while ($query->have_posts()) {
            $query->the_post();
            if ($i == 0) {
                $html .= '<div class="carousel-item active">';
            } else {
                $html .= '<div class="carousel-item">';
            }
            $html .= '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') . '" class="d-block w-100 h-100" alt="post-image">';
            $html .= '<div class="carousel-caption d-none d-md-block">';
            $html .= '<a href="' . get_permalink() . '" style="color:'.get_option('bs_text_color').';">' . get_the_title() . '</a>';
            $html .= '<p style="color:'.get_option('bs_text_color').';">' . get_the_date('F j, Y') . '</p>';
            $html .= '</div></div>';
            $i++;
        }
        $html .= <<<EOD
                    </div>
                    <a class="carousel-control-prev" href="#bsSlider" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#bsSlider" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        </section>
        EOD;
    }
    wp_reset_postdata();
    return $content . $html;
}