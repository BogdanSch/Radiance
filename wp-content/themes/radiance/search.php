<?php get_header(); ?>

<main class="main">
    <section class="search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <?php _e('Search Results for:', 'radiance'); ?>
                        <?php the_search_query(); ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="search-result">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-header">
                        <?php _e('What are you searhing for today?', 'radiance'); ?>
                    </div>
                    <div class="card-body">
                        <?php get_search_form(); ?>
                    </div>
                    <?php if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('partials/posts/content', 'excerpt');
                        }
                    } else {
                        get_template_part('partials/posts/content', 'none');
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