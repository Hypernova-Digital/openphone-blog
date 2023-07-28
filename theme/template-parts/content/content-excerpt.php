<?php

/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<article id="post-<?php the_ID(); ?>" class="related-thumb grid-cols-1 rounded-md border-[1px] border-black border-opacity-10 overflow-hidden bg-white hover:border-opacity-100 cursor-pointer hover:shadow-default">
	<a href="<?php the_permalink(); ?>" rel="bookmark norewrite" title="<?php the_title_attribute(); ?>">
		<div class="[&_img]:w-full lg:[&_img]:h-60 [&_img]:object-cover"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" /></div>

		<div class="p-4">
			<span class="[&_a]:text-sm"><?php openphone_entry_meta_categories(); ?></span>

			<span class="divider opacity-10"> | </span>

			<span class="posted-on opacity-70 [&_a]:font-light text-sm [&_time]:text-sm"><?php openphone_posted_on(); ?></span>

			<?php the_title('<span class="related-post-title block text-sm font-semibold [&_strong]:font-semibold md:text-xl lg:text-[23px] mt-2"> ', '</span>'); ?>
		</div>
	</a>
</article><!-- #post-${ID} -->