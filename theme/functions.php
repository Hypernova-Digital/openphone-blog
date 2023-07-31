<?php

/**
 * OpenPhone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OpenPhone
 */

if (!defined('OPENPHONE_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('OPENPHONE_VERSION', '0.1.0');
}

if (!defined('OPENPHONE_TYPOGRAPHY_CLASSES')) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `openphone_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'OPENPHONE_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if (!function_exists('openphone_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function openphone_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on OpenPhone, use a find and replace
		 * to change 'openphone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('openphone', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __('Primary', 'openphone'),
				'menu-2' => __('Footer Menu', 'openphone'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'openphone_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function openphone_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Header Search', 'openphone'),
			'id'            => 'header-search',
			'description'   => __('Add widgets here to appear in your header.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Header CTAs', 'openphone'),
			'id'            => 'header-ctas',
			'description'   => __('Add widgets here to appear in your header.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer CTAs', 'openphone'),
			'id'            => 'footer-ctas',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Footer Categories 1', 'openphone'),
			'id'            => 'footer-categories-1',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Footer Categories 2', 'openphone'),
			'id'            => 'footer-categories-2',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Footer Categories 3', 'openphone'),
			'id'            => 'footer-categories-3',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Footer Categories 4', 'openphone'),
			'id'            => 'footer-categories-4',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Footer Categories 5', 'openphone'),
			'id'            => 'footer-categories-5',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer Blog', 'openphone'),
			'id'            => 'footer-blog',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer 1', 'openphone'),
			'id'            => 'footer-1',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer 2', 'openphone'),
			'id'            => 'footer-2',
			'description'   => __('Add widgets here to appear in your footer.', 'openphone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'openphone_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function openphone_scripts()
{
	wp_enqueue_style('openphone-style', get_stylesheet_uri(), array(), OPENPHONE_VERSION);
	wp_enqueue_script('openphone-script', get_template_directory_uri() . '/js/script.min.js', ['jquery'], OPENPHONE_VERSION, true);

	if (is_singular('post')) {
		wp_enqueue_script('openphone-blog-script', get_template_directory_uri() . '/js/blog-post.min.js', array(), OPENPHONE_VERSION, true);
	}
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'openphone_scripts');

/**
 * Enqueue the block editor script.
 */
function openphone_enqueue_block_editor_script()
{
	wp_enqueue_script(
		'openphone-editor',
		get_template_directory_uri() . '/js/block-editor.min.js',
		array(
			'wp-blocks',
			'wp-edit-post',
		),
		OPENPHONE_VERSION,
		true
	);
}
add_action('enqueue_block_editor_assets', 'openphone_enqueue_block_editor_script');

/**
 * Create a JavaScript array containing the Tailwind Typography classes from
 * OPENPHONE_TYPOGRAPHY_CLASSES for use when adding Tailwind Typography support
 * to the block editor.
 */
function openphone_admin_scripts()
{
?>
	<script>
		tailwindTypographyClasses = '<?php echo esc_attr(OPENPHONE_TYPOGRAPHY_CLASSES); ?>'.split(' ');
	</script>
<?php
}
add_action('admin_print_scripts', 'openphone_admin_scripts');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function openphone_tinymce_add_class($settings)
{
	$settings['body_class'] = OPENPHONE_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter('tiny_mce_before_init', 'openphone_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


function themename_custom_logo_setup()
{
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array('site-title', 'site-description'),
		'unlink-homepage-logo' => true,
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

function mytheme_add_theme_support()
{
	add_theme_support('block-templates');
}
add_action('after_setup_theme', 'mytheme_add_theme_support');

function add_custom_post_variation($variations)
{
	$variations['custom_post_variation'] = array(
		'name' => 'Custom Post Variation',
		'template_lock' => 'all',
		'template' => array(
			array('core/paragraph', array(
				'placeholder' => 'Add custom content here...',
			)),
			array('core/image', array(
				'align' => 'center',
			)),
		),
	);

	return $variations;
}
add_filter('block_editor_settings_all', 'add_custom_post_variation');

function enqueue_my_block_editor_assets()
{
	// Enqueue the block's script
	wp_enqueue_script(
		'my-block',
		get_theme_file_uri('/build/openphone-cta/index.js'), // Replace with the correct path to your index.js file
		array('wp-blocks', 'wp-element', 'wp-data'),
		filemtime(get_theme_file_path('/build/openphone-cta/index.js')) // Replace with the correct path to your index.js file
	);

	// Pass theme URL to the block
	$theme = wp_get_theme();
	$theme_data = array(
		'themeURL' => $theme->get_stylesheet_directory_uri(),
	);
	wp_add_inline_script('my-block', 'window.themeData = ' . wp_json_encode($theme_data) . ';');
}
add_action('enqueue_block_editor_assets', 'enqueue_my_block_editor_assets');


function openphone_enqueue_block_assets()
{
	wp_enqueue_script(
		'openphone-cta',
		get_template_directory_uri() . '/build/openphone-cta/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-email-signup',
		get_template_directory_uri() . '/build/openphone-email-signup/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-featured-resource',
		get_template_directory_uri() . '/build/openphone-featured-resource/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_register_script(
        'openphone-latest-post',
        get_template_directory_uri() . '/build/openphone-latest-post/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
    );

    // Localize the script with new data
    $theme_array = array(
        'themeURL' => get_template_directory_uri(),
    );
    wp_localize_script('openphone-latest-post', 'themeData', $theme_array);
    
    wp_enqueue_script('openphone-latest-post');

	wp_enqueue_script(
		'openphone-faqs',
		get_template_directory_uri() . '/build/openphone-faqs/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-next-posts',
		get_template_directory_uri() . '/build/openphone-next-posts/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-trending',
		get_template_directory_uri() . '/build/openphone-trending/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-tldr',
		get_template_directory_uri() . '/build/openphone-tldr/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-latest-category-posts',
		get_template_directory_uri() . '/build/openphone-latest-posts-by-category/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);
}

add_action('enqueue_block_editor_assets', 'openphone_enqueue_block_assets');


function openphone_render_next_posts_block($attributes, $content)
{
	$next_posts = wp_get_recent_posts(array(
		'numberposts' => $attributes['postsToShow'],
		'offset' => 1,
		'post_status' => 'publish',
	));

	if (empty($next_posts)) {
		return '';
	}

	ob_start();

?>
	<div class="next-posts title-and-link flex flex-row justify-between items-center lg:mt-12">
		<div class="mx-6 lg:mx-0 mb-6 mt-12 text-[23px] font-semibold text-black">The Latest</div>
		<?php
		$blog_page = get_option('page_for_posts');
		$blog_page_link = get_permalink($blog_page);
		?>
		<a href="<?php echo $blog_page_link; ?>" class="black-to-purple-link mt-4 mr-6 lg:mr-0 no-underline text-sm font-medium text-black hover:text-purple-900">See all -></a>
	</div>

	<div class="next-posts flex flex-col lg:mb-12">
		<div class="next-posts-list flex flex-row overflow-scroll snap-x px-6 lg:px-0 pb-14 lg:pb-6 gap-6">
			<?php

			foreach ($next_posts as $post) {
			?>
				<a href="<?php echo get_the_permalink($post['ID']); ?>" class="next-posts-post cursor-pointer snap-center rounded-md border border-[1px] border-opacity-10 border-black w-72 lg:w-1/3 hover:border-opacity-100 no-underline">
					<div class="overflow-hidden rounded-md">
						<div class="image w-72 lg:w-full">
							<img src="<?php echo get_the_post_thumbnail_url($post['ID'], 'full'); ?>" class="m-0" />

						</div>

						<div class="content p-4">
							<div class="meta">
								<?php
								$firstCategoryDisplayed = false;
								foreach (get_categories() as $category) {
									if ($firstCategoryDisplayed) {
										break; // Exit the loop after the first category is displayed
									}
									echo '<span class="[&_a]:text-[11px] sm:[&_a]:text-xs md:[&_a]:text-sm [&_a]:no-underline text-purple-900">';
									echo $category->name;
									echo '</span>';
									$firstCategoryDisplayed = true;
								}
								?>
								</span><span class="opacity-10"> | </span>
								<span class="text-[11px] sm:text-xs md:text-sm opacity-70 text-black"><?php echo get_the_date('F j, Y', $post['ID']); ?></span>
								<?php //echo (do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read" post_id="' . $post['ID'] . '"]')); 
								?>
							</div>

							<span class="title m-0 leading-1 text-base lg:text-xl leading-[1px] font-semibold no-underline text-black"><?php echo get_the_title($post['ID']); ?></span>
						</div>
					</div>
				</a>
			<?php
			}

			?>
		</div>
	</div> <?php

			return ob_get_clean();
		}

		register_block_type('openphone/next-posts', array(
			'attributes' => array(
				'postsToShow' => array(
					'type' => 'number',
					'default' => 3
				)
			),
			'render_callback' => 'openphone_render_next_posts_block',
		));


		function openphone_render_latest_category_posts_block($attributes, $content)
		{
			$next_posts = get_posts(array(
				'numberposts' => $attributes['postsToShow'],
				'category'    => $attributes['selectedCategory'],
				'post_status' => 'publish',
			));

			if (empty($next_posts)) {
				return '';
			}

			ob_start();

			//print the catgory name base on attributes['selectedCategory']
			$cat = get_category($attributes['selectedCategory']);
			$cat_name = $cat->name;
			$cat_description = $cat->description;
			?>
	<?php if ($attributes['preHeader']) : ?>
		<h4 class="wp-block-heading eyebrows text-black"><?php echo $attributes['preHeader']; ?></h4>
	<?php endif; ?>

	<div class="category-posts title-and-link flex flex-row justify-between items-end lg:mt-12 text-black">
		<div class="mx-6 lg:mx-0 mb-6 lg:mb-12 mt-12">
			<div class="text-[40px] lg:text-7xl font-semibold leading-[1]"><?php echo $cat_name; ?></div>
			<div class="text-sm lg:text-[19px] opacity-70 mt-4 lg:mt-3"><?php echo $cat_description; ?></div>
		</div>
		<?php
			//get the category link with the anchor "see all"
			$cat_link = get_category_link($attributes['selectedCategory']);
		?>
		<a href="<?php echo $cat_link; ?>" class="black-to-purple-link mt-0 mb-6 lg:mb-12 mr-6 no-underline text-sm font-medium text-black w-24  ">See all -></a>
	</div>
	<div class="category-posts post-wrapper flex flex-col lg:mb-28 xl:mb-32 mr-0 <?php if (isset($attributes['showBrowseResources']) && $attributes['showBrowseResources']) {echo 'has-browae-resources';} ?>">
		<div class="category-posts-list flex flex-row overflow-scroll snap-x px-6 pb-6 gap-6 w-full" style="transition-duration: 100ms !important;">

			<?php

			foreach ($next_posts as $post) {
				setup_postdata($post);
			?>
				<!-- <a class="no-underline transition" href="<?php echo get_permalink($post); ?>" style="transition-duration: 100ms !important;"> -->
				<div style="transition-duration: 100ms !important;" class="category-posts-post snap-center md:snap-start rounded-md border-[1px] border-opacity-10 border-black w-full lg:w-[35rem] flex">
					<a href="<?php echo get_permalink($post); ?>" class="no-underline grow-1 overflow-hidden">
						<div class="rounded-md overflow-hidden" style="transition-duration: 100ms !important;">
							<div class="image w-64 md:w-96 lg:w-[36rem]">
								<img src="<?php echo get_the_post_thumbnail_url($post, 'full'); ?>" class="thumbnail m-0 w-full" />
							</div>

							<div class="content p-4 lg:p-6" style="transition-duration: 100ms !important;">
								<div class="meta" style="transition-duration: 100ms !important;">
									<span class="font-semibold text-[11px] sm:text-xs md:text-sm no-underline text-purple-900" style="transition-duration: 100ms !important;">
										<?php
										$categories = get_the_category($post);
										if (!empty($categories)) {
											echo esc_html($categories[0]->name);
										}
										?>
									</span>
									<span class="opacity-10"> | </span>
									<span class="text-[11px] sm:text-xs md:text-sm opacity-70" style="transition-duration: 100ms !important;"><?php echo get_the_date('F j, Y', $post); ?></span>
								</div>

								<span class="m-0 leading-1 text-base lg:text-xl leading-[1px] font-semibold mt-2"><?php echo get_the_title($post); ?></span>
								<?php  //echo (do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read" post_id="' . $post['ID'] . '"]')); 
								?>
							</div>

						</div>
					</a>
				</div>
				<!-- </a> -->
			<?php
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
	<?php if (isset($attributes['showBrowseResources']) && $attributes['showBrowseResources']) : ?>
		<div class="browse-resources bg-purple-25 lg:w-[880px] xl:w-[1200px] lg:rounded-[10px] lg:mt-16 lg:mb-28 xl:mb-32">
			<a href="<?php echo $attributes['browseResourcesLink']; ?>" class="black-to-purple-link flex flex-row items-center gap-4 px-8 lg:px-4 text-sm sm:text-base lg:text-[19px] text-black no-underline font-medium leading-[1.5]">
				<img src="<?php echo $attributes['browseResourcesImage']; ?>" alt="" class="resource-image lg:my-4 my-6" />
				<?php echo $attributes['browseResourcesText']; ?>
			</a>
		</div>
	<?php endif; ?>
<?php

			return ob_get_clean();
		}


		register_block_type('openphone/latest-category-posts', array(
			'attributes' => array(
				'selectedCategory' => array(
					'type' => 'string',
					'default' => ''
				),
				'postsToShow' => array(
					'type' => 'number',
					'default' => 5
				),
				'preHeader' => array(
					'type' => 'string',
					'default' => 'Featured Resource'
				),
			),
			'render_callback' => 'openphone_render_latest_category_posts_block',
		));


		add_action('rest_api_init', 'register_rest_images');

		function register_rest_images()
		{
			register_rest_field(
				array('post'),
				'featured_image_src', //Name of the new field to be added
				array(
					'get_callback'    => 'get_rest_featured_image',
					'update_callback' => null,
					'schema'          => null,
				)
			);
		}

		function get_rest_featured_image($object, $field_name, $request)
		{
			if ($object['featured_media']) {
				$img = wp_get_attachment_image_src($object['featured_media'], 'app-thumb');
				return $img[0];
			}
			return false;
		}

		function custom_header_bg_color_meta_box()
		{
			add_meta_box(
				'custom_header_bg_color',
				__('Header Background Color', 'text-domain'),
				'render_custom_header_bg_color_meta_box',
				'post', // Change this to the desired post type, e.g., 'page' for pages
				'side', // Change 'normal' to 'side'
				'high'
			);
		}


		function render_custom_header_bg_color_meta_box($post)
		{
			$bg_color = get_post_meta($post->ID, 'header_bg_color', true);
			$colors = array(
				'bg-purple-50' => 'Purple',
				'bg-red-50' => 'Red',
				'bg-green-50' => 'Green',
				'bg-blue-50' => 'Blue',
				'bg-yellow-50' => 'Yellow',
				'bg-orange-50' => 'Orange',
				// Add more colors as needed
			);
?>

	<label for="header-bg-color"><?php _e('Select Header Background Color:', 'text-domain'); ?></label>
	<select name="header-bg-color" id="header-bg-color">
		<?php foreach ($colors as $color_class => $color_name) : ?>
			<option value="<?php echo esc_attr($color_class); ?>" <?php selected($bg_color, $color_class); ?>><?php echo esc_html($color_name); ?></option>
		<?php endforeach; ?>
	</select>

<?php

			// Custom Field Settings 
		}

		function save_custom_header_bg_color($post_id)
		{
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			if (isset($_POST['header-bg-color'])) {
				$bg_color = sanitize_text_field($_POST['header-bg-color']);
				update_post_meta($post_id, 'header_bg_color', $bg_color);
			}
		}

		add_action('add_meta_boxes', 'custom_header_bg_color_meta_box');
		add_action('save_post', 'save_custom_header_bg_color');


		function custom_layout_option_meta_box()
		{
			add_meta_box(
				'custom_layout_option',
				__('Layout Option', 'text-domain'),
				'render_custom_layout_option_meta_box',
				'post',
				'side',
				'high'
			);
		}

		function render_custom_layout_option_meta_box($post)
		{
			$layout_option = get_post_meta($post->ID, 'layout_option', true);
			$options = array(
				'with-toc' => 'With TOC',
				'without-toc' => 'Without TOC',
			);
?>
	<label for="layout-option"><?php _e('Select Layout Option:', 'text-domain'); ?></label>
	<select name="layout-option" id="layout-option">
		<?php foreach ($options as $option_class => $option_name) : ?>
			<option value="<?php echo esc_attr($option_class); ?>" <?php selected($layout_option, $option_class); ?>><?php echo esc_html($option_name); ?></option>
		<?php endforeach; ?>
	</select>
<?php
		}


		function save_custom_layout_option($post_id)
		{
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			if (isset($_POST['layout-option'])) {
				$layout_option = sanitize_text_field($_POST['layout-option']);
				update_post_meta($post_id, 'layout_option', $layout_option);
				error_log("Layout option '$layout_option' saved for post $post_id");
			} else {
				error_log("No layout option received for post $post_id");
			}
		}

		add_action('add_meta_boxes', 'custom_layout_option_meta_box');
		add_action('save_post', 'save_custom_layout_option');



		function custom_search_shortcode_meta_box()
		{
			add_meta_box(
				'custom_search_shortcode',
				__('Search Shortcode', 'text-domain'),
				'render_custom_search_shortcode_meta_box',
				'page',  // or 'post', if you want this metabox to show up on posts
				'side',
				'high'
			);
		}
		add_action('add_meta_boxes', 'custom_search_shortcode_meta_box');

		function render_custom_search_shortcode_meta_box($post)
		{
			$search_shortcode = get_post_meta($post->ID, 'search_field', true);
?>
	<label for="search-shortcode"><?php _e('Enter Search Shortcode:', 'text-domain'); ?></label>
	<input type="text" id="search-shortcode" name="search-shortcode" value="<?php echo esc_attr($search_shortcode); ?>" />
<?php
		}

		function save_custom_search_shortcode($post_id)
		{
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			if (isset($_POST['search-shortcode'])) {
				$search_shortcode = sanitize_text_field($_POST['search-shortcode']);
				update_post_meta($post_id, 'search_field', $search_shortcode);
			}
		}
		add_action('save_post', 'save_custom_search_shortcode');
