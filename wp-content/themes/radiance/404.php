<?php get_header(); ?>

<div class="container">
    <h1 class="mt-4 mb-3">404
        <small>
            <?php _e("Page Not Found") ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php get_site_url(); ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">404</li>
    </ol>
    <div class="jumbotron">
        <h1 class="display-1">404</h1>
        <p>
            <?php _e("The page you're looking for could not be found or doesn't exist") ?>
        </p>
    </div>
    <?php get_search_form(); ?>
</div>

<?php get_footer(); ?>