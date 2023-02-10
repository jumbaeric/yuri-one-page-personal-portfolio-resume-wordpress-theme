<?php

/**
 * The Template for displaying all single posts.
 */

get_header();
?>
<section class="inner-page">
	<div class="container">
		<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post();

				get_template_part('content', 'portfolio');

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
			endwhile;
		endif;
		?>
	</div>
</section>
<?php
wp_reset_postdata();

get_footer();
