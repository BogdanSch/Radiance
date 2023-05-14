<?php get_header(); ?>

<main id="main" class="main">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mt-2">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            if (is_home()) {
                                get_template_part('partials/posts/content-excerpt');
                            } else {
                                the_content();
                            }
                        }
                    } ?>
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
                </div>
                <?php echo get_sidebar(); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>