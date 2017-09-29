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
define('DB_NAME', 'calconduit_web');

/** MySQL database username */
define('DB_USER', 'calpipe_admin');

/** MySQL database password */
define('DB_PASSWORD', 'Calpipe@webinterface');

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
define('AUTH_KEY',         'ce* &-$zVTM}4,o]gEI(cP?tNY|Q0;{K-]{#C[:1lI;kTX`@]*i}vXh`SpnNHf]b');
define('SECURE_AUTH_KEY',  'U8dTr&)zHRV|..0fCNHgq@v&)N-mg.(Xz{/f$S4r0T.@Xnt@L@JxY69YM(yC$B*7');
define('LOGGED_IN_KEY',    'K!NlPCjpKkO.-^geh(IiLe@RNl{6-zv]W<H/:<`|r+d47:2(?Q*+i%*=qe/a6Obn');
define('NONCE_KEY',        'JhP-<;|PE&U,t|`v]gWBv$~V<0QO/@)UJA3(N,b)l.%}]j*?*zv+=EX!50K)?uV.');
define('AUTH_SALT',        '9myG:CTQi+&COQHcI>+(wK.mSS3r/rll+yM7.o@?]Ab@aRF#Ff[+GRrm*S]e<*BK');
define('SECURE_AUTH_SALT', '(hAW,<^h@em~7i<=J%a)0t@S4O37Z){;p[Xk#N{7i6.{sne})JW<&+(g_8NP{!48');
define('LOGGED_IN_SALT',   'KpG#j]f?W*yhF/(]jA=iL5[];RwzIwBBHBmp;[J)fULko`wIc>I,g7<:q4ppA{x[');
define('NONCE_SALT',       'r+-?Z:fmZ)$(bhkGq6IiH=s]4ERjz^c%S_CGynzdxW*amW/]jm.C?;3@qZs~IW]n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cl_';

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
