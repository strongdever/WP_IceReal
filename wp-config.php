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
define( 'DB_NAME', 'icereal' );

/** Database username */
define( 'DB_USER', 'Lazy' );

/** Database password */
define( 'DB_PASSWORD', '1234' );

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
define( 'AUTH_KEY',         '6vB$cx/=1.CT}-%q(bI B(g)wX`SEVW&B3s,}$dKruFw=@LzJ!l+sNKc2Bwvfcj3' );
define( 'SECURE_AUTH_KEY',  '>F*QMTcaU:J|f:>VQFcztOWS87DXnjxOYD!4Ta@<Fhqq1e83i{sUG;Te0)vFEkM8' );
define( 'LOGGED_IN_KEY',    '#}3u}%#~+/X@ >]&C9HAbQ$4@C?^Dp^3DNe3cD$[jV?>i/)34?Ek^?0-ritJz-qn' );
define( 'NONCE_KEY',        'C0<Oqo@^kxlrkqkQ$<;a>hWjR;bUDp,dIO3m;^cRlx$tz #p9ZiRqU8+5:i8b@AS' );
define( 'AUTH_SALT',        '[*5z5zU_*@+qm](e/`m4-;3~,2JM#6bpBfQ`M_yYaAySU8](uHhX5RtAkZI:?5Fm' );
define( 'SECURE_AUTH_SALT', 'mvP-bNdy%V,?b5c}9DFa,9[x`>oACy2)&,:;x8UBN&&2R0bd~&@$/5lSA=PNUDh?' );
define( 'LOGGED_IN_SALT',   'K-V?lZl:M]v|`&y#6F^j2ulw+`rzLR#3e*+wk]6t4b*8-Iz)tWYiuF/`sVfxj_Ik' );
define( 'NONCE_SALT',       'ZP%S8:Q.G[Acil6_8XJ@uee+Cpv|],k`A5LYz=ef8YY!g{pjVV@K(d%PP=G!{9H}' );

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
