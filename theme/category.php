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
    <header class="entry-header bg-purple-50 flex flex-col py-16 mb-16 text-center">
        <div class="header-left p-6 sm:p-8 lg:p-0 flex flex-col justify-center mx-auto max-w-7xl">
            <?php the_archive_title('<h1 class="page-title mx-0 text-5xl lg:text-[90px] font-semibold leading-[1] tracking-[-1.8px] text-center block w-full">', '</h1>'); ?>
            <?php the_archive_description('<span class="block text-center opacity-70 text-sm font-normal leading-[1.5]">', '</span>'); ?>
        </div>
    </header>
	<main id="main" class="gap-12 [&_article]:mb-6  max-w-7xl mx-auto flex flex-col md:flex-row flex-wrap justify-between mb-10 px-6 lg:px-0">

		<?php if (have_posts()) : ?>

		<?php
			// Start the Loop.
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content/content', 'excerpt-category');

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
