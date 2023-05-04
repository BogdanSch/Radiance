<?php get_header(); ?>
<main id="main">
    <?php if (is_front_page()) { ?>
        <section id="hero" class="hero d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">We offer modern solutions for growing your business</h1>
                        <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented designers making websites with
                            Bootstrap</h2>
                        <div data-aos="fade-up" data-aos-delay="500">
                            <div class="text-center text-lg-start">
                                <a href="#about"
                                    class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Get Started</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="<?php bloginfo('template_directory') ?>/assets/img/hero-img.png" class="img-fluid"
                            alt="hero-image">
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (is_home()) {
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('partials/posts/content-excerpt');
                        }
                    }
                } else {
                    the_content();
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>