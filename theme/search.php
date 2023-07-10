<?php
/**
 * The template for displaying search results pages
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

		<?php if ( have_posts() ) : ?>

			<header class="page-header col-span-1 md:col-span-2 lg:col-span-3 m-0 lg:mt-16">
				<?php
				
				 
				printf(
					/* translators: 1: search result title. 2: search term. */
					'<h1 class="page-title m-0">' . $wp_query->found_posts . ' ' . $result . ' %1$s <span>%2$s</span></h1>',
					esc_html__( ' for: ', 'openphone' ),
					get_search_query()
				);
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			openphone_the_posts_navigation();

		else :

			// If no content is found, get the `content-none` template part.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
