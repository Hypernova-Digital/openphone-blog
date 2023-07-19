<?php
/**
 * Template part for displaying a message when posts are not found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<section class="page-header col-span-1 md:col-span-2 lg:col-span-3 m-0 lg:mt-16">

	<header class="page-header">
		<?php if ( is_search() ) : ?>

			<h1 class="page-title m-0">
				<?php
				printf(
					/* translators: 1: search result title. 2: search term. */
					'<h1 class="page-title m-0">%1$s <span>%2$s</span></h1>',
					esc_html__( '0 results for ', 'openphone' ),
					get_search_query()
				);
				?>
			</h1>

		<?php else : ?>

			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'openphone' ); ?></h1>

		<?php endif; ?>
	</header><!-- .page-header -->

	<div <?php openphone_content_class( 'page-content' ); ?>>
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
				<?php esc_html_e( 'Your site is set to show the most recent posts on your homepage, but you haven&rsquo;t published any posts.', 'openphone' ); ?>
			</p>

			<p>
				<a href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>">
					<?php
					/* translators: 1: link to WP admin new post page. */
					esc_html_e( 'Add or publish posts', 'openphone' );
					?>
				</a>
			</p>

			<?php
		elseif ( is_search() ) :
			?>

			<div class="w-full flex flex-row justify-center mt-20 mb-56">
				<img src="<?php echo get_template_directory_uri() . '/images/EmptyGraphic.svg'; ?>" alt="404" />
			</div>

			<?php
		else :
			?>

			<p>
				<?php esc_html_e( 'No content matched your request.', 'openphone' ); ?>
			</p>

			<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->

</section>
