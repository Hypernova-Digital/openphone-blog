<?php
/**
 * Template part for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		// if ( ! is_front_page() ) {
		// 	the_title( '<h1 class="entry-title">', '</h1>' );
		// } else {
		// 	the_title( '<h2 class="entry-title">', '</h2>' );
		// }
		?>
	</header><!-- .entry-header -->

	<?php openphone_post_thumbnail(); ?>

	<div <?php openphone_content_class( 'entry-content overflow-hidden' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'openphone' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
