<?php
function bs_show_slider($content)
{
    $args = [
        'showposts' => get_option('kc_count'),
        'category_name' => get_option('kc_category_name'),
        'post_type' => get_option('kc_post_type') ? get_option('kc_post_type') : 'post',
        'tag' => get_option('kc_tag'),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $query = new WP_Query($args);

    $html = '';
    if ($query->have_posts()) {
        $html = <<<EOD
        <section class="posts-slider">
    <div class="row">
        <div class="col-lg-12 columns">
            <div class="carousel slide" data-ride="carousel" id="bootSlider">
            <div class="carousel-inner">
  EOD;
        $count = 0;
        $slider_indicators = '<ol class="carousel-indicators">';
        while ($query->have_posts()) {
            $query->the_post();
            if($count == 0){
                $html .= '<div class="carousel-item active">';

            }else{
                $html .= '<div class="carousel-item">';

            }
            $html .= '<img src="' . get_the_post_thumbnail_url($query->post->ID, 'thumbnail') . '" class="d-block w-100 h-100" alt="post-image">';
            $html .= '<div class="carousel-caption d-none d-md-block">';
            $html .= '<a href="' . get_permalink($query->post->ID) . '">' . $query->post->post_title . '</a>';
            $html .= '<p >' . $query->post->post_date . '</p>';
            $html .= '</div></div>';
            $count++;
        }
        for ($i=0; $i < $count; $i++) { 
            if($i == 0){
                $slider_indicators .= '<li data-target="#bootSlider" data-slide-to="'.$i.'" class="active"></li>';
            }else{
                $slider_indicators .= '<li data-target="#bootSlider" data-slide-to="'.$i.'"></li>';
            }
        }
        $slider_indicators .= '</ol>';
        $html .= <<<EOD
            </div>
            $slider_indicators
            <a class="carousel-control-prev" href="#bootSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#bootSlider" role="button" data-slide="next">
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