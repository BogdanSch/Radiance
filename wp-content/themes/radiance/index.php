<?php get_header(); ?>
<!-- ======= Hero Section ======= -->
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
                <img src="<?php bloginfo('template_directory') ?>/assets/img/hero-img.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section><!-- End Hero -->
<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <!-- Marketing Icons Section -->
            <div class="row">
                <div class="col-md-8">
                    <?php if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            get_template_part('partials/posts/content', 'excerpt');
                        }
                    }
                    ?>
                    <!-- Pagination -->
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item">
                            <?php previous_posts_link("← Older"); ?>
                        </li>
                        <li class="page-item">
                            <?php next_posts_link("Newer →"); ?>
                        </li>
                    </ul>
                </div>
                <?php get_sidebar(); ?>
            </div>
            <!-- /.row -->
        </div>
    </section><!-- End About Section -->
</main><!-- End #main -->
<?php get_footer(); ?>