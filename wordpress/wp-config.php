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
define( 'DB_NAME', 'iammartinle');

/** MySQL database username */
define( 'DB_USER', 'root');

/** MySQL database password */
define( 'DB_PASSWORD', '123');

/** MySQL hostname */
define( 'DB_HOST', 'db:3306');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '659a44c73372f2e94aeff153e055288d3ad68fc6');
define( 'SECURE_AUTH_KEY',  '2e8c37a97925a65c357d44ee25f516a70c85902b');
define( 'LOGGED_IN_KEY',    'ed8360515aeb41cf1954c03923e3041c4865f182');
define( 'NONCE_KEY',        '3193ed665a6114d9a7fe16ed0530d7521ac6f41e');
define( 'AUTH_SALT',        'b3ff7df584f6f51e874ae8fae7c8bed8bd66e604');
define( 'SECURE_AUTH_SALT', '4f7ad1d1fb18bb1d3fbcfdde04a72eebc4711572');
define( 'LOGGED_IN_SALT',   'dd48667f47c8b806b69cfee92774c8f246cb16e5');
define( 'NONCE_SALT',       '44e4525236eaf14f1afca706e3180d4d4cbf7085');

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

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
