<?php get_header(); ?>
<section id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 entries">
                <?php if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part("partials/posts/content", "single_post");
                    }
                } ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>