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
define('DB_NAME', 'wp_quyendam');

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
define('AUTH_KEY',         'El->PkQ&G~m-`6.(B ;D(||l.BI_/Fz@|@J QeDN39((5|rfK;Pa 6%-)b?XMq+L');
define('SECURE_AUTH_KEY',  ':RctXe`#dcaCPz K4L/_2D6QH>(uYufF0+M3*b8umJ5lL/+OB=eZ0$.ceT#p<*8Y');
define('LOGGED_IN_KEY',    '%-1&z>]m,h-SO1W{9~.rXMIsH=E%_NGYf/(Ui8i8EokG}ng{CL~P%]ot%0>vFqB@');
define('NONCE_KEY',        'aYSXVe!WR/EtY&B8y8<{+@34 29|+_9p1h|}E=2D#-DO|`,R,SgOmD}n#Yb._F^y');
define('AUTH_SALT',        '`m{J<lk*S+pUZC)tW:/}FB{z+}vi_vlPU|sMDKCTFr&#mD<.wW9|TL~Aagwg9GWg');
define('SECURE_AUTH_SALT', ',D`#hp#SvD0-r&(jmcmbQ`@JI9GJS`a^x?oG|T-[0|`^%t-0{#AEVIQU~q`xi{GP');
define('LOGGED_IN_SALT',   'w]]YH$HXQD-F/.<.#B&NJqiBrGBIx8kdlT|%u.-RX-xP87pN{+,B:Kyk+x`Pl+TS');
define('NONCE_SALT',       '-TmCpo-o~a3fTA?j+jSt!7}(X<wOK~YwyJ(qRHo_`r]VloV)elw]y(tLH<M_K4I)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'qd_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
