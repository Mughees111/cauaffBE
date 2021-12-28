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
define( 'DB_NAME', 'radio' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '!h=x9!`k{Owb,;CgY)DL|mp_i39Y$;uD/-uiC{(N9/n>%eFa$&Bge$/[PUxNW8|}' );
define( 'SECURE_AUTH_KEY',  ',a~tQu6wtwb3@$=UiW@gdDQ_IC*+d>+bOMRECfOezF<LZ>.k45MCZq{EYqc/g7mf' );
define( 'LOGGED_IN_KEY',    '?(j)4:Hf7N 3@&QU 4(5{P$CaTc[u{|rNhMyw1XD=3[zeVy`qN,L7LC`V&Ud$TP&' );
define( 'NONCE_KEY',        '<OJcMs|`f`j;;zq6_)Wavs=zxt=ae/>g^1a#&ShyDVL#W?}3MOn&BW8y/{Vv6QC,' );
define( 'AUTH_SALT',        'Z2IMPrAM_HXo5.Bpnf=q{-!}1ZG>fF:$QMWw[Vg`rm4@5Fqc&RQrmOQc`Yz }//;' );
define( 'SECURE_AUTH_SALT', 'lLLd=3dC(mX8<jasm_*1_103&E;i1H;I,gI8|/p-g.J/55:3Q&UIS$xf~#SujEx.' );
define( 'LOGGED_IN_SALT',   'qTjcSk(wls.a8~NNq/5-q[wd!7lw6KW%V=~U*H-GbRJV.4TaCvt1!8?2t h7T;ns' );
define( 'NONCE_SALT',       'u{UC]<zV[t0|QBizM0XP(a1=93-rv*e{wez7ZajF9}p2W12CRXH2epuE/]i?+.1s' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
