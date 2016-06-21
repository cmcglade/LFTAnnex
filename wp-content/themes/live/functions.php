<?php
/**
 * We define the parent theme template name in case a child theme is used 
 */
define( 'WOLF_THE_THEME', 'live' );

/** 
 * Sets up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) 
	$content_width = 745;

/**
 *  Require the core framework file to do the magic
 */
require_once get_template_directory() . '/wp-wolf-framework/wp-wolf-core.php';

/**
 * We use the Wolf_Theme class to set up the main theme structure in one single array (framework/wolf-core.php).
 * It is recommended to keep the variable name as "$wolf_theme".
 */
$wolf_theme = array(
		

	/* Menus (id => name) */
	'menus' => array(
		'primary' => 'Main Menu',
		'secondary' => 'Bottom Menu',
		),
	

	/**
	*  The thumbnails :
	*  We define wordpress thumbnail sizes that we will use in our design
	*/
	'images' => (array(
		
		/**
		*  parameters in the thumbnail array :
		*  int : max width
		*  int : max height
		*  boolean : ture/false -> hardcrop or not
		*/
		
		/*----------------------------------*
		* Default post feature image
		*/
		'default' => array(600, 800, false),
		
		/*----------------------------------*
		* Post format image
		*/
		'large' => array(750, 1000, false),

		/*----------------------------------*
		* Widget thumbnail
		*/
		'mini' => array( 80, 80, true), 

		/*----------------------------------*
		* Photo widget thumbnail
		*/
		'photo-widget-thumb' => array( 180, 180, true), 
		'photo-widget-slide' => array( 360, 360, true), 

		/*----------------------------------*
		* Album cover, video thumbnail
		*/
		'item-cover' => array(410, 280, true),

		/*----------------------------------*
		* Store thumb, release thumb
		*/
		'store-thumb' => array(410, 410, true),


		/*----------------------------------*
		* Photo thumbnail
		*/
		'photo' => array(390, 700, false),

		/*----------------------------------*
		* RSS image
		*/
		'archive-thumb' => array( 570, 400, false) 
	) ),

	/* Include helpers from the includes/helpers folder */
	'helpers' => array(
		'video-thumbnails',
		'google-fonts'
	),

	'woocommerce' => true


);
$wolf_do_theme = new Wolf_Framework( $wolf_theme );

/* Includes features */
wolf_includes_file( 'features/wolf-flexslider/wolf-flexslider.php' );
wolf_includes_file( 'features/wolf-refineslide/wolf-refineslide.php' );
wolf_includes_file( 'features/wolf-share/wolf-share.php' );
wolf_includes_file( 'widgets/custom-tabs-widget.php' );

if ( get_option( '_live_updated' ) && ! get_option( '_w_to_woocommerce' ) ) {

	wolf_includes_file( 'old-version/old-version.php' );
	
}

// Recommend plugins with TGM plugins activation
include( 'includes/admin/plugins/plugins.php' );