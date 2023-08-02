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
	<main id="main" class="max-w-7xl mx-auto px-8 xl:px-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-auto mb-10">


		<?php
		if (have_posts()) {

			if (is_home() && !is_front_page()) :
		?>
				<header class="entry-header col-span-1 md:col-span-2 lg:col-span-3">
					<h1 class="entry-title mx-0  lg:text-[90px] mt-20 mb-8 lg:h-20 leading-[1] capitalize max-w-max"><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->
			<?php
			endif;

			?>
			<div class="col-span-1 md:col-span-2 lg:col-span-3">
				<?php echo do_shortcode('[facetwp facet="categories"]'); ?>
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
