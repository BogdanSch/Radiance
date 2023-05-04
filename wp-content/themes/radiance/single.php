<?php get_header(); ?>
<main id="main">
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-8">
                    <?php if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('partials/posts/content', 'excerpt');
                        }
                    }
                    ?>
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item">
                            <?php previous_posts_link("← Older"); ?>
                        </li>
                        <li class="page-item">
                            <?php next_posts_link("Newer →"); ?>
                        </li>
                    </ul>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>