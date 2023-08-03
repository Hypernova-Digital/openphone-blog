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


 ?>
<div class="">
 <?php
get_header();
?>

<section id="primary" class="bg-white">
    <header class="entry-header bg-purple-50 flex flex-col py-16 mb-16 text-center">
        <div class="header-left p-6 sm:p-8 lg:p-0 flex flex-col justify-center mx-auto max-w-7xl">
            <?php the_title('<h1 class="page-title mx-0 text-5xl lg:text-[90px] font-semibold leading-[1] tracking-[-1.8px] text-center block w-full">', '</h1>'); ?>
            <?php echo '<p class="page-tagline">' . get_post_meta(get_the_ID(), 'tagline', true) . '</p>'; ?>
        </div>
    </header>

    <main id="main" class="container lg:w-[922px] mx-auto pb-12 px-6 md:py-16 lg:py-24">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Display the tagline

                // Display the page content
                the_content();

                // If comments are open, or we have at least one comment, load the comment template.
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
            endwhile;
        endif;
        ?>
    </main>
</section><!-- #primary -->

<?php get_footer(); ?>

</div>