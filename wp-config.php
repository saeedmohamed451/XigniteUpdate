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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'd0274b32');

/** MySQL database username */
define('DB_USER', 'd0274b32');

/** MySQL database password */
define('DB_PASSWORD', 'meineliebe123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'st$?CaYWs.glCi?/ROi-ZC/ixz+{_OIEi$kx 6FW0%J,7as8&=c!LCW<#]/tT>Cx');
define('SECURE_AUTH_KEY',  'kE`)@9;5tW+n8i$ wL!ckf0Cb~p[)|cFh4`GS6UFEuxvPnOie nn=-huC}h(]WJb');
define('LOGGED_IN_KEY',    'eL-ZI4;b>`HB;/k~Z_Um6I~/ZmY[;:h#8w~cZ-q+|P:x0y|I8&<T4recV9YE8=g2');
define('NONCE_KEY',        'b/e!(q~lQj^lK5u:.,&+Y72cF<[.X3MlP[8+Aq%XvopRO|u,q7qjtVn;X6.T&.*o');
define('AUTH_SALT',        '79,T$8=?MI9e$G!S3%cS[0KgF,82Z3U,iU{9~yEbRH-66ES8%(~X/k<,%r_9o:x}');
define('SECURE_AUTH_SALT', '>&-{^A7_ ,ZfBe%4fI/@gzS9[eQHXPj &1xmw$X2=aZ,}[S?{g{;-w)+~,&HB40w');
define('LOGGED_IN_SALT',   '_<BiF({Yn[WNuKEUPd>$8I}so|-:6p+b>{gnz:}6M3Kx#Of22# XyqCM1)NTgrfn');
define('NONCE_SALT',       '=0} 8/7]~T{CR7M0eR`Uc-)Fh4Q~gEr<G<xMV/./3a`:EBx`!0={eQvS3aH^3B}V');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
