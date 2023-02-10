<?php

defined('ABSPATH') || exit;

if (!class_exists('WP_Customize_Control'))
	return NULL;

/**
 * Class to create a custom tags control
 */
class Text_Editor_Custom_Control extends WP_Customize_Control
{
	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content()
	{
?>
		<style>
			.js .tmce-active .wp-editor-area {
				color: black !important;
			}
		</style>
		<label class="customize-control-title">
			<span class="customize-text_editor"><?php echo esc_html($this->label); ?></span>
			<?php
			$settings = array(
				'media_buttons' => false,
				'textarea_rows' => 5,
				'textarea_name' => $this->id
			);
			$this->filter_editor_setting_link();
			wp_editor($this->value(), $this->id, $settings);
			?>
		</label>
	<?php
		do_action('admin_footer');
		do_action('admin_print_footer_scripts');
	}
	private function filter_editor_setting_link()
	{
		add_filter('the_editor', function ($output) {
			return preg_replace('/<textarea/', '<textarea ' . $this->get_link(), $output, 1);
		});
	}
}

/**
 * Class to create a custom post type control
 */
class Post_Type_Dropdown_Custom_Control extends WP_Customize_Control
{
	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content()
	{
		$args = array(
			'post_type' => 'portfolios',
			'numberposts' => '-1',
			'post_status' => 'publish'
		);
		$post_types_arr = get_posts($args);
	?>
		<label class="customize-control-title">
			<span class="customize-post-type-dropdown"><?php echo esc_html($this->label); ?></span>
			<select multiple name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
				<?php foreach ($post_types_arr as $post) : ?>
					<option value="<?php echo $post->ID; ?>" <?php selected($this->value(), $post->ID); ?>><?php echo $post->post_title; ?></option>
				<?php endforeach; ?>
			</select>
		</label>
<?php
	}
}

/**
 * Implement Theme Customizer additions and adjustments.
 * https://codex.wordpress.org/Theme_Customization_API
 *
 * How do I "output" custom theme modification settings? https://developer.wordpress.org/reference/functions/get_theme_mod
 * echo get_theme_mod( 'copyright_info' );
 * or: echo get_theme_mod( 'copyright_info', 'Default (c) Copyright Info if nothing provided' );
 *
 * "sanitize_callback": https://codex.wordpress.org/Data_Validation
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function yuri_lucas_customize($wp_customize)
{
	/**
	 * Initialize sections
	 */
	$wp_customize->add_section(
		'theme_header_section',
		array(
			'title'    => __('Header', 'yuri-lucas'),
			'priority' => 1,
		)
	);

	/**
	 * Section: Page Layout
	 */
	// Header Logo.
	$wp_customize->add_setting(
		'header_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_logo',
			array(
				'label'       => __('Upload Header Logo', 'yuri-lucas'),
				'description' => __('Height: &gt;80px', 'yuri-lucas'),
				'section'     => 'theme_header_section',
				'settings'    => 'header_logo',
				'priority'    => 1,
			)
		)
	);

	// Predefined Navbar scheme.
	$wp_customize->add_setting(
		'navbar_scheme',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_scheme',
		array(
			'type'     => 'radio',
			'label'    => __('Navbar Scheme', 'yuri-lucas'),
			'section'  => 'theme_header_section',
			'choices'  => array(
				'navbar-light bg-light'  => __('Default', 'yuri-lucas'),
				'navbar-dark bg-dark'    => __('Dark', 'yuri-lucas'),
				'navbar-dark bg-primary' => __('Primary', 'yuri-lucas'),
			),
			'settings' => 'navbar_scheme',
			'priority' => 1,
		)
	);

	// Fixed Header?
	$wp_customize->add_setting(
		'navbar_position',
		array(
			'default'           => 'static',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_position',
		array(
			'type'     => 'radio',
			'label'    => __('Navbar', 'yuri-lucas'),
			'section'  => 'theme_header_section',
			'choices'  => array(
				'static'       => __('Static', 'yuri-lucas'),
				'fixed_top'    => __('Fixed to top', 'yuri-lucas'),
				'fixed_bottom' => __('Fixed to bottom', 'yuri-lucas'),
			),
			'settings' => 'navbar_position',
			'priority' => 2,
		)
	);

	// Search?
	$wp_customize->add_setting(
		'search_enabled',
		array(
			'default'           => '1',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'search_enabled',
		array(
			'type'     => 'checkbox',
			'label'    => __('Show Searchfield?', 'yuri-lucas'),
			'section'  => 'theme_header_section',
			'settings' => 'search_enabled',
			'priority' => 3,
		)
	);

	// Homepage Panel
	$wp_customize->add_panel('homepage', array(
		'title' => __('Homepage Content'),
		'description' => "Home Onepage Content", // Include html tags such as <p>.
		'priority' => 2, // Mixed with top-level-section hierarchy.
	));

	// Home Page Hero Section 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_1',
		array(
			'title'         => __('Home Hero Image Section', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// Hero Image
	$wp_customize->add_setting("upload_hero_image", array(
		"default" => "",
		"transport" => "postMessage",
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'upload_hero_image',
		array( // setting id
			'label'    => __('Upload Hero Image', 'yuri-lucas'),
			'section'  => 'yuri_lucas_home_page_section_1',
			'description' => __('Height: &gt;674px', 'yuri-lucas'),
			'settings'    => 'upload_hero_image',
			'priority' => 1,
		)
	));

	// Add Resume name
	$wp_customize->add_setting("resume_names", array(
		"default" => "Yuri Lucas",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('resume_names', array( // setting id
		'label'    => __('Your Names', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_1', // section id
		'settings' => 'resume_names',
		'type'     => 'text',
		'priority' => 1,
	));

	// Skills
	$wp_customize->add_setting("resume_skills", array(
		"default" => "Designer, Developer, Freelancer, Photographer",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('resume_skills', array( // setting id
		'label'    => __('Your Skills', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_1', // section id
		'settings' => 'resume_skills',
		'type'     => 'text',
		'priority' => 1,
	));


	// Home Page Section 2 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_2',
		array(
			'title'         => __('Home Section 2', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section title
	$wp_customize->add_setting("section_2_title", array(
		"default" => "About",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_title', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_title',
		'type'     => 'text',
		'priority' => 1,
	));

	// section description
	$wp_customize->add_setting("section_2_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// Section Image
	$wp_customize->add_setting("section_2_image", array(
		"default" => "",
		"transport" => "postMessage",
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'section_2_image',
		array( // setting id
			'label'    => __('Section Image', 'yuri-lucas'),
			'section'  => 'yuri_lucas_home_page_section_2',
			'description' => __('Height: &gt;600px Width: &gt;600px', 'yuri-lucas'),
			'settings'    => 'section_2_image',
			'priority' => 1,
		)
	));

	// section sub title
	$wp_customize->add_setting("section_2_sub_title", array(
		"default" => "UI/UX Designer & Web Developer.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_sub_title', array( // setting id
		'label'    => __('Sub Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_sub_title',
		'type'     => 'text',
		'priority' => 1,
	));

	// section sub title top description
	$wp_customize->add_setting("section_2_sub_title_top_description", array(
		"default" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore	magna aliqua.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_sub_title_top_description', array( // setting id
		'label'    => __('Sub Title Top Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section sub title bottom description
	$wp_customize->add_setting("section_2_sub_title_bottom_description", array(
		"default" => "Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis. Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque. Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_sub_title_bottom_description', array( // setting id
		'label'    => __('Sub Title Bottom Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section_2_info_1_key
	$wp_customize->add_setting("section_2_info_1_key", array(
		"default" => "Birthday",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_1_key', array( // setting id
		'label'    => __('Info 1 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_1_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_1_key
	$wp_customize->add_setting("section_2_info_1_value", array(
		"default" => "1 May 1995",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_1_value', array( // setting id
		'label'    => __('Info 1 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_1_value',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_2_key
	$wp_customize->add_setting("section_2_info_2_key", array(
		"default" => "Website",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_2_key', array( // setting id
		'label'    => __('Info 2 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_2_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_2_value
	$wp_customize->add_setting("section_2_info_2_value", array(
		"default" => "www.example.com",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_2_value', array( // setting id
		'label'    => __('Info 2 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_2_value',
		'type'     => 'url',
		'priority' => 1,
	));
	// section_2_info_3_key
	$wp_customize->add_setting("section_2_info_3_key", array(
		"default" => "Phone",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_3_key', array( // setting id
		'label'    => __('Info 3 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_3_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_3_value
	$wp_customize->add_setting("section_2_info_3_value", array(
		"default" => "+254 723 777 618",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_3_value', array( // setting id
		'label'    => __('Info 3 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_3_value',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_4_key
	$wp_customize->add_setting("section_2_info_4_key", array(
		"default" => "City",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_4_key', array( // setting id
		'label'    => __('Info 4 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_4_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_4_value
	$wp_customize->add_setting("section_2_info_4_value", array(
		"default" => "Nairobi, Kenya",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_4_value', array( // setting id
		'label'    => __('Info 4 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_4_value',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_5_key
	$wp_customize->add_setting("section_2_info_5_key", array(
		"default" => "Age",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_5_key', array( // setting id
		'label'    => __('Info 5 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_5_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_5_value
	$wp_customize->add_setting("section_2_info_5_value", array(
		"default" => "34",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_5_value', array( // setting id
		'label'    => __('Info 5 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_5_value',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_6_key
	$wp_customize->add_setting("section_2_info_6_key", array(
		"default" => "Education",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_6_key', array( // setting id
		'label'    => __('Info 6 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_6_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_6_value
	$wp_customize->add_setting("section_2_info_6_value", array(
		"default" => "IT Degree",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_6_value', array( // setting id
		'label'    => __('Info 6 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_6_value',
		'type'     => 'url',
		'priority' => 1,
	));
	// section_2_info_7_key
	$wp_customize->add_setting("section_2_info_7_key", array(
		"default" => "Email",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_7_key', array( // setting id
		'label'    => __('Info 7 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_7_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_7_value
	$wp_customize->add_setting("section_2_info_7_value", array(
		"default" => "jumbaeric@gmail.com",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_7_value', array( // setting id
		'label'    => __('Info 7 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_7_value',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_8_key
	$wp_customize->add_setting("section_2_info_8_key", array(
		"default" => "Freelance",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_8_key', array( // setting id
		'label'    => __('Info 8 Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_8_key',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_info_8_value
	$wp_customize->add_setting("section_2_info_8_value", array(
		"default" => "Available",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_info_8_value', array( // setting id
		'label'    => __('Info 8 Value', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_info_8_value',
		'type'     => 'text',
		'priority' => 1,
	));


	// section 2 title 2
	$wp_customize->add_setting("section_2_title_2", array(
		"default" => "Facts",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_title_2', array( // setting id
		'label'    => __('Title 2', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_title_2',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 2 description 2
	$wp_customize->add_setting("section_2_title_2_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_title_2_description', array( // setting id
		'label'    => __('Title 2 Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_title_2_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section 2 stats Icon 1
	$wp_customize->add_setting("section_2_stats_icon_1", array(
		"default" => "bi bi-emoji-smile",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_icon_1', array( // setting id
		'label'    => __('Stats 1 Icon Class (bi bi-emoji-smile)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_icon_1',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats number 1
	$wp_customize->add_setting("section_2_stats_number_1", array(
		"default" => "232",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_number_1', array( // setting id
		'label'    => __('Stats 1 Numbers', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_number_1',
		'type'     => 'number',
		'priority' => 1,
	));
	// section 2 stats text 1
	$wp_customize->add_setting("section_2_stats_text_1", array(
		"default" => "Happy Clients",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_text_1', array( // setting id
		'label'    => __('Stats 1 Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_text_1',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats Icon 2
	$wp_customize->add_setting("section_2_stats_icon_2", array(
		"default" => "bi bi-journal-richtext",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_icon_2', array( // setting id
		'label'    => __('Stats 2 Icon Class (bi bi-journal-richtext)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_icon_2',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats number 2
	$wp_customize->add_setting("section_2_stats_number_2", array(
		"default" => "132",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_number_2', array( // setting id
		'label'    => __('Stats 2 Numbers', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_number_2',
		'type'     => 'number',
		'priority' => 1,
	));
	// section 2 stats text 2
	$wp_customize->add_setting("section_2_stats_text_2", array(
		"default" => "Projects",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_text_2', array( // setting id
		'label'    => __('Stats 2 Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_text_2',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats Icon 3
	$wp_customize->add_setting("section_2_stats_icon_3", array(
		"default" => "bi bi-headset",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_icon_3', array( // setting id
		'label'    => __('Stats 3 Icon Class (bi bi-headset)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_icon_3',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats number 3
	$wp_customize->add_setting("section_2_stats_number_3", array(
		"default" => "1231",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_number_3', array( // setting id
		'label'    => __('Stats 3 Numbers', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_number_3',
		'type'     => 'number',
		'priority' => 1,
	));
	// section 2 stats text 3
	$wp_customize->add_setting("section_2_stats_text_3", array(
		"default" => "Hours Of Support",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_text_3', array( // setting id
		'label'    => __('Stats 3 Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_text_3',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats Icon 4
	$wp_customize->add_setting("section_2_stats_icon_4", array(
		"default" => "bi bi-people",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_icon_4', array( // setting id
		'label'    => __('Stats 4 Icon Class (bi bi-people)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_icon_4',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 2 stats number 4
	$wp_customize->add_setting("section_2_stats_number_4", array(
		"default" => "32",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_number_4', array( // setting id
		'label'    => __('Stats 4 Numbers', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_number_4',
		'type'     => 'number',
		'priority' => 1,
	));
	// section 2 stats text 4
	$wp_customize->add_setting("section_2_stats_text_4", array(
		"default" => "Hard Workers",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_stats_text_4', array( // setting id
		'label'    => __('Stats 4 Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_stats_text_4',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 2 title 3
	$wp_customize->add_setting("section_2_title_3", array(
		"default" => "Skills",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_title_3', array( // setting id
		'label'    => __('Title 3', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_title_3',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 2 description 3
	$wp_customize->add_setting("section_2_title_3_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_title_3_description', array( // setting id
		'label'    => __('Title 3 Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_title_3_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section_2_skill_1
	$wp_customize->add_setting("section_2_skill_1", array(
		"default" => "HTML",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_1', array( // setting id
		'label'    => __('Skill', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_1',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_1_level
	$wp_customize->add_setting("section_2_skill_1_level", array(
		"default" => "100",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_1_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_1_level',
		'type'     => 'number',
		'priority' => 1,
	));
	// section_2_skill_2
	$wp_customize->add_setting("section_2_skill_2", array(
		"default" => "JAVASCRIPT",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_2', array( // setting id
		'label'    => __('Skill 2', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_2',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_2_level
	$wp_customize->add_setting("section_2_skill_2_level", array(
		"default" => "90",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_2_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_1_level',
		'type'     => 'number',
		'priority' => 1,
	));
	// section_2_skill_3
	$wp_customize->add_setting("section_2_skill_3", array(
		"default" => "PHP",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_3', array( // setting id
		'label'    => __('Skill', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_3',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_3_level
	$wp_customize->add_setting("section_2_skill_3_level", array(
		"default" => "95",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_3_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_3_level',
		'type'     => 'number',
		'priority' => 1,
	));
	// section_2_skill_4
	$wp_customize->add_setting("section_2_skill_4", array(
		"default" => "WORDPRESS / CMS",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_4', array( // setting id
		'label'    => __('Skill', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_4',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_4_level
	$wp_customize->add_setting("section_2_skill_4_level", array(
		"default" => "100",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_4_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_4_level',
		'type'     => 'number',
		'priority' => 1,
	));
	// section_2_skill_5
	$wp_customize->add_setting("section_2_skill_5", array(
		"default" => "CSS",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_5', array( // setting id
		'label'    => __('Skill', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_5',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_5_level
	$wp_customize->add_setting("section_2_skill_5_level", array(
		"default" => "100",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_5_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_5_level',
		'type'     => 'number',
		'priority' => 1,
	));
	// section_2_skill_6
	$wp_customize->add_setting("section_2_skill_6", array(
		"default" => "PHOTOSHOP",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_6', array( // setting id
		'label'    => __('Skill', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_6',
		'type'     => 'text',
		'priority' => 1,
	));
	// section_2_skill_6_level
	$wp_customize->add_setting("section_2_skill_6_level", array(
		"default" => "100",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_2_skill_6_level', array( // setting id
		'label'    => __('Skill Level (0-100)', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_2', // section id
		'settings' => 'section_2_skill_6_level',
		'type'     => 'number',
		'priority' => 1,
	));


	// Home Page Section 3 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_3',
		array(
			'title'         => __('Home Section 3', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section 3 title 1
	$wp_customize->add_setting("section_3_title_1", array(
		"default" => "Resume",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_title_1', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_title_1',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 3 description 1
	$wp_customize->add_setting("section_3_title_1_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_title_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_title_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section 3 Summary Text
	$wp_customize->add_setting("section_3_summary_text", array(
		"default" => "Summary",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_summary_text', array( // setting id
		'label'    => __('Summary Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_summary_text',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 3 Summary description
	$wp_customize->add_setting("section_3_summary_description", array(
		"default" => "Innovative and deadline-driven Graphic Designer with 3+ years of experience designing and developing user-centered digital/print marketing material from initial concept to final, polished deliverable.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_summary_description', array( // setting id
		'label'    => __('Resume Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_summary_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section 3 Summary Location
	$wp_customize->add_setting("section_3_summary_location", array(
		"default" => "Muthith Rd, Westlands",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_summary_location', array( // setting id
		'label'    => __('Summary Location', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_summary_location',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 3 Summary Phone
	$wp_customize->add_setting("section_3_summary_phone", array(
		"default" => "(254) 723 777 618",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_summary_phone', array( // setting id
		'label'    => __('Summary Phone', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_summary_phone',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 3 Summary Email
	$wp_customize->add_setting("section_3_summary_email", array(
		"default" => "jumbaeric@gmail.com",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_summary_email', array( // setting id
		'label'    => __('Summary Email', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_summary_email',
		'type'     => 'text',
		'priority' => 1,
	));


	// section 3 Education Text
	$wp_customize->add_setting("section_3_education_text", array(
		"default" => "Education",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_education_text', array( // setting id
		'label'    => __('Education Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_education_text',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 1
	$wp_customize->add_setting("section_3_award_1", array(
		"default" => "MASTER OF FINE ARTS & GRAPHIC DESIGN",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_1', array( // setting id
		'label'    => __('Award', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_1',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 1 Year
	$wp_customize->add_setting("section_3_award_1_year", array(
		"default" => "2015 - 2016",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_1_year', array( // setting id
		'label'    => __('School Year', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_1_year',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 1 School
	$wp_customize->add_setting("section_3_award_1_school", array(
		"default" => "University of Nairobi",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_1_school', array( // setting id
		'label'    => __('Institution Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_1_school',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 1 Description
	$wp_customize->add_setting("section_3_award_1_description", array(
		"default" => "Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));
	// section 3 Award 2
	$wp_customize->add_setting("section_3_award_2", array(
		"default" => "BACHELOR OF FINE ARTS & GRAPHIC DESIGN",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_2', array( // setting id
		'label'    => __('Award', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_2',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 2 Year
	$wp_customize->add_setting("section_3_award_2_year", array(
		"default" => "2010 - 2014",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_2_year', array( // setting id
		'label'    => __('School Year', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_2_year',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 2 School
	$wp_customize->add_setting("section_3_award_2_school", array(
		"default" => "NIBS College",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_2_school', array( // setting id
		'label'    => __('Institution Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_2_school',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Award 2 Description
	$wp_customize->add_setting("section_3_award_2_description", array(
		"default" => "Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_award_2_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_award_2_description',
		'type'     => 'textarea',
		'priority' => 1,
	));


	// section 3 Experience Text
	$wp_customize->add_setting("section_3_experience_text", array(
		"default" => "Professional Experience",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_text', array( // setting id
		'label'    => __('Experience Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_text',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 1
	$wp_customize->add_setting("section_3_experience_1", array(
		"default" => "SENIOR BACKEND DEVELOPER",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_1', array( // setting id
		'label'    => __('Job Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_1',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 1 Year
	$wp_customize->add_setting("section_3_experience_1_year", array(
		"default" => "2021 - 2022",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_1_year', array( // setting id
		'label'    => __('Employment Year', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_1_year',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 1 Company
	$wp_customize->add_setting("section_3_experience_1_company", array(
		"default" => "Yellow Pages Kenya",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_1_company', array( // setting id
		'label'    => __('Company Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_1_company',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 1 Description
	$wp_customize->add_setting("section_3_experience_1_description", array(
		"default" => "Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend",
		// 'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'section_3_experience_1_description', array(
		'label'   => 'Responsibilities',
		'section' => 'yuri_lucas_home_page_section_3',
		'settings'   => 'section_3_experience_1_description',
		'priority' => 1
	)));

	// section 3 Experience 2
	$wp_customize->add_setting("section_3_experience_2", array(
		"default" => "SENIOR BACKEND DEVELOPER",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_2', array( // setting id
		'label'    => __('Job Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_2',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 2 Year
	$wp_customize->add_setting("section_3_experience_2_year", array(
		"default" => "2018 - 2020",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_2_year', array( // setting id
		'label'    => __('Employment Year', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_2_year',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 2 Company
	$wp_customize->add_setting("section_3_experience_2_company", array(
		"default" => "WPP, Squad Digital",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_3_experience_2_company', array( // setting id
		'label'    => __('Company Name', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_3', // section id
		'settings' => 'section_3_experience_2_company',
		'type'     => 'text',
		'priority' => 1,
	));
	// section 3 Experience 2 Description
	$wp_customize->add_setting("section_3_experience_2_description", array(
		"default" => "Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend",
		// 'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control(new Text_Editor_Custom_Control($wp_customize, 'section_3_experience_2_description', array(
		'label'   => 'Responsibilities',
		'section' => 'yuri_lucas_home_page_section_3',
		'settings'   => 'section_3_experience_2_description',
		'priority' => 1
	)));

	// Home Page Section 4 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_4',
		array(
			'title'         => __('Home Section 4', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section 4 title 1
	$wp_customize->add_setting("section_4_title_1", array(
		"default" => "Portfolio",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_4_title_1', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_4', // section id
		'settings' => 'section_4_title_1',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 4 description 1
	$wp_customize->add_setting("section_4_title_1_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_4_title_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_4', // section id
		'settings' => 'section_4_title_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));


	// Home Page Section 5 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_5',
		array(
			'title'         => __('Home Section 5', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section 5 title 1
	$wp_customize->add_setting("section_5_title_1", array(
		"default" => "Services",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_5_title_1', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_5', // section id
		'settings' => 'section_5_title_1',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 5 description 1
	$wp_customize->add_setting("section_5_title_1_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_5_title_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_5', // section id
		'settings' => 'section_5_title_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// Home Page Section 6 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_6',
		array(
			'title'         => __('Home Section 6', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section 6 title 1
	$wp_customize->add_setting("section_6_title_1", array(
		"default" => "Testimonials",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_6_title_1', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_6', // section id
		'settings' => 'section_6_title_1',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 6 description 1
	$wp_customize->add_setting("section_6_title_1_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_6_title_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_6', // section id
		'settings' => 'section_6_title_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// Home Page Section 7 
	$wp_customize->add_section(
		'yuri_lucas_home_page_section_7',
		array(
			'title'         => __('Home Section 7', 'yuri-lucas'),
			'panel' => 'homepage',
			'priority'      => 2
		)
	);

	// section 7 title 1
	$wp_customize->add_setting("section_7_title_1", array(
		"default" => "Contact",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_title_1', array( // setting id
		'label'    => __('Title', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_title_1',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 7 description 1
	$wp_customize->add_setting("section_7_title_1_description", array(
		"default" => "Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_title_1_description', array( // setting id
		'label'    => __('Description', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_title_1_description',
		'type'     => 'textarea',
		'priority' => 1,
	));

	// section 7 Contact Location
	$wp_customize->add_setting("section_7_contact_location_text", array(
		"default" => "Location",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_location_text', array( // setting id
		'label'    => __('Location Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_location_text',
		'type'     => 'text',
		'priority' => 1,
	));
	$wp_customize->add_setting("section_7_contact_location", array(
		"default" => "Muthithi Rd, Westlands",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_location', array( // setting id
		'label'    => __('Location', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_location',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 7 Contact Email
	$wp_customize->add_setting("section_7_contact_email_text", array(
		"default" => "Email",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_email_text', array( // setting id
		'label'    => __('Email Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_email_text',
		'type'     => 'text',
		'priority' => 1,
	));
	$wp_customize->add_setting("section_7_contact_email", array(
		"default" => "jumbaeric@gmail.com",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_email', array( // setting id
		'label'    => __('Email', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_email',
		'type'     => 'text',
		'priority' => 1,
	));

	// section 7 Contact Phone
	$wp_customize->add_setting("section_7_contact_phone_text", array(
		"default" => "Phone",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_phone_text', array( // setting id
		'label'    => __('Phone Text', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_phone_text',
		'type'     => 'text',
		'priority' => 1,
	));
	$wp_customize->add_setting("section_7_contact_phone", array(
		"default" => "(254) 723 777 618",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_phone', array( // setting id
		'label'    => __('Phone', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_phone',
		'type'     => 'text',
		'priority' => 1,
	));

	$wp_customize->add_setting("section_7_contact_map", array(
		"default" => "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621",
		'sanitize_callback' => 'sanitize_text_field',
		"transport" => "postMessage",
	));
	$wp_customize->add_control('section_7_contact_map', array( // setting id
		'label'    => __('Google Maps Iframe', 'yuri-lucas'),
		'section'  => 'yuri_lucas_home_page_section_7', // section id
		'settings' => 'section_7_contact_map',
		'type'     => 'textarea',
		'priority' => 1,
	));
	// $wp_customize->add_setting('post_type_dropdown_setting', array(
	// 	'default'        => '',
	// ));
	// $wp_customize->add_control(new Post_Type_Dropdown_Custom_Control($wp_customize, 'post_type_dropdown_setting', array(
	// 	'label'   => 'Select Portfolio',
	// 	'section' => 'yuri_lucas_home_page_section_4',
	// 	'settings'   => 'post_type_dropdown_setting',
	// 	'priority' => 1
	// )));
}
add_action('customize_register', 'yuri_lucas_customize');

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 */
function yuri_lucas_customize_preview_js()
{
	wp_enqueue_script('customizer', get_template_directory_uri() . '/inc/customizer.js', array('jquery'), null, true);
}
add_action('customize_preview_init', 'yuri_lucas_customize_preview_js');
