<?php
/*
 * Template Name: Full Width Template
 * Template Post Type: post, page
 */
get_header();
?>

<?php if (is_singular('post')) { ?>
    <section id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 entries">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part("partials/posts/content", "single_post");
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="content" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 entries">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            the_content();
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<div class="blog-pagination">
    <ul class="pagination justify-content-center mb-4">
        <li>
            <?php previous_posts_link("← Older"); ?>
        </li>
        <li>
            <?php next_posts_link("Newer →"); ?>
        </li>
    </ul>
</div>

<?php get_footer(); ?>