<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OpenPhone
 */

get_header();

// Get the selected background color from the custom meta box
$bg_color = get_post_meta(get_the_ID(), 'header_bg_color', true);

if (empty($bg_color)) {
    $bg_color = 'bg-purple-900';
}

// Pass the background color as a variable to the header
get_header('custom', array('header_bg_color' => $bg_color));
?>

<section id="primary">
    <main id="main">

        <?php
        /* Start the Loop */
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content/content', 'single');

            if (is_singular('post')) {
                // Previous/next post navigation.
                the_post_navigation(
                    array(
                        'next_text' => '<span aria-hidden="true">' . __('Next Post', 'openphone') . '</span> ' .
                            '<span class="sr-only">' . __('Next post:', 'openphone') . '</span> <br/>' .
                            '<span>%title</span>',
                        'prev_text' => '<span aria-hidden="true">' . __('Previous Post', 'openphone') . '</span> ' .
                            '<span class="sr-only">' . __('Previous post:', 'openphone') . '</span> <br/>' .
                            '<span>%title</span>',
                    )
                );
            }

            // If comments are open, or we have at least one comment, load
            // the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

            // End the loop.
        endwhile;
        ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
