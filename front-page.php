<?php

/**
 * Template Name: Front-Page
 * Description: The template for displaying the Front-Page.
 *
 */

get_header();
$page_id = get_option('page_for_posts');
?>

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_2_title', 'About')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_2_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
            </p>
        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
                <img src="<?php echo esc_url(get_theme_mod('section_2_image', get_template_directory_uri() . '/assets/img/profile-img.jpg')) ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3><?php echo esc_html(get_theme_mod('section_2_sub_title', 'UI/UX Designer &amp; Web Developer.')) ?></h3>
                <p class="fst-italic">
                    <?php echo esc_html(get_theme_mod('section_2_sub_title_top_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')) ?>
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_1_key', 'Birthday')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_1_value', '24 Feb 1989')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_2_key', 'Website')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_2_value', 'www.ericjumba.com')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_3_key', 'Phone')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_3_value', '+254 777 618')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_4_key', 'City')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_4_value', 'Nairobi, Kenya')) ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_5_key', 'Age')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_5_value', '34')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_6_key', 'Education')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_6_value', 'IT Degree')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_7_key', 'Email')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_7_value', 'jumbaeric@gmail.com')) ?></span>
                            </li>
                            <li><i class="bi bi-chevron-right"></i>
                                <strong><?php echo esc_html(get_theme_mod('section_2_info_8_key', 'Freelance')) ?>:</strong>
                                <span><?php echo esc_html(get_theme_mod('section_2_info_8_value', 'Available')) ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <p>
                    <?php echo esc_html(get_theme_mod('section_2_sub_title_bottom_description', 'Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis.
                    Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque. Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.')) ?>
                </p>
            </div>
        </div>

    </div>
</section><!-- End About Section -->

<!-- ======= Facts Section ======= -->
<section id="facts" class="facts">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_2_title_2', 'Facts')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_2_title_2_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
            </p>
        </div>

        <div class="row no-gutters">

            <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                <div class="count-box">
                    <i class="<?php echo esc_html(get_theme_mod('section_2_stats_icon_1', 'bi bi-emoji-smile')) ?>"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo esc_attr(get_theme_mod('section_2_stats_number_1', '232')) ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong><?php echo esc_html(get_theme_mod('section_2_stats_text_1', 'Happy Clients')) ?></strong></p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="count-box">
                    <i class="<?php echo esc_html(get_theme_mod('section_2_stats_icon_2', 'bi bi-journal-richtext')) ?>"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo esc_attr(get_theme_mod('section_2_stats_number_2', '124')) ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong><?php echo esc_html(get_theme_mod('section_2_stats_text_2', 'Projects')) ?></strong></p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="count-box">
                    <i class="<?php echo esc_html(get_theme_mod('section_2_stats_icon_3', 'bi bi-headset')) ?>"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo esc_attr(get_theme_mod('section_2_stats_number_3', '1424')) ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong><?php echo esc_html(get_theme_mod('section_2_stats_text_3', 'Hours Of Support')) ?></strong></p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="count-box">
                    <i class="<?php echo esc_html(get_theme_mod('section_2_stats_icon_4', 'bi bi-people')) ?>"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo esc_attr(get_theme_mod('section_2_stats_number_4', '32')) ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong><?php echo esc_html(get_theme_mod('section_2_stats_text_4', 'Hard Workers')) ?></strong></p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Facts Section -->

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills section-bg">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_2_title_3', 'Skills')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_2_title_3_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
            </p>
        </div>

        <div class="row skills-content">

            <div class="col-lg-6" data-aos="fade-up">

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_1', 'HTML')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_1_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_1_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_2', 'CSS')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_2_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_2_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_3', 'Javascript')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_3_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_3_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_4', 'PHP')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_4_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_4_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_5', 'WordPress/CMS')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_5_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_5_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill"><?php echo esc_html(get_theme_mod('section_2_skill_6', 'Photoshop')) ?> <i class="val"><?php echo esc_html(get_theme_mod('section_2_skill_6_level', '90')) ?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr(get_theme_mod('section_2_skill_6_level', '90')) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section><!-- End Skills Section -->

<!-- ======= Resume Section ======= -->
<section id="resume" class="resume">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_3_title_1', 'Resume')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_3_title_1_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
            </p>
        </div>

        <div class="row">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="resume-title"><?php echo esc_html(get_theme_mod('section_3_title_1', 'Summary')) ?></h3>
                <div class="resume-item pb-0">
                    <h4><?php echo esc_html(get_theme_mod('resume_names', 'Yuri Lucas')) ?></h4>
                    <p><em><?php echo esc_html(get_theme_mod('section_3_summary_description', 'Innovative and deadline-driven Graphic Designer with 3+ years of experience designing and developing user-centered digital/print marketing material from initial concept to final, polished deliverable.')) ?></em>
                    </p>
                    <ul>
                        <li><?php echo esc_html(get_theme_mod('section_3_summary_location', 'Muthithi Rd, Westlands')) ?></li>
                        <li><?php echo esc_html(get_theme_mod('section_3_summary_phone', '(254) 723 777 618')) ?></li>
                        <li><?php echo esc_html(get_theme_mod('section_3_summary_email', 'jumbaeric@gmail.com')) ?></li>
                    </ul>
                </div>

                <h3 class="resume-title"><?php echo esc_html(get_theme_mod('section_3_education_text', 'Education')) ?></h3>
                <div class="resume-item">
                    <h4><?php echo esc_html(get_theme_mod('section_3_award_1', 'Master of Fine Arts &amp; Graphic Design')) ?>
                    </h4>
                    <h5><?php echo esc_html(get_theme_mod('section_3_award_1_year', '2015 - 2016')) ?></h5>
                    <p><em><?php echo esc_html(get_theme_mod('section_3_award_1_school', 'University of Nairobi')) ?></em></p>
                    <p><?php echo esc_html(get_theme_mod('section_3_award_1_description', 'Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend')) ?>
                    </p>
                </div>
                <div class="resume-item">
                    <h4><?php echo esc_html(get_theme_mod('section_3_award_2', 'Master of Fine Arts &amp; Graphic Design')) ?>
                    </h4>
                    <h5><?php echo esc_html(get_theme_mod('section_3_award_2_year', '2015 - 2016')) ?></h5>
                    <p><em><?php echo esc_html(get_theme_mod('section_3_award_2_school', 'University of Nairobi')) ?></em></p>
                    <p><?php echo esc_html(get_theme_mod('section_3_award_2_description', 'Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend')) ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <h3 class="resume-title">
                    <?php echo esc_html(get_theme_mod('section_3_experience_text', 'Professional Experience')) ?></h3>
                <div class="resume-item">
                    <?php
                    $cont = "<ul>
                    <li>Developed numerous marketing programs (logos, brochures,infographics, presentations, and advertisements).</li>
                    <li>Managed up to 5 projects or tasks at a given time while under pressure</li>
                    <li>Recommended and consulted with clients on the most appropriate graphic design</li>
                    <li>Created 4+ design presentations and proposals a month for clients and account managers</li>
                    </ul>";
                    ?>
                    <h4><?php echo esc_html(get_theme_mod('section_3_experience_1', 'Senior Backend Developer')) ?></h4>
                    <h5><?php echo esc_html(get_theme_mod('section_3_experience_1_year', '2019 - Present')) ?></h5>
                    <p><em><?php echo esc_html(get_theme_mod('section_3_experience_1_company', 'Yellow Pages Kenya')) ?></em></p>
                    <?php echo wp_kses(get_theme_mod('section_3_experience_1_description', $cont), 'post') ?>
                </div>
                <div class="resume-item">
                    <h4><?php echo esc_html(get_theme_mod('section_3_experience_2', 'Backend Developer')) ?></h4>
                    <h5><?php echo esc_html(get_theme_mod('section_3_experience_2_year', '2019 - 2021')) ?></h5>
                    <p><em><?php echo esc_html(get_theme_mod('section_3_experience_2_company', 'WPP, Squad Digital')) ?></em></p>
                    <?php echo wp_kses(get_theme_mod('section_3_experience_2_description', $cont), 'post') ?>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Resume Section -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio section-bg">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_4_title_1', 'Portfolio')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_4_title_1_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>

        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <?php
                    $args = [
                        'post_type' => 'portfolios',
                        'posts_per_page' => -1
                    ];
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $terms = get_the_terms($post->ID, 'category');
                            if ($terms) {
                                foreach ($terms as $category) {
                                    echo '<li data-filter=".filter-' . $category->slug . '">' . $category->name . '</li>';
                                }
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $args = array(
            'post_type' => 'portfolios',
            'numberposts' => '6',
            'post_status' => 'publish'
        );
        $portfolios = get_posts($args); ?>
        <?php if (!empty($portfolios)) : ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

                <?php foreach ($portfolios as $portfolio) : ?>
                    <?php $categories = get_the_terms($portfolio->ID, 'category'); ?>
                    <?php
                    $classes = "";
                    foreach ($categories as $category) {
                        $classes .= 'filter-' . $category->slug . ' ';
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?php echo esc_attr($classes); ?>">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_the_post_thumbnail_url($portfolio->ID) ?>" class="img-fluid" alt="<?php echo esc_attr($portfolio->post_title) ?>">
                            <div class="portfolio-links">
                                <a href="<?php echo get_the_post_thumbnail_url($portfolio->ID) ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1">
                                    <i class="bx bx-plus"></i></a>
                                <a href="<?php echo get_the_permalink($portfolio->ID) ?>" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section><!-- End Portfolio Section -->

<!-- ======= Services Section ======= -->
<section id="services" class="services">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_5_title_1', 'Services')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_5_title_1_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
        </div>

        <?php
        $args = array(
            'post_type' => 'services',
            'numberposts' => '6',
            'post_status' => 'publish'
        );
        $services = get_posts($args); ?>
        <?php if (!empty($services)) : ?>

            <div class="row">
                <?php foreach ($services as $service) : ?>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon"><i class="bi <?php echo get_post_meta($service->ID, '_service_meta_field', true) ?>"></i></div>
                        <h4 class="title"><a href=""><?php echo esc_html($service->post_title) ?></a></h4>
                        <p class="description"><?php echo esc_html($service->post_excerpt) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section><!-- End Services Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_6_title_1', 'Testimonials')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_6_title_1_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
        </div>

        <?php
        $args = array(
            'post_type' => 'testimonials',
            'numberposts' => '5',
            'post_status' => 'publish'
        );
        $testimonials = get_posts($args); ?>
        <?php if (!empty($testimonials)) : ?>
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial) : ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    <?php echo esc_html($testimonial->post_excerpt) ?>
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="<?php echo get_the_post_thumbnail_url($testimonial->ID) ?>" class="testimonial-img" alt="<?php echo esc_attr($testimonial->post_title) ?>">
                                <h3><?php echo esc_html($testimonial->post_title) ?></h3>
                                <h4><?php echo get_post_meta($testimonial->ID, '_testimonial_profession_meta_field', true) ?>
                                </h4>
                            </div>
                        </div><!-- End testimonial item -->
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        <?php endif; ?>
    </div>
</section><!-- End Testimonials Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html(get_theme_mod('section_7_title_1', 'Contact')) ?></h2>
            <p><?php echo esc_html(get_theme_mod('section_7_title_1_description', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.')) ?>
        </div>

        <div class="row" data-aos="fade-in">

            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4><?php echo esc_html(get_theme_mod('section_7_contact_location_text', 'Location')) ?>:</h4>
                        <p><?php echo esc_html(get_theme_mod('section_7_contact_location', 'Muthithi Rd, Westlands')) ?></p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4><?php echo esc_html(get_theme_mod('section_7_contact_email_text', 'Email')) ?>:</h4>
                        <p><?php echo esc_html(get_theme_mod('section_7_contact_email', 'jumbaeric@gmail.com')) ?></p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4><?php echo esc_html(get_theme_mod('section_7_contact_phone_text', 'Phone')) ?>:</h4>
                        <p><?php echo esc_html(get_theme_mod('section_7_contact_phone', '(254) 723 777 618)')) ?></p>
                    </div>

                    <iframe src="<?php echo esc_url(get_theme_mod('section_7_contact_map')) ?>" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                </div>

            </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" rows="10" required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->

<?php
get_footer();
