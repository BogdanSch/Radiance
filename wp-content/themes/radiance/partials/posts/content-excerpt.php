<article class="entry">
    <div class="entry-img">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail("full", ["class" => "card-img-top"]);
        }
        ?>
    </div>
    <h2 class="entry-title">
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
    </h2>
    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author() ?></a></a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                <?php echo get_the_date(); ?>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i>
                <?php comments_number("0"); ?>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-tags"></i>
                <?php the_category(", ") ?>
            </li>
        </ul>
    </div>
    <div class="entry-content">
        <p>
            <?php the_excerpt() ?>
        </p>
        <div class="read-more">
            <a href="<?php the_permalink() ?>">Read More</a>
        </div>
    </div>
</article>