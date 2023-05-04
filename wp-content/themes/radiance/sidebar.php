<div class="col-md-4">
    <?php
        get_search_form();
        if (is_active_sidebar('radiance_sidebar')) {
            dynamic_sidebar('radiance_sidebar');
        }
    ?>
</div>