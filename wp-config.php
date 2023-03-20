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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'argytec' );

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
define( 'AUTH_KEY',         '#=^VkAga}6FC,3t~J`%Qak@O?SJ5[`=Y=Pyllyu(2!/uRAbF4  :RD3rz#ta2nYp' );
define( 'SECURE_AUTH_KEY',  ']H78=AxITXX /sD$=avGR9hF|oo>[gn6^1P=hh__zn#V.`qhGq(--bJFQO.4FNQU' );
define( 'LOGGED_IN_KEY',    '2M{`t<P?9Oq:L1$lWSZ(I$H1mU:kOWjtH<5~]/(m$Ihy59SmXCQ^:6{-BE<*sqY1' );
define( 'NONCE_KEY',        '$E+j5KK(p)j)&$Xm~eI0TQ2U0D@1iuL(b66RrFll=IY0zu+4zl2|CcUkdFmEBWqp' );
define( 'AUTH_SALT',        'E<mN.tz?@@#v+h`^bfrSg91jUBrUGa);{=d^|4ecIE|Qx[J^3=B%A|D[<Y.<r.f&' );
define( 'SECURE_AUTH_SALT', '-CH;&8QC!n*RP]>Hb:5-pvqoK>!t3>=g7Bw0|r!-/ff.$UXYK+P_B$p=y.NWHpIE' );
define( 'LOGGED_IN_SALT',   '9iP#l$:Y7>W1WW7[te@J26iZu(ecWTAlF(2Sv&ZQWmF/~tUv,0Ac]?6]X{hLk?2U' );
define( 'NONCE_SALT',       'N@6E/.tx.v;cD:hHuT[~M18WnUzuS_~VT^(C *:gS8*vC`L/M;S]M1wp]$5pB%PL' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
