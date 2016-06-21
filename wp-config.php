<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'youandm1_LFTAnnex');

/** MySQL database username */
define('DB_USER', 'youandm1_LFTA');

/** MySQL database password */
define('DB_PASSWORD', 'Plxn2011!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~|T``Xk19(L/R52cs^Sap#P79kg?R5|lb(@cOq%H3KNu7@lmz%2N7Kd4aL*h+R&w');
define('SECURE_AUTH_KEY',  '4Y4sE;aV|l_;2H&GEX|VXt/IY`l1+gg_0j&:5tGJw+?ib+&j;Nkei_~Re1H4_f^s');
define('LOGGED_IN_KEY',    'SN9T:;B"3a|ShdvjRHf"Cn@?1@TEd~yRrfl"+;m^kBM54S?+c@n23q60GtSy"?g/');
define('NONCE_KEY',        '4dEAo%v#Lrg2AY?8dfreEt:8Y4I!Z$Nk4K3V!tkgf~2^ZnCo@w#lR0(Lo/UJi5nU');
define('AUTH_SALT',        'nV;NT3NlR7*c(k7~o#0B&^3(Q8qsqSU|C3HH6Z6hcVS:N&/Uy^WyZq*BoYYUQ4Qn');
define('SECURE_AUTH_SALT', 'P?2cP?lgkj*h!in;S*OlD@ba1IuL6SF2zudCM_Wexq&YB~|/A&dB5o`YXp"K0j96');
define('LOGGED_IN_SALT',   'O~I$k!rnw$0GDe8a!/yP^0tO&!@7NioRql+RGrr8Eq!wZVMS9%hJq_*e8@$5N:rU');
define('NONCE_SALT',       '!FGMeP"y?^Adzjn&;1Gty~*WKUiVTzrdW3UZarT3mx`L#vJFCiTK8bvThWyxjFg"');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_678662_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

