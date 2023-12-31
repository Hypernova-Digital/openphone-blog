<?php
/**
 * The template for displaying search page
 * Template Name: Search Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package OpenPhone
 */
global $wp_query;
if($wp_query->found_posts < 2) {
    $result = 'result';
  } else {
    $result = 'results';
  }
    // echo $wp_query->found_posts . " " . $result . " found.";
get_header();
?>

	<section id="primary">
		<main id="main" class="related-posts-after-content grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-12 px-8 lg:px-0 max-w-7xl lg:mx-auto">
			<header class="page-header col-span-1 md:col-span-2 lg:col-span-3 mt-6 mb-32 lg:mt-12">
                <img src="<?php echo get_template_directory_uri(); ?>/images/search-graphic.svg" alt="" class="w-full md:w-96 mx-auto">

				<?php
				the_title( '<h1 class="page-title text-center my-6 mx-auto text-[40px] lg:text-[60px]  font-semibold leading-[1] tracking-[-0.8px]">', '</h1>' );

               echo do_shortcode('[ivory-search id="20303" title="Custom Search Form"]');
				?>
			</header><!-- .page-header -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
