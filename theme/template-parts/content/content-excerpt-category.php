<?php

/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OpenPhone
 */

?>

<article id="post-<?php the_ID(); ?>" class="related-thumb w-full md:w-[48%] rounded-md border-[1px] border-black border-opacity-10 overflow-hidden bg-white">
	<a href="<?php the_permalink(); ?>" rel="bookmark norewrite" title="<?php the_title_attribute(); ?>">
		<div class="[&_img]:w-full"><?php openphone_post_thumbnail(); ?></div>
		<div class="p-4">
			<span class="[&_a]:text-sm"><?php openphone_entry_meta_categories(); ?></span>

			<span class="divider opacity-10"> | </span>

			<span class="posted-on opacity-70 [&_a]:font-light text-sm [&_time]:text-sm"><?php openphone_posted_on(); ?></span>

			<?php the_title( '<span class="related-post-title block text-sm font-semibold md:text-xl lg:text-[23px] mt-2"> ', '</span>' );?>
		</div>
	</a>
</article><!-- #post-${ID} -->