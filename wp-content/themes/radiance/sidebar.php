<div class="col-lg-4">
    <div class="sidebar" data-aos="fade-up" data-aos-duration="1000">
        <?php
        get_search_form();
        if (is_active_sidebar('radiance_sidebar')) {
            dynamic_sidebar('radiance_sidebar');
        }
        ?>
    </div>
</div>