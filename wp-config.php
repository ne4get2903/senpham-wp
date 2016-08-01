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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'Z/.&F+j6KjyWO`nUb}]fco`6l#UuOo8?=rO,5N8WBr>l>-&?_el?%mo(_*S^(&W@');
define('SECURE_AUTH_KEY',  '6Zl8Qtq3N)_S.NR92ZT>-g[AKViFCQqjnOfqr_nRfw-j0tv/AfdL^rtq&:bA$w4x');
define('LOGGED_IN_KEY',    'q/hs]:F>6Zj>EVYN#sN4{uG^&N9W%a2@<zH0y*x}-X=1(Csw$n04xId02z^0c#w@');
define('NONCE_KEY',        'L{n{tTel#+bGrye8[RzZt]pqu>G;gOx>Q[7`L= =woDtl&a-z)w84Q9K9Y_Wm_?H');
define('AUTH_SALT',        'VIDRiN.e,n:)3J^6pbr<+9HLdqnr]yQ0WjT6HgsFiSb7`~EOGPhv]8kOZjGW|c`+');
define('SECURE_AUTH_SALT', 'x/MBFFt1@yeIo/yfnrS{BA;$;2Z cn_W7%TjyPQ3)-x*JhK29{Xa]68EH{f1_kbo');
define('LOGGED_IN_SALT',   '*/io2`vge|omfF`QifG;+7z%J5R^<TpD/A[uWuR90P4s~pO3;f#,T8a:aLjx7~tG');
define('NONCE_SALT',       'T83]l+>1%U52kepJlmq}/dWlmNw(za0@_HkE>l.JB}b>0Q%OB6dKZRRvT,nH6B@*');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

