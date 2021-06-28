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
define('AUTH_KEY',         'VwJZxgbp2IxkmkUBF7lyG3YACHPHcKdNmRZGJK+Blm6isKxT/6ErOdSLEZbkRRwfLzsEmWx/bxfZ9pZeu36ILw==');
define('SECURE_AUTH_KEY',  'zOL0vx2J7PPwZpGQbPE21M6zlKZc7lbUlEgZ2KNcPIzL7pyYTxX7z2UQ2o6VkpBVgFRlKezByTnBeKOFB7eKYA==');
define('LOGGED_IN_KEY',    'ASBcpMwPLpF6zc1y1qhWI/lY9rwyddSlKL8SqK7ON6VbGXPM2GNdB9+Tiob8kT4uXqoMgr2nF2ID7aYOKDF9XA==');
define('NONCE_KEY',        '5NLeyH7bK0gK/6QQTwnWokhxX4UZibLyCVZgWFNZNabpjF573Pqkuc5NDhugSmBw3eyLleYyJzJ9akmwqiXjUg==');
define('AUTH_SALT',        'qZzj6Aet5KEsTFJ7RdvLMZe9b660Y2gEMQf68Tuq9mPd0/UmSE36J7Ywc+bNSfXyY/vO3oHp53wg+smaASdbJA==');
define('SECURE_AUTH_SALT', 'KdA9u0shQYGAQBnSBdRMMyWnfBuJ/K9/MTERrF8aCY8265934asKBc2B1d249lkPkgDMTZ2JkbYs0SqwOfAS5g==');
define('LOGGED_IN_SALT',   'tIHywk+pQ2WmsQE4n8wUtI31q33DczGDteg3gVe4KaFwod35zk2vfP2eUkdZ6fopJR86VSePbndJLKjuSzTdiQ==');
define('NONCE_SALT',       'eYuOmoEVs5UqQZ+G88GmZsmiWNB/Q19X+VH6eVRwCssHJoSLkhAVdj50IZnMSLoDkmu7UuejfTyDX98Y25B9pg==');

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
