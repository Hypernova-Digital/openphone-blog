<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<header id="masthead" class="bg-white">
	<div class="header-content lg:max-w-7xl px-6 py-4 md:py-8 ">
		<div>
			<?php
			if (is_front_page()) :


			?><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<h1 class="logo-and-title">
						<?php if (function_exists('the_custom_logo')) {
							the_custom_logo();
						}
						bloginfo('name'); ?></h1>
				</a>
			<?php
			else :
			?><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<p class="logo-and-title">
						<?php if (function_exists('the_custom_logo')) {
							the_custom_logo();
						}
						bloginfo('name'); ?></p>
				</a>
			<?php
			endif;

			$openphone_description = get_bloginfo('description', 'display');
			if ($openphone_description || is_customize_preview()) :
			?>
				<p><?php echo $openphone_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?></p>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'openphone'); ?>">
			<div class="desktop-nav flex items-center">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
					)
				);
				?>

				<?php if (is_active_sidebar('header-search')) : ?>
					<aside role="complementary" aria-label="<?php esc_attr_e('Header', 'openphone'); ?>" class="ml-[26px] header-search">
						<?php dynamic_sidebar('header-search'); ?>
					</aside>
				<?php endif; ?>

				<?php if (is_active_sidebar('header-ctas')) : ?>
					<aside role="complementary" aria-label="<?php esc_attr_e('Header', 'openphone'); ?>" class="ml-6 header-ctas">
						<?php dynamic_sidebar('header-ctas'); ?>
					</aside>
				<?php endif; ?>
			</div>
			<div class="mobile-nav">
				<button aria-controls="primary-menu" id="myButton" aria-expanded="false"><?php esc_html_e('', 'openphone'); ?></button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
					)
				);
				?>

				<?php if (is_active_sidebar('header-search')) : ?>
					<aside role="complementary" aria-label="<?php esc_attr_e('Header', 'openphone'); ?>" class="ml-6 header-search">
						<?php dynamic_sidebar('header-search'); ?>
					</aside>
				<?php endif; ?>

				<?php if (is_active_sidebar('header-ctas')) : ?>
					<aside role="complementary" aria-label="<?php esc_attr_e('Header', 'openphone'); ?>" class="ml-6 header-ctas">
						<?php dynamic_sidebar('header-ctas'); ?>
					</aside>
				<?php endif; ?>
			</div>
		</nav><!-- #site-navigation -->
	</div>
</header><!-- #masthead -->