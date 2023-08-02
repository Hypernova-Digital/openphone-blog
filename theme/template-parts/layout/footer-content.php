<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<section class="above-footer px-6 py-12 md:p-16 text-white bg-purple-900">
	<div class="max-w-[992px] mx-auto text-center">
		<?php if (is_active_sidebar('footer-ctas')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 text-base [&_h2]:mt-0">
				<?php dynamic_sidebar('footer-ctas'); ?>
			</aside>
		<?php endif; ?>
	</div>
</section>

<footer id="colophon" class="p-8 bg-white pt-16 lg:py-20 xl:px-0 lg:max-w-7xl mx-auto">
	<div class="footer-categories flex flex-col items-start md:flex-row justify-between mx-auto md:flex-wrap">
		<?php if (is_active_sidebar('footer-categories-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 text-base">
				<?php dynamic_sidebar('footer-categories-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0">
				<?php dynamic_sidebar('footer-categories-2'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-3')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0">
				<?php dynamic_sidebar('footer-categories-3'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-4')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0">
				<?php dynamic_sidebar('footer-categories-4'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-5')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0">
				<?php dynamic_sidebar('footer-categories-5'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-blog')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="blog-posts mb-3 md:mb-0 md:flex-grow md:flex-wrap xl:mt-0 xl:flex-grow-0">
				<?php dynamic_sidebar('footer-blog'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<hr class="bg-[rgba(0, 0, 0, 0.10)] mx-auto my-8 md:my-16 lg:max-w-7xl">

	<div class="footer-widgets-bottom flex flex-col md:flex-row justify-between mx-auto lg:max-w-7xl">
		<?php if (is_active_sidebar('footer-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="md:w-1/3 md:mr-auto">
				<?php dynamic_sidebar('footer-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="md:w-1/4 md:ml-auto mt-8 md:mt-0">
				<?php dynamic_sidebar('footer-2'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<div class="footer-tagline mx-auto mt-8 md:mt-0 text-xs opacity-60">
		<?php
		printf(
			'© ' . date("Y") . ' OpenPhone Technologies, Inc. All rights reserved.'
		);
		?>
	</div>
</footer><!-- #colophon -->
