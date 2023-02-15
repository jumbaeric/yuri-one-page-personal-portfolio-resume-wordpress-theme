<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
$tgm = __DIR__ . '/lib/class-tgm-plugin-activation.php';
if (is_readable($theme_customizer)) {
	require_once $theme_customizer;
}
if (is_readable($tgm)) {
	require_once $tgm;
}

add_action('tgmpa_register', 'yuri_lucas_register_required_plugins');

if (!function_exists('yuri_lucas_register_required_plugins')) {
	function yuri_lucas_register_required_plugins()
	{
		/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
		$plugins = array(
			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'  => 'Visual Composer Website Builder', // The plugin name
				'slug'  => 'visualcomposer', // The plugin slug (typically the folder name)
				'required'  => false, // If false, the plugin is only 'recommended' instead of required
			),
			array(
				'name'  => 'Yuri Portfolio Custom Post Type', // The plugin name
				'slug'  => 'yuri-portfolio-cpt', // The plugin slug (typically the folder name)
				'source'  => get_stylesheet_directory() . '/lib/plugins/yuri-portfolio-cpt.zip', // The plugin source
				'required'  => true, // If false, the plugin is only 'recommended' instead of required
				'version' => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'  => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				// 'external_url'  => '', // If set, overrides default API URL and points to an external URL
			)
		);

		$theme_text_domain = 'yuri-lucas';

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'  => $theme_text_domain, // Text domain - likely want to be the same as your theme.
			'default_path'  => '', // Default absolute path to pre-packaged plugins
			// 'parent_menu_slug'  => 'themes.php', // Default parent menu slug
			// 'parent_url_slug' => 'themes.php', // Default parent URL slug
			'menu'  => 'install-required-plugins', // Menu slug
			'has_notices' => true, // Show admin notices or not
			'is_automatic'  => false, // Automatically activate plugins after installation or not
			'message' => '', // Message to output right before the plugins table
			'strings' => array(
				'page_title'  => __('Install Required Plugins', $theme_text_domain),
				'menu_title'  => __('Install Plugins', $theme_text_domain),
				'installing'  => __('Installing Plugin: %s', $theme_text_domain), // %1$s = plugin name
				'oops'  => __('Something went wrong with the plugin API.', $theme_text_domain),
				'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
				'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
				'notice_can_activate_required'  => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
				'notice_cannot_activate'  => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
				'notice_ask_to_update'  => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
				'notice_cannot_update'  => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
				'install_link'  => _n_noop('Begin installing plugin', 'Begin installing plugins'),
				'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
				'return'  => __('Return to Required Plugins Installer', $theme_text_domain),
				'plugin_activated'  => __('Plugin activated successfully.', $theme_text_domain),
				'complete'  => __('All plugins installed and activated successfully. %s', $theme_text_domain), // %1$s = dashboard link
				'nag_type'  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa($plugins, $config);
	}
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
// add_action('vc_before_init', 'your_prefix_vcSetAsTheme');
// function your_prefix_vcSetAsTheme()
// {
// 	vc_set_as_theme();
// }


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

		add_image_size( 'blog-thumb', 300, 200, true ); // Hard Crop Mode
	}
	add_action('after_setup_theme', 'yuri_lucas_setup_theme');

	function yuri_lucas_custom_image_sizes( $size_names ) {
		$new_sizes = array(
			'blog-thumb' => 'Blog Thumbmail'
		);
		return array_merge( $size_names, $new_sizes );
	}
	add_filter( 'image_size_names_choose', 'yuri_lucas_custom_image_sizes' );

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

// if (!function_exists('yuri_lucas_add_user_fields')) {
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
// 	function yuri_lucas_add_user_fields($fields)
// 	{
// 		$fields['facebook_profile'] = 'Facebook URL';
// 		$fields['twitter_profile']  = 'Twitter URL';
// 		$fields['linkedin_profile'] = 'LinkedIn URL';
// 		$fields['xing_profile']     = 'Xing URL';
// 		$fields['github_profile']   = 'GitHub URL';

// 		return $fields;
// 	}
// 	add_filter('user_contactmethods', 'yuri_lucas_add_user_fields');
// }

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
		return 'class="btn btn-secondary"';
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
	// function yuri_lucas_replace_reply_link_class($class)
	// {
	// 	return str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $class);
	// }
	// add_filter('comment_reply_link', 'yuri_lucas_replace_reply_link_class');

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
						esc_attr_e('Pingback:', 'yuri-lucas');
						comment_author_link();
						edit_comment_link(esc_html__('Edit', 'yuri-lucas'), '<span class="edit-link">', '</span>');
						?>
					</p>
				<?php
				break;
			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment card p-3">
						<footer class="comment-meta d-flex justify-content-between align-items-center">
							<!-- <div class="comment-author vcard"> -->
							<div class="user d-flex flex-row align-items-center">
								<?php
								$avatar_size = ('0' !== $comment->comment_parent ? 20 : 30);
								echo get_avatar($comment, $avatar_size); ?>
								<span>
									<?php
									/* Translators: 1: Comment author, 2: Date and time */
									printf(
										wp_kses_post(__('%1$s', 'yuri-lucas')),
										sprintf('<small class="fn font-weight-bold text-primary">%s</small>', get_comment_author_link()),
									); ?>
									<small class="comment-content font-weight-bold"><?php echo get_comment_text(); ?></small>
								</span>
							</div>
							<small>
								<?php
								printf(
									wp_kses_post(__('%1$s', 'yuri-lucas')),
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
							</small>
							<!-- </div>.comment-author .vcard -->

							<?php if ('0' === $comment->comment_approved) { ?>
								<em class="comment-awaiting-moderation">
									<?php esc_attr_e('Your comment is awaiting moderation.', 'yuri-lucas'); ?>
								</em>
								<br />
							<?php } ?>
						</footer>

						<div class="reply action d-flex justify-content-between mt-2 align-items-center">
							<div class="reply px-4">
								<small>
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
								</small>
							</div>
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

// function wpdocs_comment_reply_link_class($class)
// {
// 	$class = str_replace("class='comment-reply-link btn btn-outline-secondary", "class='comment-reply-link", $class);
// 	return $class;
// }

// add_filter('comment_reply_link', 'wpdocs_comment_reply_link_class');


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

	wp_register_script('ajax_object', '');
	wp_add_inline_script('ajax_object', "var ajax_url = '" . admin_url('admin-ajax.php') . "', _ajax_nonce = '" . wp_create_nonce('_ajax_nonce') . "';");
	wp_enqueue_script('ajax_object');

	// $translation_array = array(
	// 	'ajax_url' => admin_url('admin-ajax.php'),
	// 	'_ajax_nonce' => wp_create_nonce('_ajax_nonce'),
	// );
	// wp_localize_script('script', 'ajax_object', $translation_array);
}
add_action('wp_enqueue_scripts', 'yuri_lucas_scripts_loader');

// send contact email
function send_contact_email()
{
	if (check_ajax_referer('_ajax_nonce')) {
		$name = sanitize_text_field($_POST['name']);
		$email = sanitize_email($_POST['email']);
		$subject = sanitize_text_field($_POST['subject']);
		$message = "<p>From Name: " . $name . "</p>";
		$message .= "<p>From Email: " . $email . "</p>";
		$message .= sanitize_textarea_field($_POST['message']);
		$admin = get_option('admin_email');

		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = 'From: Yuri <' . $admin . '>';
		$headers[] = 'Replay-to:' . $email;
		// wp_mail($email,$name,$message);  main sent to admin and the user
		if (wp_mail($admin, $subject, $message, $headers)) {
			// return "OK";
			wp_send_json_success('Mail sent successfully');
		} else {
			// return "mail not sent";
			wp_send_json_error('mail not sent !');
		}
	} else {
		wp_send_json_error('wrong ajax nonce');
	};
	die();
}
// THE AJAX ADD ACTIONS
add_action('wp_ajax_send_contact_email', 'send_contact_email');    //execute when wp logged in
add_action('wp_ajax_nopriv_send_contact_email', 'send_contact_email'); //execute when logged out

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
function yuri_lucas_adjust_brightness($hexCode, $adjustPercent)
{
	$hexCode = ltrim($hexCode, '#');

	if (strlen($hexCode) == 3) {
		$hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
	}

	$hexCode = array_map('hexdec', str_split($hexCode, 2));

	foreach ($hexCode as &$color) {
		$adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
		$adjustAmount = ceil($adjustableLimit * $adjustPercent);

		$color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
	}

	return '#' . implode($hexCode);
}
