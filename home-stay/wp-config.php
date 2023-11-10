<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'home_stay' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'vinayaka' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Y+W=` q>$K7Ls,pcxzK^p20CMXY2GJF^}d)Wt@I*0?/5+N|C(:iKynO2c7iC=-Bl' );
define( 'SECURE_AUTH_KEY',  '~3!A_8B;b~)8lW6GFO,_S=>NaRC;Z|~SxdlyB32!>5y&,G_tE/TNws<6eT0w4jm/' );
define( 'LOGGED_IN_KEY',    '+ a&vx:d-hr$_i+:tS#A9CC<dhb Wvs5K{TiZ0l|tHt-L{P%NSqfVnSRe$lJKpmi' );
define( 'NONCE_KEY',        'OhrDhLq{+;L]l|7a}S0})u0;{K:&Wg-7Y~X.)Q#7JP}JU[f]+lS@{jb)]v6>uDN?' );
define( 'AUTH_SALT',        '$=y9*afSa{ (MNyPm]S0J:h|1_%+=$yT;IRYM]|M+t<q }y^qF(I`Tz*oPF7ISJ]' );
define( 'SECURE_AUTH_SALT', '9pL)D}NM^W2nJG%~=%7q4ReKan}P=FwF4yf@)h?RrE87]ti:`?p)fP#-XcX>&vXU' );
define( 'LOGGED_IN_SALT',   'k)?[0:0P9Q{yrgeuJUXa@1qsoLF{?8~NuMK%E41UJ<yQH&T~[GdW)i9;4(mTa!t?' );
define( 'NONCE_SALT',       'GdxD|h<6XVe)xz j3]pXh:[;VlFUZm<WxNx[Vy|P^`0ZRQ:|uJ!$787fnMG~=JEo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
