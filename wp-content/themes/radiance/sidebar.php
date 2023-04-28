<!-- Sidebar Widgets Column -->
<div class="col-md-4">
    <?php
        get_search_form();
        if (is_active_sidebar('bootkit_sidebar')) {
            dynamic_sidebar('bootkit_sidebar');
        }
    ?>
</div>