<div class="col-lg-4">
    <div class="sidebar">
        <?php
        get_search_form();
        if (is_active_sidebar('radiance_sidebar')) {
            dynamic_sidebar('radiance_sidebar');
        }
        ?>
    </div>
</div>