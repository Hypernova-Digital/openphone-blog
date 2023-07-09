<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

get_header();
?>

<section id="primary">
	<main id="main" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-auto">

		<?php if (have_posts()) : ?>

			<header class="page-header col-span-1 md:col-span-2 lg:col-span-3">
				<?php the_archive_title('<h1 class="page-title mx-0">', '</h1>'); ?>
				<ul class="category-list">
					<li><a href="https://openphone.local/blog-listing/" class="">All posts</a></li>
					<?php
					$categories = get_categories(); // Retrieve all categories
					foreach ($categories as $category) {
						$active_class = (is_category($category->term_id)) ? 'active' : ''; // Check if the current category matches the looped category
						echo '<li><a href="' . get_category_link($category->term_id) . '" class="' . $active_class . '">' . $category->name . '</a></li>';
					}
					?>
				</ul>
			</header><!-- .page-header -->

		<?php
			// Start the Loop.
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content/content', 'excerpt');

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			openphone_the_posts_navigation();

		else :

			// If no content, include the "No posts found" template.
			get_template_part('template-parts/content/content', 'none');

		endif;
		?>
	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
