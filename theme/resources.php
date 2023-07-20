<?php

/**
 * The template for displaying the resources page
 * 
 * Template Name: Resources Page
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
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
            <?php the_title('<h1 class="page-title mx-0 text-5xl lg:text-[90px] font-semibold leading-[1] tracking-[-1.8px] text-center block w-full">', '</h1>'); ?>
        </div>
    </header>
    <main id="main">

        <?php

        /* Start the Loop */
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content/content', 'home');

            // If comments are open, or we have at least one comment, load
            // the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
