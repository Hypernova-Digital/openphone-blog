<?php
/**
 * Server-side rendering of the `openphone-latest-post` block.
 */

function openphone_render_latest_post_block($attributes, $content) {
    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 1,
        'post_status' => 'publish',
    ) );

    if (empty($recent_posts)) {
        return '';
    }
    
    $post = $recent_posts[0];
    ob_start();
    ?>
    <h2><?php echo get_the_title($post['ID']); ?></h2>
    <p><?php echo get_the_excerpt($post['ID']); ?></p>
	<div class="image">
            <img src="<?php echo get_the_post_thumbnail_url($post['ID']); ?>"
                alt="<?php echo get_the_title($post['ID']); ?>" />
    </div>
    <?php
    return ob_get_clean();
}
