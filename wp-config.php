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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '>Xa@et?h<=Z)RzwRl|V(dwC|;,XhE`gUVHBC_;K-N<r(z*/LFxSV|_x^R>->PC2c' );
define( 'SECURE_AUTH_KEY',  'sRel#>0/1!CNE~.1R+Gbn*0:omh<.(]0=K5!#B9!oXBfq Uth!xG}}O(1~G*^Og&' );
define( 'LOGGED_IN_KEY',    '?h_e?j^ES^.tBKG2c=V;JDljJP2Zqx9x86!{a1%^(Z3Y>zDIUe#qcr^R8xZBaiFW' );
define( 'NONCE_KEY',        'IB/V+?s!)$lXfK/[slVZ/985_}C}M%n]kG8R6Q*=GcJVr{TooBZx[~fA^(Pu[](t' );
define( 'AUTH_SALT',        'biQ^hYCF@^bW3-GhF !&><G:*^%9CLixOE+ept23BBs9x*jH>Fr*KJhvUVB:Sqc~' );
define( 'SECURE_AUTH_SALT', 'Mgj^D  Zc-_i}Jq,>dXVx4[!T.Z(=V!,k[/~Up*1>J_cTINquJ<OD.K7J}YcTO4t' );
define( 'LOGGED_IN_SALT',   'c0V9J7MR)u~:d0Jp)U:@8;7 gf^xI`Z+|G8@gU:.>?8#0U2E4!SDJw{,K}t/?$-f' );
define( 'NONCE_SALT',       'z]KXR=nbL#PF+e!8OD931IK3[.%U7CVobh#h05GU@VQlnQ.-C%5K%LRy+nNY9ac5' );

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
