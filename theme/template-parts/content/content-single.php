<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

// Get the custom field value for header background color
$bg_color = get_post_meta(get_the_ID(), 'header_bg_color', true);

// If the custom field is empty or not set, use the default value
if (empty($bg_color)) {
    $bg_color = 'bg-purple-50';
}

$layout_option = get_post_meta(get_the_ID(), 'layout_option', true);

// If the custom field is empty or not set, use the default value
if (empty($layout_option)) {
    $layout_option = 'with-toc';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header <?php echo esc_attr($bg_color); ?>">
        <div class="header-content md:py-16 lg:max-w-7xl md:mx-auto flex flex-col-reverse md:flex-row lg:gap-16">
            <div class="header-left md:w-1/2 p-6 sm:p-8 lg:p-0 flex flex-col justify-center">
                <?php
                function custom_openphone_entry_meta_categories($post_id)
                {
                    $selected_category_name = custom_openphone_get_selected_category_name($post_id);

                    if ($selected_category_name) {
                        echo '<span class="[&_a]:text-sm sm:[&_a]:text-base lg:[&_a]:text-[19px] [&_a]:no-underline font-semibold mb-1">';
                        echo '<a href="' . esc_url(get_category_link(get_post_meta($post_id, 'selected_category', true))) . '" class="text-purple-900">' . $selected_category_name . '</a>';
                        echo '</span>';
                    } else {
                        $firstCategoryDisplayed = false;
                        $categories = get_the_category();

                        foreach ($categories as $category) {
                            if ($firstCategoryDisplayed) {
                                break;
                            }

                            echo '<span class="[&_a]:text-sm sm:[&_a]:text-base lg:[&_a]:text-[19px] [&_a]:no-underline font-semibold mb-1">';
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-purple-900">' . $category->name . '</a>';
                            echo '</span>';

                            $firstCategoryDisplayed = true;
                        }
                    }
                }

                custom_openphone_entry_meta_categories(get_the_ID());
                ?>

                <h1 class="entry-title m-0 font-semibold text-3xl sm:text-4xl md:text-6xl">
                    <?php the_title(); ?>
                </h1>

                <?php if (!is_page()) : ?>
                    <div class="entry-meta [&_span]:text-xs lg:[&_span]:text-sm [&_a]:text-xs [&_time]:text-xs lg:[&_time]:text-sm lg:[&_a]:text-sm lg:[&_time]:text-smtext-black-600 opacity-70 font-normal mt-4">
                        <?php echo do_shortcode('[rt_reading_time postfix="minute read" postfix_singular="minute read"]'); ?>
                        <span class="divider opacity-40"> | </span>
                        <?php openphone_entry_meta(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

                <div class="tags mt-4 flex flex-row gap-3">
                    <?php openphone_entry_meta_tags(); ?>
                </div>
            </div>

            <div class="header-image md:w-1/2">
                <?php // openphone_post_thumbnail( 'full' ); ?>
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"	/>
            </div>
        </div>
    </header><!-- .entry-header -->

    <div class="<?php echo esc_attr($layout_option); ?>">
        <div <?php openphone_content_class('entry-content',); ?>>
            <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers. */
                        __('Continue reading<span class="sr-only"> "%s"</span>', 'openphone'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div>' . __('Pages:', 'openphone'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-${ID} -->

<footer class="entry-footer w-full bg-[#F7F5F2]">
    <div class="lg:max-w-7xl py-12 sm:py-14 md:py-24 lg:py-28 mx-auto">
        <?php openphone_entry_footer(); ?>
    </div>
</footer><!-- .entry-footer -->
