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
	<div class="container max-w-[992px] mx-auto text-center">
		<?php if (is_active_sidebar('footer-ctas')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 text-base">
				<?php dynamic_sidebar('footer-ctas'); ?>
			</aside>
		<?php endif; ?>
	</div>
</section>

<footer id="colophon" class="p-8 bg-[#F7F5F2] pt-16">
	<div class="footer-categories flex flex-col items-start md:flex-row justify-between container mx-auto md:flex-wrap">
		<?php if (is_active_sidebar('footer-categories-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 text-base">
				<?php dynamic_sidebar('footer-categories-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0 ">
				<?php dynamic_sidebar('footer-categories-2'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-3')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0 ">
				<?php dynamic_sidebar('footer-categories-3'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-4')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0 ">
				<?php dynamic_sidebar('footer-categories-4'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-5')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0 ">
				<?php dynamic_sidebar('footer-categories-5'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-blog')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="mb-3 md:mb-0 md:flex-grow md:mt-8 lg:mt-0 lg:flex-grow-0">
				<?php dynamic_sidebar('footer-blog'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<hr class="bg-[rgba(0, 0, 0, 0.10)] container mx-auto my-8 md:my-16">

	<div class="footer-widgets-bottom flex flex-col md:flex-row justify-between container mx-auto">
		<?php if (is_active_sidebar('footer-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="md:w-1/3 md:mr-auto">
				<?php dynamic_sidebar('footer-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>" class="md:w-1/3 md:ml-auto mt-8 md:mt-0">
				<?php dynamic_sidebar('footer-2'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<div class="footer-tagline container mx-auto mt-8 md:mt-0 text-xs">
		<?php
		$openphone_blog_info = get_bloginfo('name');
		if (!empty($openphone_blog_info)) :
		?>
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-xs"><?php bloginfo('name'); ?></a>,
		<?php
		endif;

		/* translators: 1: WordPress link, 2: WordPress. */
		printf(
			'© 2022 OpenPhone Technologies, Inc. All rights reserved.'
		);
		?>
	</div>
</footer><!-- #colophon -->