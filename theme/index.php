<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

get_header();
?>

<section id="primary" class="">
	<main id="main" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-auto">

		<?php
		if (have_posts()) {

			if (is_home() && !is_front_page()) :
		?>
				<header class="entry-header col-span-1 md:col-span-2 lg:col-span-3">
					<h1 class="entry-title mx-0"><?php single_post_title(); ?></h1>
					<ul class="category-list">
						<li><a href="https://openphone.local/blog-listing/" class="all-posts">All posts</a></li>
						<?php
						$categories = get_categories(); // Retrieve all categories
						foreach ($categories as $category) {
							$active_class = (is_category($category->term_id)) ? 'active' : ''; // Check if the current category matches the looped category
							echo '<li><a href="' . get_category_link($category->term_id) . '" class="' . $active_class . '">' . $category->name . '</a></li>';
						}
						?>
					</ul>
				</header><!-- .entry-header -->
		<?php
			endif;

			// Load posts loop.
			while (have_posts()) {
				the_post();
				get_template_part('template-parts/content/content-excerpt');
			}

			// Previous/next page navigation.
			openphone_the_posts_navigation();
		} else {

			// If no content, include the "No posts found" template.
			get_template_part('template-parts/content/content', 'none');
		}
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
