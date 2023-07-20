<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package radiance
 */
$post = new cArticle(get_the_ID());
?>
<article class="entry entry-single" data-aos="fade-up" data-aos-duration="1000">
    <?php if ($post->getImg()) { ?>
        <div class="entry-img">
            <img decoding="async" src="<?php echo $post->getImg(); ?>" class="card-img-top"
                alt="<?php echo $post->getTitle(); ?>">
        </div>
    <?php } ?>
    </div>
    <h1 class="mt-4">
        <?php echo $post->getTitle(); ?> by <a href="<?php echo $post->getAuthorLink(); ?>"><?php echo $post->getAuthorName(); ?></a>
    </h1>
    <h3 class="mt-2">
        <?php echo $post->getCategoryString(); ?>
    </h3>
    <p>
        Post date:
        <?php echo $post->getDate(); ?>
    </p>
    <p class="card-text mt-4">
        <?php echo $post->getContent();
        $defaults = [
            'before' => '<div class="row justify-content-center align-items-center">' . __('Pages:'),
            'after' => '</div>',
        ];
        wp_link_pages($defaults);
        ?>
    </p>
    <div class="tags mb-4">
        <?php echo $post->getTagsString(); ?>
    </div>
    <?php edit_post_link("Edit"); ?>
</article>
<div class="blog-author d-flex align-items-center" data-aos="fade-up" data-aos-duration="1000">
    <div class="author-image">
        <?php echo $post->getAuthorImg(); ?>
    </div>
    <div class="blog-author__body">
        <strong>
            About
            <a href="<?php echo $post->getAuthorLink(); ?>"><?php echo $post->getAuthorName(); ?></a>
        </strong>
        <p>
            <?php echo $post->getAuthorDescription(); ?>
        </p>
    </div>
</div>
<?php
if (comments_open() || get_comments_number()) {
    comments_template();
}
?>