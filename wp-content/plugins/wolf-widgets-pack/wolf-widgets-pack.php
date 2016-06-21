<?php
/**
 * Plugin Name: Wolf Widgets Pack
 * Plugin URI: http://wpwolf.com/plugin/wolf-widgets-pack
 * Description: Some additinal widgets to improve your theme
 * Version: 1.0.2
 * Author: WpWolf
 * Author URI: http://wpwolf.com
 * Requires at least: 3.5
 * Tested up to: 4.0
 *
 * Text Domain: wolf
 * Domain Path: /lang/
 *
 * @package WolfWidgetsPack
 * @author WpWolf
 *
 * Being a free product, this plugin is distributed as-is without official support. 
 * Verified customers however, who have purchased a premium theme
 * at http://themeforest.net/user/BrutalDesign/portfolio?ref=BrutalDesign
 * will have access to support for this plugin in the forums
 * http://help.wpwolf.com/
 *
 * Copyright (C) 2014 Constantin Saguin
 * This WordPress Plugin is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * It is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * See http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Widgets_Pack' ) ) {

	class Wolf_Widgets_Pack {

		var $update_url = 'http://plugins.wpwolf.com/update';

		function __construct() {

			define( 'WOLF_WIDGETS_PACK_URL', plugins_url() . '/' . basename( dirname( __FILE__) ) );
			define( 'WOLF_WIDGETS_PACK_DIR', dirname( __FILE__ ) );

			// Load plugin text domain
			add_action( 'init', array( $this, 'plugin_textdomain' ) );

			// add widget thumbnails image sizes
			add_image_size( 'widget-thumb', 80, 80, true );

			// require widget files
			require_once( WOLF_WIDGETS_PACK_DIR . '/widgets/recent-posts-widget.php' );
			require_once( WOLF_WIDGETS_PACK_DIR . '/widgets/recent-comments-widget.php' );
			require_once( WOLF_WIDGETS_PACK_DIR . '/widgets/video-widget.php' );

			add_action( 'wp_print_styles', array( &$this, 'print_styles' ) );

			// update notification
			add_action( 'admin_init', array( &$this, 'plugin_update' ) );

		}

		// --------------------------------------------------------------------------

		/**
		 * Loads the plugin text domain for translation
		 */
		function plugin_textdomain() {

			$domain = 'wolf';
			$locale = apply_filters( 'wolf', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
			load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

		}

		// --------------------------------------------------------------------------

		/**
		 * Print Styles
		 */
		function print_styles() {
			wp_register_style( 'wolf-widgets-pack', WOLF_WIDGETS_PACK_URL.'/css/widgets.css',array(), '0.1', 'all' );
			wp_enqueue_style( 'wolf-widgets-pack' );
		}

		// --------------------------------------------------------------------------

		/**
		 * Plugin update
		 */
		function plugin_update() {
			
			$plugin_data = get_plugin_data( __FILE__ );

			$current_version = $plugin_data['Version'];
			$plugin_slug = plugin_basename( dirname( __FILE__ ) );
			$plugin_path = plugin_basename( __FILE__ );
			$remote_path = $this->update_url . '/' . $plugin_slug;
			
			if ( ! class_exists( 'Wolf_WP_Update' ) )
				include_once( 'class/class-wp-update.php' );
			
			$wolf_plugin_update = new Wolf_WP_Update( $current_version, $remote_path, $plugin_path );
		}

	}

	$wolf_widgets_pack = new Wolf_Widgets_Pack;
}


if ( ! function_exists( 'wolf_widgets_pack_sample' ) ) {
	/**
	 * Returns a sample from a string
	 */
	function wolf_widgets_pack_sample( $text, $nbcar = 200 ){   
		
		$text= strip_tags( $text );   
		
		if ( strlen( $text ) > $nbcar) {
			
			preg_match( '!.{0,'.$nbcar.'}\s!si', $text, $match );
			if ( isset( $match[0] ) )
				$str = trim( $match[0] ) . '...';
			else
				$str = $text; 

		} else {
			$str = $text;  
		}
		
		$str = preg_replace( '/\s\s+/', '', $str );
		$str = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $str );

		return $str;
	}
}