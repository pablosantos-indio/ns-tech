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
define( 'DB_NAME', 'wp_nstech' ); 

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
define( 'AUTH_KEY',         '?=f}qDs/,B-[`E>zeUEMen vfoA(E~f&<l]D^bI~;hAwIw4z~2,0tT qm|GjI@f$' );
define( 'SECURE_AUTH_KEY',  'x5XZlDky$86C@EE#<L~^ygoUdpOPeut7[eE/$_D $)Gs=,7KZR%zV5K:(Y^{K,ON' );
define( 'LOGGED_IN_KEY',    'ukW+EwLPlC.ufL+NvKtE@&%]5GL(V(7&I;[.$VTt]JTrgLF)7H.qx `d.`<HPjy-' );
define( 'NONCE_KEY',        '{])ufh-J103=aUl}<;yJ?4Um%QZ_x;-$Nii;eV{&NqfDX7?r2#,OpU:0gOj]{cOH' );
define( 'AUTH_SALT',        't!>XI~bPjb+D(0| ?E`^DJY!l|5%mQ8(z01FV6_Q8SZnAdaA|M }8j^QNj!^nC#]' );
define( 'SECURE_AUTH_SALT', '_JaB`&?r #^ZIg97z3yV#5fbzQxgWChjYO]RjuAg<gWRrclWmL%a*C&2xB[CuV%|' );
define( 'LOGGED_IN_SALT',   'v,pslBgRH/KhIh0#?eT @AZl{A7YAiw/-tBQ1S Z70,,K=Q@M*_y/#&STt.Nr}9}' );
define( 'NONCE_SALT',       '{26>*{XOe@a^GvlQ;wiaN>~U{kfWfvs=}TeE#`(I,=cB6^A 9c}<](M&W[_aV[<k' );

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
