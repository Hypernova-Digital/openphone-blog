<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<footer id="colophon" class="container mx-auto">
	<div class="footer-categories flex flex-col items-center md:items-start md:flex-row justify-between">
		<?php if (is_active_sidebar('footer-categories-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-categories-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-categories-2'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-3')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-categories-3'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-4')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-categories-4'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-categories-5')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-categories-5'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<div class="footer-widgets-bottom flex flex-col md:flex-row justify-between">
		<?php if (is_active_sidebar('footer-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (is_active_sidebar('footer-2')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'openphone'); ?>">
				<?php dynamic_sidebar('footer-2'); ?>
			</aside>
		<?php endif; ?>

		<?php if (has_nav_menu('menu-2')) : ?>
			<nav aria-label="<?php esc_attr_e('Footer Menu', 'openphone'); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>
		<?php endif; ?>
	</div>

	<div class="footer-tagline">
		<?php
		$openphone_blog_info = get_bloginfo('name');
		if (!empty($openphone_blog_info)) :
		?>
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>,
		<?php
		endif;

		/* translators: 1: WordPress link, 2: WordPress. */
		printf(
			'© 2022 OpenPhone Technologies, Inc. All rights reserved.'
		);
		?>
	</div>
</footer><!-- #colophon -->