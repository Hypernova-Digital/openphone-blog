<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some functionality here could be replaced by core features.
 *
 * @package OpenPhone
 */

if (!function_exists('openphone_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function openphone_posted_on()
	{
		$time_string = '<time datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		printf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url(get_permalink()),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if (!function_exists('openphone_posted_by')) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function openphone_posted_by()
	{
		printf(
			/* translators: 1: posted by label, only visible to screen readers. 2: author link. 3: post author. */
			'<span class="sr-only">%1$s</span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
			esc_html__('Posted by', 'openphone'),
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			esc_html(get_the_author())
		);
	}
endif;

if (!function_exists('openphone_comment_count')) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function openphone_comment_count()
	{
		if (!post_password_required() && (comments_open() || get_comments_number())) {
			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link(sprintf(__('Leave a comment<span class="sr-only"> on %s</span>', 'openphone'), get_the_title()));
		}
	}
endif;

if (!function_exists('openphone_entry_meta_categories')) :

	function openphone_entry_meta_categories()
	{
		$categories_list = get_the_category_list(__(', ', 'openphone'));
		if ($categories_list) {
			/* translators: 1: categories label, only visible to screen readers. 2: list of categories. */
			printf(
				'<span class="sr-only">%1$s</span>%2$s',
				esc_html__('Categories:', 'openphone'),
				$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
endif;

if (!function_exists('openphone_entry_meta_tags')) :

	function openphone_entry_meta_tags()
	{
		$tags_list = get_the_tag_list('', __(' ', 'openphone'));
		if ($tags_list) {
			/* translators: 1: tags label, only visible to screen readers. 2: list of tags. */
			printf(
				'<span class="sr-only">%1$s</span>%2$s',
				esc_html__('Tags:', 'openphone'),
				$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
endif;

if (!function_exists('openphone_entry_meta')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * This template tag is used in the entry header.
	 */
	function openphone_entry_meta()
	{

		// Hide author, post date, category and tag text for pages.
		if ('post' === get_post_type()) {
			do_shortcode('[rt_reading_time post_id="' . get_the_ID() . '"]');

			// Posted on.
			openphone_posted_on();

			echo '<span class="divider opacity-40">';
			esc_html_e(' | ');
			echo '</span>';

			// Posted by.
			openphone_posted_by();
		}
	}
endif;

if (!function_exists('openphone_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function openphone_entry_footer()
	{
?>
		<div class="related-posts-after-content grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 px-8">
			<div class="flex flex-row justify-between items-center mb-8 w-full col-start-1 col-end-2 lg:col-end-3">
				<h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-semibold leading-[1.2] tracking-[-0.46px]">Keep Reading</h3>
				<a href="openphone.com/blog" class="text-sm font-medium sm:text-base lg:text-lg flex flex-row items-center gap-2">
					All posts
					<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9.27273 16.6307L7.51705 14.892L12.7756 9.63352H0V7.09375H12.7756L7.51705 1.84375L9.27273 0.0965905L17.5398 8.36364L9.27273 16.6307Z" fill="black" />
					</svg>

				</a>
			</div>

			<?php
			
			echo do_shortcode('[yarpp template="yarpp-template-thumbnail"]');

			?>
		</div>
		<?php
	}
endif;

if (!function_exists('openphone_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail, wrapping the post thumbnail in an
	 * anchor element except when viewing a single post.
	 */
	function openphone_post_thumbnail()
	{
		if (!openphone_can_show_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
		?>

			<figure>
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

		<?php
		else :
		?>

			<figure>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>

<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('openphone_comment_avatar')) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 *
	 * @param mixed $id_or_email The Gravatar to retrieve. Accepts a user_id, gravatar md5 hash,
	 *                           user email, WP_User object, WP_Post object, or WP_Comment object.
	 */
	function openphone_get_user_avatar_markup($id_or_email = null)
	{

		if (!isset($id_or_email)) {
			$id_or_email = get_current_user_id();
		}

		return sprintf('<div class="vcard">%s</div>', get_avatar($id_or_email, openphone_get_avatar_size()));
	}
endif;

if (!function_exists('openphone_discussion_avatars_list')) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 *
	 * @param array $comment_authors Comment authors to list as avatars.
	 */
	function openphone_discussion_avatars_list($comment_authors)
	{
		if (empty($comment_authors)) {
			return;
		}
		echo '<ol>', "\n";
		foreach ($comment_authors as $id_or_email) {
			printf(
				"<li>%s</li>\n",
				openphone_get_user_avatar_markup($id_or_email) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		echo '</ol>', "\n";
	}
endif;

if (!function_exists('openphone_the_posts_navigation')) :
	/**
	 * Wraps `the_posts_pagination` for use throughout the theme.
	 */
	function openphone_the_posts_navigation()
	{
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __('Previous', 'openphone'),
				'next_text' => __('Next', 'openphone'),
			)
		);
	}
endif;

if (!function_exists('openphone_content_class')) :
	/**
	 * Displays the class names for the post content wrapper.
	 *
	 * This allows us to add Tailwind Typography’s modifier classes throughout
	 * the theme without repeating them in multiple files. (They can be edited
	 * at the top of the `../functions.php` file via the
	 * OPENPHONE_TYPOGRAPHY_CLASSES constant.)
	 *
	 * Based on WordPress core’s `body_class` and `get_body_class` functions.
	 *
	 * @param array $class Space-separated string or array of class names to
	 *                     add to the class list.
	 */
	function openphone_content_class($class = '')
	{
		$all_classes = array($class, OPENPHONE_TYPOGRAPHY_CLASSES);

		foreach ($all_classes as &$classes) {
			if (!empty($classes)) {
				if (!is_array($classes)) {
					$classes = preg_split('#\s+#', $classes);
				}
			} else {
				// Ensure that we always coerce class to being an array.
				$classes = array();
			}
		}

		$combined_classes = array_merge($all_classes[0], $all_classes[1]);
		$combined_classes = array_map('esc_attr', $combined_classes);

		// Separates class names with a single space, preparing them for the
		// post content wrapper.
		echo 'class="' . esc_attr(implode(' ', $combined_classes)) . '"';
	}
endif;
