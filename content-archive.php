<?php

/**
 * The template for displaying content in the index.php template.
 */
$primary_color = str_replace('#', '', get_theme_mod('yuri_color_scheme_1', '#149ddd'));
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>>
    <div class="card-content">
        <div class="card-img">
            <a href="<?php echo get_the_permalink() ?>" title="<?php echo the_title_attribute(array('echo' => false)) ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'blog-thumb') ?>" class="img-fluid img-responsive">
                <?php else : ?>
                    <img src="https://via.placeholder.com/300x200/<?php echo $primary_color ?>/FFFFFF?text=<?php the_title(); ?>" class="img-fluid img-responsive">
                <?php endif; ?>
            </a>
            <span>
                <h4 class="post-categories"><?php the_category(' '); ?></h4>
            </span>

        </div>
        <div class="card-desc">
            <h2><?php the_title(); ?></h2>
            <?php
            if ('post' === get_post_type()) :
            ?>
                <div class="card-text entry-meta">
                    <?php
                    yuri_lucas_article_posted_on();

                    $num_comments = get_comments_number();
                    if (comments_open() && $num_comments >= 1) :
                        echo ' <a href="' . esc_url(get_comments_link()) . '" class="badge badge-pill bg-secondary float-end" title="' . esc_attr(sprintf(_n('%s Comment', '%s Comments', $num_comments, 'yuri-lucas'), $num_comments)) . '">' . $num_comments . '</a>';
                    endif;
                    ?>
                </div><!-- /.entry-meta -->
            <?php
            endif;
            ?>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="btn-card" title="<?php printf(esc_attr__('Permalink to %s', 'yuri-lucas'), the_title_attribute(array('echo' => false))); ?>" rel="bookmark">Read</a>
        </div>
    </div>
</div>