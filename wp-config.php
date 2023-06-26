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
define( 'DB_NAME', 'radiance-wp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'WB*3eVOzS:.jSisQDp^fo r0yb1dnvBHI}z3v4.2*sT_;|RvTM+wtS:9VR),-ceH' );
define( 'SECURE_AUTH_KEY',  'h/eHK(Y8?}E!Y?O7nqp6AU2wy4Th&jp?+;j^1Y%1c%E0cJV6*MW6:@QC~Ks@teFR' );
define( 'LOGGED_IN_KEY',    '8?@&,aRR@7LnbuSYrDr00DO~!goTfrer/)^5ox)8SW>Z:cgYHQ5lVt<Ss>+.V v5' );
define( 'NONCE_KEY',        'tyyVg|g3iH+MIsd6dp T<7F!8 <O@C9L:qF:cs@zU-1aCXrUH8/G7Yv?Ns~-$38}' );
define( 'AUTH_SALT',        'eW}t:-AV&c46E?~HH2O{nW3HOpo!gy#8(qFHx,ARQ1]Jft)_LS*Js$8dgSIWyyJz' );
define( 'SECURE_AUTH_SALT', '1]4()&O38z{lSV.iIg-KO&-,sEs_IxUoWKj)0`#z~3Dny>% L#pwhy5 %Dr^~U%4' );
define( 'LOGGED_IN_SALT',   'V)OAt%2)*|Z)+`@`<CmqcianlmJx/W Hf{H%(Kd^E>s|]x4T~Q><Fq`f?9YNL6?^' );
define( 'NONCE_SALT',       'z#;-1uVZk*t.%!!wL2z-VFt)7VDbZE?BT)EqJBl]94wV12(FnS8$sgB;_ <[^)%7' );

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
