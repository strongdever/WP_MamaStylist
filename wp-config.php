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
define( 'DB_NAME', 'mamastylist' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '~+ni4cY82c@{[xj_VzIa$nR:xtKX:erW!~E&7bE2vWiT`oiZZ uFOaZMz($L{%qb' );
define( 'SECURE_AUTH_KEY',  '8(#<f)D0{.gQi`LScQ:[1E8 o(sNJ.6w:B!_U<K(FYj#wqX7Q(tDMWP#/7/Scb>7' );
define( 'LOGGED_IN_KEY',    'fTP/3@s$N_M];x8cyju9Bbj{!r#jWm+lPZluw<GNL=G/~p!(>V[E_wV2`Glk55Gn' );
define( 'NONCE_KEY',        '3IzEpNz1Y.V{j^EMQ3{4<F9]XBD3`Eu5!r2)m0;~ntg`[1/tbc_9*9S}*RNnM|TE' );
define( 'AUTH_SALT',        ':tXx- :A{5/a3f4[/W/=^q]{prsm>THcb-ln[7Hq>vx&YA$v6[=|]f=L&)yt2G=p' );
define( 'SECURE_AUTH_SALT', 'e}Fj=$Vp,ff$6VBGVrae;:an?]DDziw/Z -hql$oP(C_6_TPX[R<UoK+[#MXvRX2' );
define( 'LOGGED_IN_SALT',   'v}BkF`_TD|*R,c23mJi<?3]TC~S]<bG>]&E &cg4pZ2[#{6JJNj$5:Z>2W3I_|Lg' );
define( 'NONCE_SALT',       'z2Y;tP1?/=3sI@HDCWV:? 7i9D|sc<2!*0 a8FDu3L%4dlr;|6of^k^SPI,Mvj4i' );

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
