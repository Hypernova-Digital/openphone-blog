<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<header id="masthead" class="">
	<div class="header-content lg:max-w-7xl px-6 py-4  lg:px-0 md:py-8 flex flex-row items-center justify-between">
		<div class="flex flex-row gap-2 items-center">
			<?php
			if (function_exists('get_custom_logo')) {
				$custom_logo_id = get_theme_mod('custom_logo');
				$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
				if (has_custom_logo()) {
					echo '<a href="https://www.openphone.com/"><img src="' . esc_url($logo[0]) . '"></a><a href="' . esc_url(home_url('/')) . '" rel="home" class="flex flex-row items-center"><h1 class="logo-and-title mt-1">' . get_bloginfo('name') . '</h1></a>';
				} else {
					echo '<a href="https://www.openphone.com/"><img src="' . esc_url($logo[0]) . '"></a><a href="' . esc_url(home_url('/')) . '" rel="home" class="flex flex-row items-center"><h1 class="logo-and-title mt-1">' . get_bloginfo('name') . '</h1></a>';
				}
			} else { ?>
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<h1 class="logo-and-title">
						<?php bloginfo('name'); ?>
					</h1>
				</a>
			<?php } ?>
		</div>

		<?php if (is_active_sidebar('header-ctas')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Header', 'openphone'); ?>" class="ml-52 lg:ml-6 header-ctas hidden md:block xl:hidden">
				<?php dynamic_sidebar('header-ctas'); ?>
			</aside>
		<?php endif; ?>

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
		</nav><!-- #site-navigation -->
	</div>

	<div class="mobile-nav">
		<button aria-controls="primary-menu" id="mobile-nav-menu-button" aria-expanded="false"><?php esc_html_e('', 'openphone'); ?></button>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'mobile-menu',
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

	<div class="scroll-progress-bar hidden">
		<div class="scroll-progress-value"></div>
	</div>
</header><!-- #masthead -->