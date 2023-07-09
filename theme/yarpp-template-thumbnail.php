<?php
/*
YARPP Template: Thumbnails
Description: This template returns the related posts as thumbnails in an ordered list. Requires a theme which supports post thumbnails.
Author: YARPP Team
*/
?>

<?php
/*
Templating in YARPP enables developers to uber-customize their YARPP display using PHP and template tags.

The tags we use in YARPP templates are the same as the template tags used in any WordPress template. In fact, any WordPress template tag will work in the YARPP Loop. You can use these template tags to display the excerpt, the post date, the comment count, or even some custom metadata. In addition, template tags from other plugins will also work.

If you've ever had to tweak or build a WordPress theme before, you’ll immediately feel at home.

// Special template tags which only work within a YARPP Loop:

1. the_score()		// this will print the YARPP match score of that particular related post
2. get_the_score()		// or return the YARPP match score of that particular related post

Notes:
1. If you would like Pinterest not to save an image, add `data-pin-nopin="true"` to the img tag.

*/
?>
<?php if (have_posts()) : ?>
		<?php
		while (have_posts()) :
			the_post();
		?>
			<?php if (has_post_thumbnail()) : ?>
				<div class="related-thumb grid-cols-1 lg:row-start-2 rounded-md border-[1px] border-black border-opacity-10 overflow-hidden bg-white">
					<a href="<?php the_permalink(); ?>" rel="bookmark norewrite" title="<?php the_title_attribute(); ?>">
						<div class="[&_img]:w-full"><?php openphone_post_thumbnail(); ?></div>

						<div class="p-4">
							<?php openphone_entry_meta_categories(); ?>
							<span class="divider opacity-10"> | </span>
							<span class="opacity-70 [&_a]:font-light text-sm"><?php openphone_posted_on(); ?></span>
							<span class="related-post-title block text-base font-semibold md:text-xl lg:text-[23px] mt-2"> <?php the_title(); ?></span>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>

<?php else : ?>
	<p>No related photos.</p>
<?php endif; ?>