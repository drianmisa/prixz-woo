<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'prixz_woo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+RU0$-N!3@:GLx{^Sl$IRVfF7+B!nzP_:[`z kw=L_1`4X,:ZDK}IO{gKwWhz&js' );
define( 'SECURE_AUTH_KEY',  'MYf,+rZ##pgltS0obnt7~r62sm[xx&yB?DyqCj8#plBB&mT`|L51?&/a`{>N22QL' );
define( 'LOGGED_IN_KEY',    'Lzo-%gabhV_Ss0:}Kwzy~7mIEDnue]/],0Iai6C~?-fDE/Iq bO6ZR=&P&^xI4Ee' );
define( 'NONCE_KEY',        'A.%%P^XtGqQ_=>h)5u`^H]XmV.YA?bde$Ush1Fe_FQB9j~Z&JI!<ZN=~<.!+7A&s' );
define( 'AUTH_SALT',        'vBFw-HH&N=fFi-])j(pC!4*N-ZaLenVy-~Vrz$CG?.US}EHA;#.kAZ6}.`1h#Yvz' );
define( 'SECURE_AUTH_SALT', 'SeEXwE7K:B7hzfAJNPA*2ICtc!VwM}r]Y6Mo^+t U)0q7}H2b&*+&:HwJ^+9@w(q' );
define( 'LOGGED_IN_SALT',   'k:yDkM;_Yhft0FO3IIor~p9!}?d?d2tkgz$6]uE^,N~^7r)SVCxGC][a3I%)x~.1' );
define( 'NONCE_SALT',       '-YEIuCqn4SI02P4QR cV6mkLPS?}|Uthdmr{ 6H+H3L71Ij``MCB^61X4gxN3t!!' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
