</main>
<footer id="footer" class="footer" data-aos="fade-up" data-aos-duration="1000">
    <?php get_sidebar("footer") ?>
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="<?php bloginfo('template_directory') ?>/assets/img/logo.png" alt="logo">
                        <span>FlexStart</span>
                    </a>
                    <p>FlexStart is the theme based on bootstrap and modified for Wordpress by Bohdan Shcherbak</p>
                    <div class="social-links mt-3">
                        <?php
                        $social_links = get_theme_mod('social_media_links');
                        if ($social_links) {
                            foreach ($social_links as $social_link) {
                                if (!empty($social_link)) {
                                    $platform = parse_url($social_link, PHP_URL_HOST); // Extract the current platform from the full link
                                    $platform = str_replace('.com', '', $platform);
                                    $icon_class = 'bi bi-' . $platform;
                                    _e('<a href="' . esc_url($social_link) . '" class="'.$platform.'"><i class="' . esc_attr($icon_class) . '"></i></a>');
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <?php
                    if (has_nav_menu('footer')) {
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'container' => false,
                            'menu_class' => 'menu',
                            'fallback_cb' => false,
                            'depth' => 2,
                            'walker' => new Radiance_Nav_Footer_Walker(),
                        ]);
                    }
                    ?>
                </div>
                <?php get_sidebar("footer-links") ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Bohdan Shcherbak</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<?php wp_footer(); ?>

</body>

</html>