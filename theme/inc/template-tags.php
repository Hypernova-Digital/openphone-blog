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
		$tags_list = get_the_tag_list('', __(', ', 'openphone'));
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

		// Comment count.
		if (!is_singular()) {
			openphone_comment_count();
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__('Edit <span class="sr-only">%s</span>', 'openphone'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
	}
endif;

if (!function_exists('openphone_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function openphone_entry_footer()
	{
?>
		<div class="related-posts-after-content">
			<h3>Keep Reading</h3>
			<a href="openphone.com/blog">all posts</a>

			<?php
			global $post;
			$orig_post = $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();
				foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page' => 2, // Number of related posts to display.
					'caller_get_posts' => 1
				);

				$my_query = new wp_query($args);
				while ($my_query->have_posts()) {
					$my_query->the_post();
			?>

					<div class="related-thumb">
						<a rel="external" href="<? the_permalink() ?>">
							<?php the_post_thumbnail(array(150, 100)); ?><br />
							<?php
							openphone_entry_meta_categories();
							openphone_posted_on();
							the_title();
							?>
						</a>

					</div>
			<?php }
			}
			$post = $orig_post;
			wp_reset_query();
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
				'prev_text' => __('Newer posts', 'openphone'),
				'next_text' => __('Older posts', 'openphone'),
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
