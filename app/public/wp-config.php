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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rq8G2+FzB327KiU4YgozNCJ1W/7YzTk7Mdcc9X1C/nzy4Dgx062469lsjnIg1xMx6KhgRqBVqSL2UH85Rtta3Q==');
define('SECURE_AUTH_KEY',  'Dj8sqRLt22nrRATcS6nvhlIfp6DXa3rUJNWkNzhN7OhdpVuWuY5Befixfgzrm6ONJFfec/f/B6wy5V2o4SNVPQ==');
define('LOGGED_IN_KEY',    'Skegi9zGJ6KsOV9F/uYIJ/29g3ZUVPm/FFCvpaK+IgpeMFg3BkL9j8SH5cKANhJQWFsNjZJci6/80Pi1H98rPQ==');
define('NONCE_KEY',        'x4ODNpAddHOapsO1Rm1e3WNBBlDx29yQ3iUEvgy28UalOJ3iOy/zanDVh2vH+YTPyDtMPQGaIf49bRhPBfXQQg==');
define('AUTH_SALT',        'ItoGlLY7/0FCe56OkxFbNZJqS1PHk3no4FMgZHNXJRI/fpPgGa9SDU/KsUDehT+6m8gIlTYsXDzM/tkS4rEieQ==');
define('SECURE_AUTH_SALT', '3+gxSijAtyjr70gu/2yCBwKx20f0clKQGeq20HXpcFGbCAK5dZZFTwFlGev8W9OygvXRIbVdd0kwxGD3tAeUTQ==');
define('LOGGED_IN_SALT',   '2F+efAPkNiTKhfK242mYMZ+nSXh5TYzYiU9BTYNeq/XyHrW7XbN2LLNxEpAJs3vRFbcKhO7S2vK+ux93w2chJQ==');
define('NONCE_SALT',       'mevXWmVH/H51K2Zc270XWqUyUJglkrCmBgiG2NY04e2kLZNb8H6RPSzImVuI85PBZikT+1swj9iuX4J8X7Qq8g==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
