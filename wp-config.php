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
define('DB_NAME', 'lacunadesign');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '{lc4>e<03g9*Tx9PVxXbY;BkF8sKjJ.%Fd!H|Yk,U-T++IeU{Xx(|]P{>pZ|W#95');
define('SECURE_AUTH_KEY',  ',wG+}fTfF/#Z-O 8YND<Xv#aq}H*r8Aq&^rvmpsR@3ggVk([yw#~-2M*s5Q30v@:');
define('LOGGED_IN_KEY',    'Y#Cvo=-,vYi:Hx&Lzo%aWF!-dZs;!ntD5vcc2!r6ewzJc|&CL(+Kd[D.R[Y,2>()');
define('NONCE_KEY',        'be`2c-Ub06rkc(h#R$ m3-]tEG<wIQ`#),Ddz(xR!=JhemAA<n#p,+^2e)B*-u0d');
define('AUTH_SALT',        'dW5,o}`0Jy>o5g?|jF-8~XWm^8$w!8-0,^W_+&qBZ#11Hjy+|pY-i+phe,, )8pI');
define('SECURE_AUTH_SALT', ']7C8_7Z=r_LTvdV$03YKfc;9[.73.}H9$&m`7lcKB?+J?w!1]og<$ Ll`m-Q&Gx2');
define('LOGGED_IN_SALT',   '`B-s+lF|v7(O@xi3`5D&Hk+Mv,j><%ay^1WHq!8b@.0A&l)b+tQ]~O_XuYp<e^gL');
define('NONCE_SALT',       '$};nIY)P!fdO7R*EeVU,sGQP:nhzCiX#uY+#U1S|VvI?!<*jIm6Z>|YV$*%Jz?51');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lacunadesign_';

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
