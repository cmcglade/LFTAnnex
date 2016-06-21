<?php

/* --------------------------------------------------------- */
/* !Auto updater script - 2.0.0 */
/* --------------------------------------------------------- */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'http://www.metaphorcreations.com/envato/plugins/ditty-twitter-ticker/auto-update.json',
    MTPHR_DNT_TWITTER_DIR.'ditty-twitter-ticker.php'
);



/* --------------------------------------------------------- */
/* !Update site options - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_twitter_update() {

	$latest_version = get_option( 'mtphr_dnt_twitter_version', '1.0.0' );
	
	// Version 2.0.0
	if( version_compare($latest_version, '2.0.0', '<') ) {
		mtphr_dnt_twitter_update_2_0_0();
		update_option( 'mtphr_dnt_twitter_version', '2.0.0' ); 
	}
}
add_action( 'init', 'mtphr_dnt_twitter_update' );



/* --------------------------------------------------------- */
/* !Version update - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_twitter_update_2_0_0() {
	
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'ditty_news_ticker',
		'post_status' => 'any'
	);
	$twitter = get_posts( $args );
	if( is_array($twitter) && count($twitter) > 0 ) {
		foreach( $twitter as $i=>$post ) {
			
			// Check for old display meta
			$display_order = get_post_meta( $post->ID, '_mtphr_dnt_twitter_display_order', true );
			if( is_array($display_order) && in_array('text', $display_order) ) {
				
				$deprecated = array(
					'avatar' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar', true ),
					'name' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_name', true ),
					'time' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_time', true ),
					'text' => 'on',
					'links' => 'off'
				);
				
				// Setup the new display meta
				$display_update = array();
				if( is_array($display_order) && count($display_order) > 0 ) {
					foreach( $display_order as $item ) {
						$display_update[$item] = ($deprecated[$item] == '1' || $deprecated[$item] == 'on') ? 'on' : 'off';
					}
				}
				
				// Check for any links that are enabled
				$links = get_post_meta( $post->ID, '_mtphr_dnt_twitter_links', true );
				if( is_array($links) && count($links) > 0 ) {
					foreach( $links as $i=>$link ) {
						if( $link != '' ) {
							$display_update['links'] = 'on';
						}
					}
				}
				
				// Update the post meta
				update_post_meta( $post->ID, '_mtphr_dnt_twitter_display_order', $display_update );
				
				// Delete old post meta
				delete_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar' );
				delete_post_meta( $post->ID, '_mtphr_dnt_twitter_name' );
				delete_post_meta( $post->ID, '_mtphr_dnt_twitter_time' );
			}
		}
	}
}