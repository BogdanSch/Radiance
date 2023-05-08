<?php
/*
* Template Name: Full Width Post
* Template Post Type: post
*/
get_header(); ?>
<main id="main">
    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 entries">
                    <article class="entry entry-single">
                        <?php if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                global $post;
                                $author_ID = $post->post_author;
                                $author_URL = get_author_posts_url($author_ID);
                                ?>
                                <div class="entry-img">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail("medium", ["class" => "card-img-top"]);
                                    }
                                    ?>
                                </div>
                                <h1 class="mt-4">
                                    <?php the_title() ?> by <a href="<?php echo $author_URL; ?>"><?php the_author(); ?></a>
                                </h1>
                                <h3 class="mt-2">
                                    <?php the_category(", ") ?>
                                </h3>
                                <p>
                                    Post date:
                                    <?php the_time(get_option('date_format'));
                                    echo " ";
                                    the_time(get_option('time_format')); ?>
                                </p>
                                <p class="card-text mt-4">
                                    <?php the_content();
                                    $defaults = array(
                                        'before' => '<div class="row justify-content-center align-items-center">' . __('Pages:'),
                                        'after' => '</div>',
                                    );
                                    wp_link_pages($defaults);
                                    edit_post_link("Edit");
                                    ?>
                                </p>
                                <div class="tags mb-4">
                                    <?php the_tags('', ', '); ?>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>
                                            About
                                            <a href="<?php echo $author_URL; ?>"><?php the_author(); ?></a>
                                        </strong>
                                    </div>
                                    <div class="card-body justify-content-space-between">
                                        <div class="author-image">
                                            <?php echo get_avatar($author_ID, 90, '', false, ['class' => 'img-circle']); ?>
                                        </div>
                                        <p>
                                            <?php echo nl2br(get_the_author_meta('description')); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </article>
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
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>