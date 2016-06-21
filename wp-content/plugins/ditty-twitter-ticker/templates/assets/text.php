<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Set variables
$direct_link = (isset($_mtphr_dnt_twitter_direct_link) && $_mtphr_dnt_twitter_direct_link != '') ? true : false;
$text = mtphr_dnt_twitter_text( $mtphr_dnt_twitter_item, $mtphr_dnt_meta_data );

if( $direct_link ) {
	echo '<span style="display:'.$_mtphr_dnt_twitter_text_display.'" class="mtphr-dnt-twitter-text">'.$text.'</span>';
} else {
	echo '<span style="display:'.$_mtphr_dnt_twitter_text_display.'" class="mtphr-dnt-twitter-text">'.mtphr_dnt_twitter_links($text).'</span>';
}