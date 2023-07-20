<h1 class="mt-4 mb-3">Post 404
    <small>
        <?php _e("Post Not Found") ?>
    </small>
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?php get_site_url(); ?>">Home</a>
    </li>
    <li class="breadcrumb-item active">Post Not Found</li>
</ol>
<div class="jumbotron">
    <h1 class="display-1">Post Not Found</h1>
    <p>
        <?php _e("The post you're seeking  unfortunately can't be found or doesn't exist!") ?>
    </p>
</div>
<?php get_search_form(); ?>