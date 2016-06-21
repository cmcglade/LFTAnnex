<?php
/*
Plugin Name: Ditty Twitter Ticker
Plugin URI: http://dittynewsticker.com/ditty-twitter-ticker/
Description: Add a twitter ticker type to your <a href="http://wordpress.org/extend/plugins/ditty-news-ticker/">Ditty News Tickers</a>. Display twitter feeds in a ticker, rotator, or list.
Text Domain: ditty-twitter-ticker
Domain Path: languages
Version: 2.0.2
Author: Metaphor Creations
Author URI: http://www.metaphorcreations.com
Contributors: metaphorcreations
License: GPL2
*/

/*
Copyright 2012 Metaphor Creations  (email : joe@metaphorcreations.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/* --------------------------------------------------------- */
/* !Define constants - 2.0.2 */
/* --------------------------------------------------------- */

define ( 'MTPHR_DNT_TWITTER_VERSION', '2.0.2' );
define ( 'MTPHR_DNT_TWITTER_DIR', trailingslashit(plugin_dir_path(__FILE__)) );
define ( 'MTPHR_DNT_TWITTER_URL', trailingslashit(plugins_url()).'ditty-twitter-ticker/' );


	
/* --------------------------------------------------------- */
/* !Include files - 2.0.0 */
/* --------------------------------------------------------- */

require_once( MTPHR_DNT_TWITTER_DIR.'includes/activate.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/update.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/scripts.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/filters.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/helpers.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/functions.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/settings.php' );
require_once( MTPHR_DNT_TWITTER_DIR.'includes/templates.php' );

if( is_admin() ) {
	require_once( MTPHR_DNT_TWITTER_DIR.'includes/admin/scripts.php' );
	require_once( MTPHR_DNT_TWITTER_DIR.'includes/admin/helpers.php' );
	require_once( MTPHR_DNT_TWITTER_DIR.'includes/admin/meta-boxes.php' );
	require_once( MTPHR_DNT_TWITTER_DIR.'includes/admin/notices.php' );
}