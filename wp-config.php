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
define( 'WP_MEMORY_LIMIT', '96M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '1_037f8f1_0');

/** MySQL database username */
//define('DB_USER', '1_037f8f1_0');
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** TR88575 */
define('FTP_HOST', 'localhost');

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
define('AUTH_KEY',         'WDSd$-q:q`)+y6uXKwNx#yW#1>5_-WNe}=M?OX!|6SK0I#]nDs-v++HV+.lBUc5V');
define('SECURE_AUTH_KEY',  '?~6XLrH*=W n{sfw>9J%-V:OLE#q+r]GLGykSOx?h$CVzar?~|g9.99-_;0KxEtL');
define('LOGGED_IN_KEY',    '<Kpm&;:5D*^vMTxFn}X(WO(z*.}G29..RMF3}MKoW=v#-5R`J4EV0r<TXq[qX-R?');
define('NONCE_KEY',        '?:J@)R-|2A~D+$Ez`GhNz-e445J=WKL4R^|r4%C@CZ@Kidmr+|QI4dt!sQ<Q&39G');
define('AUTH_SALT',        'YLmfXOGX%{Vt3qjI;_v*mcO]8wpHCFWTM8fT.B0a9Nds:OZ,C.Buu|$il*4kKM9x');
define('SECURE_AUTH_SALT', '#Z@5.QI9N:Lc9zTD@|7rga*s$xd<-+:[QL0Wk 1`+q;LK[+S:QrSZ2e5?FB|,^D}');
define('LOGGED_IN_SALT',   'eiKW4_**2yS$^YR;P&m;6#DCsTu/Uv/p0u||e~Y-P+)*|ncx(+rl?.@Hm[7{IP]-');
define('NONCE_SALT',       '?0N.3W3?86-JyjIgR[Ap+<XuBRb.^6iceGOE}G`(;Nzxd-SiMLm~y`+_CmQ%iA}$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
