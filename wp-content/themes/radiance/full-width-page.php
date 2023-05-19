<?php
/*
 * Template Name: Full Width Page
 * Template Post Type: page
 */
get_header(); ?>
<main id="main">
    <section class="content">
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
</main>
<?php get_footer(); ?>