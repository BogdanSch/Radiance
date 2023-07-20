<?php
/**
 * Template part for displaying post excerpt
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package radiance
 */

$post = new cArticle(get_the_ID());
?>
<article class="entry" data-aos="fade-up" data-aos-duration="1000">
    <?php if ($post->getImg()) { ?>
        <div class="entry-img">
            <img decoding="async" src="<?php echo $post->getImg(); ?>" class="card-img-top" alt="<?php echo $post->getTitle(); ?>">
        </div>
    <?php } ?>
    <h2 class="entry-title">
        <a href="<?php echo $post->getLink(); ?>"><?php echo $post->getTitle(); ?></a>
    </h2>
    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                <a href="<?php echo $post->getAuthorLink(); ?>"><?php echo $post->getAuthorName(); ?></a></a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                <?php echo $post->getDate(); ?>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i>
                <?php comments_number("0"); ?>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-tags"></i>
                <?php $post->getCategories(); ?>
            </li>
        </ul>
    </div>
    <div class="entry-content">
        <p>
            <?php echo $post->getExcerpt(); ?>
        </p>
        <div class="read-more">
            <a href="<?php echo $post->getLink(); ?>">Read More</a>
        </div>
    </div>
</article>