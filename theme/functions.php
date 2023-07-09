<?php
/**
 * OpenPhone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OpenPhone
 */

if ( ! defined( 'OPENPHONE_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'OPENPHONE_VERSION', '0.1.0' );
}

if ( ! defined( 'OPENPHONE_TYPOGRAPHY_CLASSES' ) ) {
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

if ( ! function_exists( 'openphone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function openphone_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on OpenPhone, use a find and replace
		 * to change 'openphone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'openphone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'openphone' ),
				'menu-2' => __( 'Footer Menu', 'openphone' ),
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
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'openphone_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function openphone_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Header Search', 'openphone' ),
			'id'            => 'header-search',
			'description'   => __( 'Add widgets here to appear in your header.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Header CTAs', 'openphone' ),
			'id'            => 'header-ctas',
			'description'   => __( 'Add widgets here to appear in your header.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer CTAs', 'openphone' ),
			'id'            => 'footer-ctas',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Categories 1', 'openphone' ),
			'id'            => 'footer-categories-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Categories 2', 'openphone' ),
			'id'            => 'footer-categories-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Categories 3', 'openphone' ),
			'id'            => 'footer-categories-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Categories 4', 'openphone' ),
			'id'            => 'footer-categories-4',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Categories 5', 'openphone' ),
			'id'            => 'footer-categories-5',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Blog', 'openphone' ),
			'id'            => 'footer-blog',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'openphone' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'openphone' ),
			'id'            => 'footer-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'openphone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'openphone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function openphone_scripts() {
	wp_enqueue_style( 'openphone-style', get_stylesheet_uri(), array(), OPENPHONE_VERSION );
	wp_enqueue_script( 'openphone-script', get_template_directory_uri() . '/js/script.min.js', ['jquery'], OPENPHONE_VERSION, true );

	if( is_singular()) {
		wp_enqueue_script('openphone-blog-script', get_template_directory_uri() . '/js/blog-post.min.js', array(), OPENPHONE_VERSION, true);
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'openphone_scripts' );

/**
 * Enqueue the block editor script.
 */
function openphone_enqueue_block_editor_script() {
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
add_action( 'enqueue_block_editor_assets', 'openphone_enqueue_block_editor_script' );

/**
 * Create a JavaScript array containing the Tailwind Typography classes from
 * OPENPHONE_TYPOGRAPHY_CLASSES for use when adding Tailwind Typography support
 * to the block editor.
 */
function openphone_admin_scripts() {
	?>
	<script>
		tailwindTypographyClasses = '<?php echo esc_attr( OPENPHONE_TYPOGRAPHY_CLASSES ); ?>'.split(' ');
	</script>
	<?php
}
add_action( 'admin_print_scripts', 'openphone_admin_scripts' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function openphone_tinymce_add_class( $settings ) {
	$settings['body_class'] = OPENPHONE_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'openphone_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


function themename_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
