<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<div class="search my-4">
    <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form">
        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
            <input type="search" id="<?php echo $unique_id; ?>" name="s" value="<?php echo get_search_query() ?>"
                placeholder="<?php _e('Search for...'); ?>" class="form-control">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>
<!-- End sidebar search formn-->