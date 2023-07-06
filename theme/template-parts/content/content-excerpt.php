<?php

/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php openphone_post_thumbnail(); ?>
	<header class="entry-header p-6 ">
		<span class="[&_a]:text-sm"><?php openphone_entry_meta_categories(); ?></span>
		<span class="divider opacity-40"> | </span>
		<span class="[&_time]:text-sm [&_time]:opacity-70"><?php openphone_posted_on(); ?></span>

		<?php
		if (is_sticky() && is_home() && !is_paged()) {
			printf('%s', esc_html_x('Featured', 'post', 'openphone'));
		}
		the_title(sprintf('<h2 class="entry-title leading-3 mb-0"><a href="%s" rel="bookmark" class="text-xl">', esc_url(get_permalink())), '</a></h2>');
		?>
	</header><!-- .entry-header -->
</article><!-- #post-${ID} -->