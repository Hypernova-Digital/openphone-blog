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

	if (is_singular()) {
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


function openphone_enqueue_block_assets()
{
	wp_enqueue_script(
		'openphone-latest-post',
		get_template_directory_uri() . '/build/openphone-latest-post/index.js',
		include get_template_directory_uri() . '/build/openphone-latest-post/block.php',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);
	wp_enqueue_script(
		'openphone-next-posts',
		get_template_directory_uri() . '/build/openphone-next-posts/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);

	wp_enqueue_script(
		'openphone-latest-category-posts',
		get_template_directory_uri() . '/build/openphone-latest-posts-by-category/index.js',
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
	);
}

add_action('enqueue_block_editor_assets', 'openphone_enqueue_block_assets');

function openphone_render_latest_post_block($attributes, $content)
{
	$recent_posts = wp_get_recent_posts(array(
		'numberposts' => 1,
		'post_status' => 'publish',
	));
	if (empty($recent_posts)) {
		return '';
	}

	$post = $recent_posts[0];
	ob_start();
?>
	<div class="latest-post flex flex-col-reverse md:flex-row gap-16 lg:my-12">
		<div class="content mx-6 mt-4 sm:mt-6 sm:mx-8 md:mx-10 lg:mx-0 lg:mt-0">
			<div class="meta">
				<span class="[&_a]:text-[11px] sm:[&_a]:text-xs md:[&_a]:text-sm [&_a]:no-underline"><?php echo get_the_category_list(', ', '', $post['ID']); ?></span><span class="opacity-10"> | </span>
				<span class="text-[11px] sm:text-xs md:text-sm opacity-70"><?php echo get_the_date('F j, Y', $post['ID']); ?></span>
				<?php //echo (do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read" post_id="' . $post['ID'] . '"]')); 
				?>
			</div>
			<h2 class="mt-3 sm:mt-[14px] md:mt-4 text-3xl sm:text-[40px] md:text-[56px] lg:text-6xl tracking-[-0.6px] leading-[1] mb-0 lg:mb-6"><?php echo get_the_title($post['ID']); ?></h2>
			<p class="hidden md:block opacity-70 text-base"><?php echo get_the_excerpt($post['ID']); ?></p>
		</div>
		<div class="image max-w-2xl">
			<img src="<?php echo get_the_post_thumbnail_url($post['ID']); ?>" class="m-0" />
		</div>
	</div>
<?php
	return ob_get_clean();
}

register_block_type('openphone/latest-post', array(
	'render_callback' => 'openphone_render_latest_post_block',
));

// Add this to your functions.php file.


function openphone_render_next_posts_block($attributes, $content)
{
	$recent_posts = wp_get_recent_posts(array(
		'numberposts' => $attributes['postsToShow'],
		'offset' => 1,
		'post_status' => 'publish',
	));

	if (empty($recent_posts)) {
		return '';
	}

	ob_start();

?>
	<div class="next-posts title-and-link flex flex-row justify-between items-center lg:mt-12">
		<div class="mx-6 mb-6 mt-12 text-[23px] font-semibold">The Latest</div>
		<?php
		$blog_page = get_option('page_for_posts');
		$blog_page_link = get_permalink($blog_page);
		?>
		<a href="<?php echo $blog_page_link; ?>" class="mt-4 mr-6 no-underline text-sm font-medium text-black">See all -></a>
	</div>

	<div class="next-posts flex flex-col lg:mb-12">
		<div class="next-posts-list flex flex-row overflow-scroll snap-x px-6 pb-6 gap-6">
			<?php

			foreach ($recent_posts as $post) {
			?>

				<div class="nexrt-posts-post snap-center rounded-md border border-[1px] border-opacity-10 border-black lg:w-1/3">
					<div class="image w-72 lg:w-full">
						<img src="<?php echo get_the_post_thumbnail_url($post['ID']); ?>" class="m-0" />
					</div>

					<div class="content p-4">
						<div class="meta">
							<span class="[&_a]:text-[11px] sm:[&_a]:text-xs md:[&_a]:text-sm [&_a]:no-underline text-purple-900"><?php echo get_the_category_list(', ', '', $post['ID']); ?></span><span class="opacity-10"> | </span>
							<span class="text-[11px] sm:text-xs md:text-sm opacity-70"><?php echo get_the_date('F j, Y', $post['ID']); ?></span>
							<?php //echo (do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read" post_id="' . $post['ID'] . '"]')); 
							?>
						</div>

						<span class="m-0 leading-1 text-base lg:text-xl leading-[1px] font-semibold"><?php echo get_the_title($post['ID']); ?></span>
						<p><?php // echo get_the_excerpt($post['ID']); 
							?></p>
						<?php // echo $post['ID']; 
						?>
						<?php  //echo (do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read" post_id="' . $post['ID'] . '"]')); 
						?>
					</div>
				</div>
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
			$recent_posts = get_posts(array(
				'numberposts' => $attributes['postsToShow'],
				'category'    => $attributes['selectedCategory'],
				'post_status' => 'publish',
			));

			if (empty($recent_posts)) {
				return '';
			}

			ob_start();

			//print the catgory name base on attributes['selectedCategory']
			$cat = get_category($attributes['selectedCategory']);
			$cat_name = $cat->name;
			?>
	<h2><?php echo $cat_name; ?></h2>
	<?php

			//get the category link with the anchor "see all"
			$cat_link = get_category_link($attributes['selectedCategory']);
	?>
	<a href="<?php echo $cat_link; ?>">See All</a>
	<?php

			foreach ($recent_posts as $post) {
				setup_postdata($post);
	?>

		<h2><?php echo get_the_title($post); ?></h2>
		<p><?php echo get_the_excerpt($post); ?></p>
<?php
				wp_reset_postdata();
			}

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
					'default' => 10
				)
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
