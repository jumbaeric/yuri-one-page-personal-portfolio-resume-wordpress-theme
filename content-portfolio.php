    <!-- ======= Portfolio Details Section ======= -->
    <?php $categories = get_the_terms(get_the_ID(), 'category'); ?>
    <?php
    $classes = "";
    foreach ($categories as $category) {
        $classes .= $category->name . ' ';
    }
    ?>
    <section id="portfolio-<?php the_ID(); ?>" <?php post_class('portfolio-details'); ?>>
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">

                            <?php
                            $photos_array = get_post_meta(get_the_ID(), 'gallery_data', true);
                            $url_array = $photos_array['image_url'];
                            $count = sizeof($url_array);
                            if ($count) :
                                for ($i = 0; $i < $count; $i++) {
                            ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $url_array[$i]; ?>" alt="">
                                    </div>
                                <?php
                                }
                            else : ?>
                                <div class="swiper-slide">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large') ?>
                                </div>
                            <?php endif;
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Category</strong>: <?php echo $classes; ?></li>
                            <li><strong>Client</strong>:
                                <?php echo get_post_meta(get_the_ID(), '_client_meta_field', true) ?></li>
                            <li><strong>Project date</strong>:
                                <?php echo get_post_meta(get_the_ID(), '_project_date_meta_field', true) ?></li>
                            <li><strong>Project URL</strong>: <a target="_blank" href="<?php echo get_post_meta(get_the_ID(), '_project_url_meta_field', true) ?>"><?php echo get_post_meta(get_the_ID(), '_project_url_meta_field', true) ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <?php the_content(); ?>
                    </div>
                    <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . esc_html__('Pages:', 'yuri-lucas') . '</span>', 'after' => '</div>')); ?>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->