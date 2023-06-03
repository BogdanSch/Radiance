<?php
/*
 * Template Name: Full Width Page
 * Template Post Type: page
 */
get_header(); ?>
<section class="content" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        } ?>
    </div>
</section>
<?php get_footer(); ?>