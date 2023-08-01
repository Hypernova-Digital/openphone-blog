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

<script>
	jQuery(document).on('facetwp-loaded', function() {
		// Extract the category from the URL
		const urlParams = new URLSearchParams(window.location.search);
		const category = urlParams.get('_categories');

		// If a category is selected, update the title
		if (category) {
			jQuery('header.entry-header h1.entry-title').text(decodeURIComponent(category));
		} else {
			// If no category is selected, set the title back to "All Posts"
			jQuery('header.entry-header h1.entry-title').text('All Posts');
		}
	});
</script>

<section id="primary" class="">
	<main id="main" class="max-w-7xl mx-auto px-8 md:px-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-auto mb-10">


		<?php
		if (have_posts()) {

		?>
			<header class="entry-header col-span-1 md:col-span-2 lg:col-span-3">
				<h1 class="entry-title mx-0  lg:text-[90px] mt-20 mb-8 lg:h-20 leading-[1] capitalize max-w-max"><?php echo openphone_get_the_archive_title(); ?></h1>
				<!-- <h1 class="entry-title mx-0"><?php // echo openphone_get_the_archive_title(); ?></h1> -->
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

			?>
			<div class="col-span-1 md:col-span-2 lg:col-span-3">
				<?php //echo do_shortcode('[facetwp facet="categories"]'); 
				?>
			</div>
			<!--fwp-loop-->
		<?php
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
