<?php get_header(); ?>
<section id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single" data-aos="fade-up" data-aos-duration="1000">
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

                            <?php
                        }
                    } ?>
                </article>
                <div class="blog-author d-flex align-items-center" data-aos="fade-up" data-aos-duration="1000">
                    <div class="author-image">
                        <?php echo get_avatar($author_ID, 90, '', false, ['class' => 'img-circle']); ?>
                    </div>
                    <div class="blog-author__body">
                        <strong>
                            About
                            <a href="<?php echo $author_URL; ?>"><?php the_author(); ?></a>
                        </strong>
                        <p>
                            <?php echo nl2br(get_the_author_meta('description')); ?>
                        </p>
                    </div>
                </div>
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>