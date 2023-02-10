<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
if (is_readable($theme_customizer)) {
	require_once $theme_customizer;
}



if (!function_exists('yuri_lucas_setup_theme')) {
	/**
	 * General Theme Settings.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	function yuri_lucas_setup_theme()
	{
		// Make theme available for translation: Translations can be filed in the /languages/ directory.
		load_theme_textdomain('yuri-lucas', __DIR__ . '/languages');

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 *
		 * @since v1.0
		 */
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 800;
		}

		// Theme Support.
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');
		// Add support for full and wide alignment.
		add_theme_support('align-wide');
		// Add support for Editor Styles.
		add_theme_support('editor-styles');
		// Enqueue Editor Styles.
		add_editor_style('style-editor.css');

		// Default attachment display settings.
		update_option('image_default_align', 'none');
		update_option('image_default_link_type', 'none');
		update_option('image_default_size', 'large');

		// Custom CSS styles of WorPress gallery.
		add_filter('use_default_gallery_style', '__return_false');
	}
	add_action('after_setup_theme', 'yuri_lucas_setup_theme');

	// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
	remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
	remove_action('enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory');
}

if (!function_exists('wp_body_open')) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since v2.2
	 *
	 * @return void
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
}

if (!function_exists('yuri_lucas_add_user_fields')) {
	/**
	 * Add new User fields to Userprofile:
	 * get_user_meta( $user->ID, 'facebook_profile', true );
	 *
	 * @since v1.0
	 *
	 * @param array $fields User fields.
	 *
	 * @return array
	 */
	function yuri_lucas_add_user_fields($fields)
	{
		// Add new fields.
		$fields['facebook_profile'] = 'Facebook URL';
		$fields['twitter_profile']  = 'Twitter URL';
		$fields['linkedin_profile'] = 'LinkedIn URL';
		$fields['xing_profile']     = 'Xing URL';
		$fields['github_profile']   = 'GitHub URL';

		return $fields;
	}
	add_filter('user_contactmethods', 'yuri_lucas_add_user_fields');
}

/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 *
 * @return bool
 */
function is_blog()
{
	global $post;
	$posttype = get_post_type($post);

	return ((is_archive() || is_author() || is_category() || is_home() || is_single() || (is_tag() && ('post' === $posttype))) ? true : false);
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 *
 * @param bool $open    Comments open/closed.
 * @param int  $post_id Post ID.
 *
 * @return bool
 */
function yuri_lucas_filter_media_comment_status($open, $post_id = null)
{
	$media_post = get_post($post_id);

	if ('attachment' === $media_post->post_type) {
		return false;
	}

	return $open;
}
add_filter('comments_open', 'yuri_lucas_filter_media_comment_status', 10, 2);

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Post Edit Link.
 *
 * @return string
 */
function yuri_lucas_custom_edit_post_link($link)
{
	return str_replace('class="post-edit-link"', 'class="post-edit-link badge bg-secondary"', $link);
}
add_filter('edit_post_link', 'yuri_lucas_custom_edit_post_link');

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Comment Edit Link.
 */
function yuri_lucas_custom_edit_comment_link($link)
{
	return str_replace('class="comment-edit-link"', 'class="comment-edit-link badge bg-secondary"', $link);
}
add_filter('edit_comment_link', 'yuri_lucas_custom_edit_comment_link');

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 *
 * @param string $html Inner HTML.
 *
 * @return string
 */
function yuri_lucas_oembed_filter($html)
{
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'yuri_lucas_oembed_filter', 10);

if (!function_exists('yuri_lucas_content_nav')) {
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 *
	 * @param string $nav_id Navigation ID.
	 */
	function yuri_lucas_content_nav($nav_id)
	{
		global $wp_query;

		if ($wp_query->max_num_pages > 1) {
?>
			<div id="<?php echo esc_attr($nav_id); ?>" class="d-flex mb-4 justify-content-between">
				<div><?php next_posts_link('<span aria-hidden="true">&larr;</span> ' . esc_html__('Older posts', 'yuri-lucas')); ?>
				</div>
				<div>
					<?php previous_posts_link(esc_html__('Newer posts', 'yuri-lucas') . ' <span aria-hidden="true">&rarr;</span>'); ?>
				</div>
			</div><!-- /.d-flex -->
			<?php
		} else {
			echo '<div class="clearfix"></div>';
		}
	}

	/**
	 * Add Class.
	 *
	 * @since v1.0
	 *
	 * @return string
	 */
	function posts_link_attributes()
	{
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'posts_link_attributes');
}

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 *
 * @return void
 */
function yuri_lucas_widgets_init()
{
	// Area 1.
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area (Sidebar)',
			'id'            => 'primary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 2.
	register_sidebar(
		array(
			'name'          => 'Secondary Widget Area (Header Navigation)',
			'id'            => 'secondary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Third Widget Area (Footer)',
			'id'            => 'third_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'yuri_lucas_widgets_init');

if (!function_exists('yuri_lucas_article_posted_on')) {
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function yuri_lucas_article_posted_on()
	{
		printf(
			wp_kses_post(__('<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author-meta vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'yuri-lucas')),
			esc_url(get_the_permalink()),
			esc_attr(get_the_date() . ' - ' . get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date() . ' - ' . get_the_time()),
			esc_url(get_author_posts_url((int) get_the_author_meta('ID'))),
			sprintf(esc_attr__('View all posts by %s', 'yuri-lucas'), get_the_author()),
			get_the_author()
		);
	}
}

/**
 * Template for Password protected post form.
 *
 * @since v1.0
 *
 * @return string
 */
function yuri_lucas_password_form()
{
	global $post;
	$label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

	$output = '<div class="row">';
	$output .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">';
	$output .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__('This content is password protected. To view it please enter your password below.', 'yuri-lucas') . '</h4>';
	$output .= '<div class="col-md-6">';
	$output .= '<div class="input-group">';
	$output .= '<input type="password" name="post_password" id="' . esc_attr($label) . '" placeholder="' . esc_attr__('Password', 'yuri-lucas') . '" class="form-control" />';
	$output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__('Submit', 'yuri-lucas') . '" /></div>';
	$output .= '</div><!-- /.input-group -->';
	$output .= '</div><!-- /.col -->';
	$output .= '</form>';
	$output .= '</div><!-- /.row -->';

	return $output;
}
add_filter('the_password_form', 'yuri_lucas_password_form');


if (!function_exists('yuri_lucas_comment')) {
	/**
	 * Style Reply link.
	 *
	 * @since v1.0
	 *
	 * @param string $class Link class.
	 *
	 * @return string
	 */
	function yuri_lucas_replace_reply_link_class($class)
	{
		return str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $class);
	}
	add_filter('comment_reply_link', 'yuri_lucas_replace_reply_link_class');

	/**
	 * Template for comments and pingbacks:
	 * add function to comments.php ... wp_list_comments( array( 'callback' => 'yuri_lucas_comment' ) );
	 *
	 * @since v1.0
	 *
	 * @param object $comment Comment object.
	 * @param array  $args    Comment args.
	 * @param int    $depth   Comment depth.
	 */
	function yuri_lucas_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type):
			case 'pingback':
			case 'trackback':
			?>
				<li class="post pingback">
					<p>
						<?php
						esc_html_e('Pingback:', 'yuri-lucas');
						comment_author_link();
						edit_comment_link(esc_html__('Edit', 'yuri-lucas'), '<span class="edit-link">', '</span>');
						?>
					</p>
				<?php
				break;
			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<?php
								$avatar_size = ('0' !== $comment->comment_parent ? 68 : 136);
								echo get_avatar($comment, $avatar_size);

								/* Translators: 1: Comment author, 2: Date and time */
								printf(
									wp_kses_post(__('%1$s, %2$s', 'yuri-lucas')),
									sprintf('<span class="fn">%s</span>', get_comment_author_link()),
									sprintf(
										'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
										esc_url(get_comment_link($comment->comment_ID)),
										get_comment_time('c'),
										/* Translators: 1: Date, 2: Time */
										sprintf(esc_html__('%1$s ago', 'yuri-lucas'), human_time_diff((int) get_comment_time('U'), current_time('timestamp')))
									)
								);

								edit_comment_link(esc_html__('Edit', 'yuri-lucas'), '<span class="edit-link">', '</span>');
								?>
							</div><!-- .comment-author .vcard -->

							<?php if ('0' === $comment->comment_approved) { ?>
								<em class="comment-awaiting-moderation">
									<?php esc_html_e('Your comment is awaiting moderation.', 'yuri-lucas'); ?>
								</em>
								<br />
							<?php } ?>
						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php
							comment_reply_link(
								array_merge(
									$args,
									array(
										'reply_text' => esc_html__('Reply', 'yuri-lucas') . ' <span>&darr;</span>',
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
									)
								)
							);
							?>
						</div><!-- /.reply -->
					</article><!-- /#comment-## -->
		<?php
				break;
		endswitch;
	}

	/**
	 * Custom Comment form.
	 *
	 * @since v1.0
	 * @since v1.1: Added 'submit_button' and 'submit_field'
	 * @since v2.0.2: Added '$consent' and 'cookies'
	 *
	 * @param array $args    Form args.
	 * @param int   $post_id Post ID.
	 *
	 * @return array
	 */
	function yuri_lucas_custom_commentform($args = array(), $post_id = null)
	{
		if (null === $post_id) {
			$post_id = get_the_ID();
		}

		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$args = wp_parse_args($args);

		$req      = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true' required" : '');
		$consent  = (empty($commenter['comment_author_email']) ? '' : ' checked="checked"');
		$fields   = array(
			'author'  => '<div class="form-floating mb-3">
							<input type="text" id="author" name="author" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_html__('Name', 'yuri-lucas') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="author">' . esc_html__('Name', 'yuri-lucas') . ($req ? '*' : '') . '</label>
						</div>',
			'email'   => '<div class="form-floating mb-3">
							<input type="email" id="email" name="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_html__('Email', 'yuri-lucas') . ($req ? '*' : '') . '"' . $aria_req . ' />
							<label for="email">' . esc_html__('Email', 'yuri-lucas') . ($req ? '*' : '') . '</label>
						</div>',
			'url'     => '',
			'cookies' => '<p class="form-check mb-3 comment-form-cookies-consent">
							<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="form-check-input" type="checkbox" value="yes"' . $consent . ' />
							<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'yuri-lucas') . '</label>
						</p>',
		);

		$defaults = array(
			'fields'               => apply_filters('comment_form_default_fields', $fields),
			'comment_field'        => '<div class="form-floating mb-3">
											<textarea id="comment" name="comment" class="form-control" aria-required="true" required placeholder="' . esc_attr__('Comment', 'yuri-lucas') . ($req ? '*' : '') . '"></textarea>
											<label for="comment">' . esc_html__('Comment', 'yuri-lucas') . '</label>
										</div>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in'          => '<p class="must-log-in">' . sprintf(wp_kses_post(__('You must be <a href="%s">logged in</a> to post a comment.', 'yuri-lucas')), wp_login_url(esc_url(get_the_permalink(get_the_ID())))) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf(wp_kses_post(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'yuri-lucas')), get_edit_user_link(), $user->display_name, wp_logout_url(apply_filters('the_permalink', esc_url(get_the_permalink(get_the_ID()))))) . '</p>',
			'comment_notes_before' => '<p class="small comment-notes">' . esc_html__('Your Email address will not be published.', 'yuri-lucas') . '</p>',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn btn-primary',
			'name_submit'          => 'submit',
			'title_reply'          => '',
			'title_reply_to'       => esc_html__('Leave a Reply to %s', 'yuri-lucas'),
			'cancel_reply_link'    => esc_html__('Cancel reply', 'yuri-lucas'),
			'label_submit'         => esc_html__('Post Comment', 'yuri-lucas'),
			'submit_button'        => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
			'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
			'format'               => 'html5',
		);

		return $defaults;
	}
	add_filter('comment_form_defaults', 'yuri_lucas_custom_commentform');
}

if (function_exists('register_nav_menus')) {
	/**
	 * Nav menus.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if (is_readable($custom_walker)) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp-bootstrap-navwalker-footer.php';
if (is_readable($custom_walker_footer)) {
	require_once $custom_walker_footer;
}

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 *
 * @return void
 */
function yuri_lucas_scripts_loader()
{
	$theme_version = wp_get_theme()->get('Version');

	// 1. Styles.
	wp_enqueue_style('aos', get_theme_file_uri('assets/vendor/aos/aos.css'), array(), $theme_version, 'all');
	wp_enqueue_style('bootstrap', get_theme_file_uri('assets/vendor/bootstrap/css/bootstrap.min.css'), array(), $theme_version, 'all');
	wp_enqueue_style('bootstrap-icons', get_theme_file_uri('assets/vendor/bootstrap-icons/bootstrap-icons.css'), array(), $theme_version, 'all');
	wp_enqueue_style('boxicons', get_theme_file_uri('assets/vendor/boxicons/css/boxicons.min.css'), array(), $theme_version, 'all');
	wp_enqueue_style('glightbox', get_theme_file_uri('assets/vendor/glightbox/css/glightbox.min.css'), array(), $theme_version, 'all');
	wp_enqueue_style('swiper-bundle', get_theme_file_uri('assets/vendor/swiper/swiper-bundle.min.css'), array(), $theme_version, 'all');
	wp_enqueue_style('style', get_theme_file_uri('style.css'), array(), $theme_version, 'all');

	if (is_rtl()) {
		wp_enqueue_style('rtl', get_theme_file_uri('assets/dist/rtl.css'), array(), $theme_version, 'all');
	}

	// 2. Scripts.
	wp_enqueue_script('purecounter_vanilla', get_theme_file_uri('assets/vendor/purecounter/purecounter_vanilla.js'), array(), $theme_version, true);
	wp_enqueue_script('aos', get_theme_file_uri('assets/vendor/aos/aos.js'), array(), $theme_version, true);
	wp_enqueue_script('bootstrap', get_theme_file_uri('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'), array(), $theme_version, true);
	wp_enqueue_script('glightbox', get_theme_file_uri('assets/vendor/glightbox/js/glightbox.min.js'), array(), $theme_version, true);
	wp_enqueue_script('isotope', get_theme_file_uri('assets/vendor/isotope-layout/isotope.pkgd.min.js'), array(), $theme_version, true);
	wp_enqueue_script('swiper', get_theme_file_uri('assets/vendor/swiper/swiper-bundle.min.js'), array(), $theme_version, true);
	wp_enqueue_script('typedjs', get_theme_file_uri('assets/vendor/typed.js/typed.min.js'), array(), $theme_version, true);
	wp_enqueue_script('waypoints', get_theme_file_uri('assets/vendor/waypoints/noframework.waypoints.js'), array(), $theme_version, true);
	wp_enqueue_script('validatejs', get_theme_file_uri('assets/vendor/php-email-form/validate.js'), array(), $theme_version, true);
	wp_enqueue_script('mainjs', get_theme_file_uri('assets/js/main.js'), array(), $theme_version, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'yuri_lucas_scripts_loader');

/**
 * Portfolio Custom post Type.
 */
function yuri_lucas_custom_post_type()
{
	register_post_type(
		'portfolios',
		array(
			'labels'      => array(
				'name'          => __('Portfolios', 'yuri-lucas'),
				'singular_name' => __('Portfolio', 'yuri-lucas'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'portfolios'), // my custom slug
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'),
			'taxonomies' => array('category', 'post_tag'),
		)
	);

	register_post_type(
		'services',
		array(
			'labels'      => array(
				'name'          => __('Services', 'yuri-lucas'),
				'singular_name' => __('Service', 'yuri-lucas'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'services'), // my custom slug
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'),
			'taxonomies' => array('category', 'post_tag'),
		)
	);

	register_post_type(
		'testimonials',
		array(
			'labels'      => array(
				'name'          => __('Testimonials', 'yuri-lucas'),
				'singular_name' => __('Testimonial', 'yuri-lucas'),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'testimonials'), // my custom slug
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'),
		)
	);
}
add_action('init', 'yuri_lucas_custom_post_type');

/**
 * Portfolio Custom Fields.
 */
function yuri_lucas_add_portfolio_custom_field()
{
	$screens = ['portfolios'];
	foreach ($screens as $screen) {
		add_meta_box(
			'yuri_lucas_box_id',                 // Unique ID
			'Portfolio Details',      // Box title
			'yuri_lucas_portfolio_custom_field_html',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action('add_meta_boxes', 'yuri_lucas_add_portfolio_custom_field');

/**
 * Portfolio Custom Fields HTML.
 */
function yuri_lucas_portfolio_custom_field_html($post)
{
	wp_nonce_field('yuri_lucas_save_postdata', 'portfolio_meta_box_nonce');
	$client_name = get_post_meta($post->ID, '_client_meta_field', true);
	$project_date = get_post_meta($post->ID, '_project_date_meta_field', true);
	$project_url = get_post_meta($post->ID, '_project_url_meta_field', true);
		?>
		<label for="yuri_lucas_client_field">Client Name</label>
		<input type="text" name="yuri_lucas_client_field" id="yuri_lucas_client_field" class="postbox" value="<?php echo esc_attr($client_name) ?>">

		<label for="yuri_lucas_project_date_field">Project Date</label>
		<input type="date" name="yuri_lucas_project_date_field" id="yuri_lucas_project_date_field" class="postbox" value="<?php echo esc_attr($project_date) ?>">

		<label for="yuri_lucas_project_url_field">Project URL</label>
		<input type="text" name="yuri_lucas_project_url_field" id="yuri_lucas_project_url_field" class="postbox" value="<?php echo esc_attr($project_url) ?>">
	<?php
}

/**
 * Portfolio Custom Fields Save.
 */
function yuri_lucas_save_portfolio_postdata($post_id)
{
	if (!isset($_POST['portfolio_meta_box_nonce'])) {
		return;
	}

	if (!wp_verify_nonce($_POST['portfolio_meta_box_nonce'], 'yuri_lucas_save_postdata')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (array_key_exists('yuri_lucas_client_field', $_POST)) {
		$client_name = sanitize_text_field($_POST['yuri_lucas_client_field']);
		update_post_meta(
			$post_id,
			'_client_meta_field',
			$client_name
		);
	}

	if (array_key_exists('yuri_lucas_project_date_field', $_POST)) {
		$project_date = $_POST['yuri_lucas_project_date_field'];
		update_post_meta(
			$post_id,
			'_project_date_meta_field',
			$project_date
		);
	}

	if (array_key_exists('yuri_lucas_project_url_field', $_POST)) {
		$project_url = sanitize_text_field($_POST['yuri_lucas_project_url_field']);
		update_post_meta(
			$post_id,
			'_project_url_meta_field',
			$project_url
		);
	}
}
add_action('save_post', 'yuri_lucas_save_portfolio_postdata');


/**
 * Testimonials Custom Fields.
 */
function yuri_lucas_add_testimonial_custom_field()
{
	$screens = ['testimonials'];
	foreach ($screens as $screen) {
		add_meta_box(
			'yuri_lucas_box_id',                 // Unique ID
			'Testimonial Details',      // Box title
			'yuri_lucas_testimonial_custom_field_html',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action('add_meta_boxes', 'yuri_lucas_add_testimonial_custom_field');

/**
 * Testimonials Custom Fields HTML.
 */
function yuri_lucas_testimonial_custom_field_html($post)
{
	wp_nonce_field('yuri_lucas_save_postdata', 'testimonial_meta_box_nonce');
	$testimonial_profession = get_post_meta($post->ID, '_testimonial_profession_meta_field', true);
	?>
		<label for="yuri_lucas_testimonial_profession_field">Profession / Job Title</label>
		<input type="text" name="yuri_lucas_testimonial_profession_field" id="yuri_lucas_testimonial_profession_field" class="postbox" value="<?php echo esc_attr($testimonial_profession) ?>">

	<?php
}

/**
 * Testimonials Custom Fields Save.
 */
function yuri_lucas_save_testimonial_postdata($post_id)
{
	if (!isset($_POST['testimonial_meta_box_nonce'])) {
		return;
	}

	if (!wp_verify_nonce($_POST['testimonial_meta_box_nonce'], 'yuri_lucas_save_postdata')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (array_key_exists('yuri_lucas_testimonial_profession_field', $_POST)) {
		$testimonial_profession = sanitize_text_field($_POST['yuri_lucas_testimonial_profession_field']);
		update_post_meta(
			$post_id,
			'_testimonial_profession_meta_field',
			$testimonial_profession
		);
	}
}
add_action('save_post', 'yuri_lucas_save_testimonial_postdata');


/**
 * Services Custom Fields.
 */
function yuri_lucas_add_service_custom_field()
{
	$screens = ['services'];
	foreach ($screens as $screen) {
		add_meta_box(
			'yuri_lucas_box_id',                 // Unique ID
			'Service Details',      // Box title
			'yuri_lucas_service_custom_field_html',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action('add_meta_boxes', 'yuri_lucas_add_service_custom_field');

/**
 * Services Custom Fields HTML.
 */
function yuri_lucas_service_custom_field_html($post)
{
	wp_nonce_field('yuri_lucas_save_postdata', 'service_meta_box_nonce');
	$service = get_post_meta($post->ID, '_service_profession_meta_field', true);
	?>
		<label for="yuri_lucas_service_field">Service Icon (https://fontawesomeicons.com/bootstrap/icons/)</label>
		<input type="text" placeholder="bi-briefcase" name="yuri_lucas_service_field" id="yuri_lucas_service_field" class="postbox" value="<?php echo esc_attr($service) ?>">

	<?php
}

/**
 * Services Custom Fields Save.
 */
function yuri_lucas_save_service_postdata($post_id)
{
	if (!isset($_POST['service_meta_box_nonce'])) {
		return;
	}

	if (!wp_verify_nonce($_POST['service_meta_box_nonce'], 'yuri_lucas_save_postdata')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (array_key_exists('yuri_lucas_service_field', $_POST)) {
		$service = sanitize_text_field($_POST['yuri_lucas_service_field']);
		update_post_meta(
			$post_id,
			'_service_meta_field',
			$service
		);
	}
}
add_action('save_post', 'yuri_lucas_save_service_postdata');

// Portfolio Gallery Meta Box
function portfolio_gallery_add_metabox()
{
	add_meta_box(
		'post_custom_gallery',
		'Gallery',
		'portfolio_gallery_metabox_callback',
		'portfolios', // Change post type name
		'normal',
		'core'
	);
}
add_action('admin_init', 'portfolio_gallery_add_metabox');

// Portfolio Gallery Callback function
function portfolio_gallery_metabox_callback()
{
	wp_nonce_field(basename(__FILE__), 'sample_nonce');
	global $post;
	$gallery_data = get_post_meta($post->ID, 'gallery_data', true);
	?>
		<div id="gallery_wrapper">
			<div id="img_box_container">
				<?php
				if (isset($gallery_data['image_url'])) {
					for ($i = 0; $i < count($gallery_data['image_url']); $i++) {
				?>
						<div class="gallery_single_row dolu">
							<div class="gallery_area image_container ">
								<img class="gallery_img_img" src="<?php esc_html_e($gallery_data['image_url'][$i]); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)" />
								<input type="hidden" class="meta_image_url" name="gallery[image_url][]" value="<?php esc_html_e($gallery_data['image_url'][$i]); ?>" />
							</div>
							<div class="gallery_area">
								<span class="button remove" onclick="remove_img(this)" title="Remove" /><i class="fas fa-trash-alt"></i></span>
							</div>
							<div class="clear" />
						</div>
			</div>
	<?php
					}
				}
	?>
		</div>
		<div style="display:none" id="master_box">
			<div class="gallery_single_row">
				<div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
					<input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]" />
				</div>
				<div class="gallery_area">
					<span class="button remove" onclick="remove_img(this)" title="Remove" /><i class="fas fa-trash-alt"></i></span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="add_gallery_single_row">
			<input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();" title="Add image" />
		</div>
		</div>
	<?php
}

function portfolio_gallery_styles_scripts()
{
	global $post;
	if ('portfolios' != $post->post_type)
		return;
	?>
		<style type="text/css">
			.gallery_area {
				float: right;
			}

			.image_container {
				float: left !important;
				width: 100px;
				background: url('https://i.hizliresim.com/dOJ6qL.png');
				height: 100px;
				background-repeat: no-repeat;
				background-size: cover;
				border-radius: 3px;
				cursor: pointer;
			}

			.image_container img {
				height: 100px;
				width: 100px;
				border-radius: 3px;
			}

			.clear {
				clear: both;
			}

			#gallery_wrapper {
				width: 100%;
				height: auto;
				position: relative;
				display: inline-block;
			}

			#gallery_wrapper input[type=text] {
				width: 300px;
			}

			#gallery_wrapper .gallery_single_row {
				float: left;
				display: inline-block;
				width: 100px;
				position: relative;
				margin-right: 8px;
				margin-bottom: 20px;
			}

			.dolu {
				display: inline-block !important;
			}

			#gallery_wrapper label {
				padding: 0 6px;
			}

			.button.remove {
				background: none;
				color: #f1f1f1;
				position: absolute;
				border: none;
				top: 4px;
				right: 7px;
				font-size: 1.2em;
				padding: 0px;
				box-shadow: none;
			}

			.button.remove:hover {
				background: none;
				color: #fff;
			}

			.button.add {
				background: #c3c2c2;
				color: #ffffff;
				border: none;
				box-shadow: none;
				width: 100px;
				height: 100px;
				line-height: 100px;
				font-size: 4em;
			}

			.button.add:hover,
			.button.add:focus {
				background: #e2e2e2;
				box-shadow: none;
				color: #0f88c1;
				border: none;
			}
		</style>
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous">
		</script>
		<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript">
			function remove_img(value) {
				var parent = jQuery(value).parent().parent();
				parent.remove();
			}
			var media_uploader = null;

			function open_media_uploader_image(obj) {
				media_uploader = wp.media({
					frame: "post",
					state: "insert",
					multiple: false
				});
				media_uploader.on("insert", function() {
					var json = media_uploader.state().get("selection").first().toJSON();
					var image_url = json.url;
					var html = '<img class="gallery_img_img" src="' + image_url +
						'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
					console.log(image_url);
					jQuery(obj).append(html);
					jQuery(obj).find('.meta_image_url').val(image_url);
				});
				media_uploader.open();
			}

			function open_media_uploader_image_this(obj) {
				media_uploader = wp.media({
					frame: "post",
					state: "insert",
					multiple: false
				});
				media_uploader.on("insert", function() {
					var json = media_uploader.state().get("selection").first().toJSON();
					var image_url = json.url;
					console.log(image_url);
					jQuery(obj).attr('src', image_url);
					jQuery(obj).siblings('.meta_image_url').val(image_url);
				});
				media_uploader.open();
			}

			function open_media_uploader_image_plus() {
				media_uploader = wp.media({
					frame: "post",
					state: "insert",
					multiple: true
				});
				media_uploader.on("insert", function() {

					var length = media_uploader.state().get("selection").length;
					var images = media_uploader.state().get("selection").models

					for (var i = 0; i < length; i++) {
						var image_url = images[i].changed.url;
						var box = jQuery('#master_box').html();
						jQuery(box).appendTo('#img_box_container');
						var element = jQuery('#img_box_container .gallery_single_row:last-child').find(
							'.image_container');
						var html = '<img class="gallery_img_img" src="' + image_url +
							'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
						element.append(html);
						element.find('.meta_image_url').val(image_url);
						console.log(image_url);
					}
				});
				media_uploader.open();
			}
			jQuery(function() {
				jQuery("#img_box_container").sortable(); // Activate jQuery UI sortable feature
			});
		</script>
	<?php
}
add_action('admin_head-post.php', 'portfolio_gallery_styles_scripts');
add_action('admin_head-post-new.php', 'portfolio_gallery_styles_scripts');

function portfolio_gallery_save($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['sample_nonce']) && wp_verify_nonce($_POST['sample_nonce'], basename(__FILE__))) ? 'true' : 'false';

	if ($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Correct post type
	if ('portfolios' != $_POST['post_type']) // here you can set the post type name
		return;

	if ($_POST['gallery']) {

		// Build array for saving post meta
		$gallery_data = array();
		for ($i = 0; $i < count($_POST['gallery']['image_url']); $i++) {
			if ('' != $_POST['gallery']['image_url'][$i]) {
				$gallery_data['image_url'][]  = $_POST['gallery']['image_url'][$i];
			}
		}

		if ($gallery_data)
			update_post_meta($post_id, 'gallery_data', $gallery_data);
		else
			delete_post_meta($post_id, 'gallery_data');
	}
	// Nothing received, all fields are empty, delete option
	else {
		delete_post_meta($post_id, 'gallery_data');
	}
}
add_action('save_post', 'portfolio_gallery_save');
