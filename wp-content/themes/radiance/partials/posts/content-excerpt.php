<!-- Blog Post -->
<div class="card mb-4">
    <div class="card-header m-0 p-0">
        <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail("medium", ["class" => "card-img-top"]);
            }
        ?>
    </div>
    <div class="card-body">
        <h2 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <p class="card-category">
            <?php the_category(", ") ?>
        </p>
        <p class="card-text">
            <?php the_excerpt() ?>
        </p>
        <a href="<?php the_permalink() ?>" class="btn btn-primary">Read More →</a>
    </div>
    <div class="card-footer text-muted">
        Posted on
        <?php echo get_the_date(); ?>
        by
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author() ?></a>
        <p class="card-footer-comments">
            Commets: 
            <?php comments_number("0"); ?>
        </p>
    </div>
</div>