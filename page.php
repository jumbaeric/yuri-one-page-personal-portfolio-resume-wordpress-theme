<?php

/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the left side.
 *
 */

get_header();

the_post();
?>
<section class="inner-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 order-md-2 col-sm-12">
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
				}
				?>
			</div><!-- /.col -->
			<?php
			// get_sidebar();
			?>
		</div><!-- /.row -->
	</div>
</section>
<?php
get_footer();
