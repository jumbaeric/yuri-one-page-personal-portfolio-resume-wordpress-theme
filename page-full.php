<?php

/**
 * Template Name: Page (Full width)
 * Description: Page template full width.
 *
 */

get_header();

the_post();
?>
<section class="inner-page">
	<div class="container">
		<div id="post-<?php the_ID(); ?>" <?php post_class('content'); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'yuri-lucas') . '">',
					'after'    => '</nav>',
					'pagelink' => esc_html__('Page %', 'yuri-lucas'),
				)
			);
			edit_post_link(
				esc_attr__('Edit', 'yuri-lucas'),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</div><!-- /#post-<?php the_ID(); ?> -->
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		} ?>
	</div>
</section>
<?php
get_footer();
