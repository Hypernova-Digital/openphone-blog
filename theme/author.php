<?php

/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

get_header();

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<section id="primary" class="px-8 ">
    <main id="main" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-auto pb-14">
        <header class="page-header col-span-1 md:col-span-2 lg:col-span-3 flex flex-col-reverse md:flex-row md:gap-6 my-14 lg:my-[72px]">
            <div class="author-info md:w-2/3">
                <h1 class="author-name text-6xl lg:text-[90px] font-semibold leading-[1] tracking-[-1.8px] mb-4 md:mb-6 text-black"><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h1>
                <span class="author-bio opacity-70 text-sm lg:text-[19px] font-normal leading-[1.4]"><?php echo $curauth->user_description; ?></span>
            </div>
            <div class="author-photo md:w-1/3 flex md:justify-end items-center">
                <div class="author-photo-frame">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/author-icon.svg" alt="" width="170" class="author-photo-icon">
                    <div class="author-photo-image"><img src="<?php echo esc_url(get_avatar_url($curauth->ID)); ?>" alt="" width="170"></div>
                </div>
            </div>
        </header><!-- .page-header -->
        <!-- The Loop -->

        <?php if (have_posts()) : ?>
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
