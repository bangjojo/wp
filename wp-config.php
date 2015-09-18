<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'infowp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'n.M`iR#iIL&d#d^S@wLL$2==8,.CVWAr.mMx4`uc|xKCnY58UY!=`8n_vV0SH~jo');
define('SECURE_AUTH_KEY',  ' .>SAT#fNHY(rmOnss%4%u:6_G.]sn_hz*6-~#jj_/Y_+FD$OJcWy2CVFvil7~zl');
define('LOGGED_IN_KEY',    'k|Mx15r,=,b(Z>4r{IYdw.?:C2:Q]t&<u>ZC-R]e,F8%%tUspfgTB>TR)DD%N*-f');
define('NONCE_KEY',        'Da?-d*Z@V[qrNAahH_}-+LP33K>(`^|AT#oHj*WwcH*hOEb|Ykcx86 YYycEH%6S');
define('AUTH_SALT',        '0V#;dmqI`+X``:F5)~CY,!(@*%S]:2-RWPvw+jp,]Y9m6A~T>gN>MEsx3m~D27?u');
define('SECURE_AUTH_SALT', '*%>&QV^e(#?s;r~d4MqzfvV2c9^W_IG)t[>k-cDv+CzButjbI{-Wq|=>[/3B1vLx');
define('LOGGED_IN_SALT',   'F-F_ eM,^?^c!>4JdM7$q[V=lh7O0Il0[InPLo0a5VLg4_Msy{?`:l@nsB;W!8bf');
define('NONCE_SALT',       '~G )ye$@thK8Z9L-0WtiZsD|-m2`zs@Ej^?[uW?_1aO|73l<S3pTA+c+zNMp.@I>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'iw_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
