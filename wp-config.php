<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cuahangbian' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'MuG2=BaUz~CtlZiL<p6a4aM|kv3][sI1*M7H8Yu=(^z,_+Q!^?)kjZa}|.m8ndd=' );
define( 'SECURE_AUTH_KEY',  'k+ir#O*2R|Ar![4$37~]kXVb,C!z4{[y-wm!7$uinz;}KWK6c|DRv^%ml6i%_Y&<' );
define( 'LOGGED_IN_KEY',    'YT89L9F8%.[@`r04nBC+Ofv$s5q6[G)ZfHyVaYN=ZYOKomMEuY4iRse1WPU1 _4(' );
define( 'NONCE_KEY',        'n*7MA#R%AOA{ynu*18~!S8dG0V$gxEH>2fp:Hx~d:3jGCQROOH%xa>=@|XG O4et' );
define( 'AUTH_SALT',        'ZWDX=P+c6YO3N4-udiSOh ]zD?^Nh]XkW.WtjBF:E&G~sH<~gD^@*>+KJp,qHEoZ' );
define( 'SECURE_AUTH_SALT', 'n2)yi-YC;7ih|;RpO[3eT6zJC`c*Y%--#WB;@dZ&oaHU/lG.<^M7P07E ~9/N1SH' );
define( 'LOGGED_IN_SALT',   'o>t1n=.I04_B,cPOckL-&(zt1rP kZe/>PgOt5/fj.54Z}c&m(,(P^?`0;t>9u%g' );
define( 'NONCE_SALT',       'VRE)Pys(i!lg)IUOd7O6..fm!niBm=j6_lku?frP!webR>*vU{]`jDfo==Xiv|aK' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
