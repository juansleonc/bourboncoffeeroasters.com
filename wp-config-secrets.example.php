<?php
/**
 * Template for wp-config-secrets.php.
 *
 * Copy this file to `wp-config-secrets.php` and fill in real values.
 * `wp-config-secrets.php` is gitignored.
 *
 * Generate fresh salts: https://api.wordpress.org/secret-key/1.1/salt/
 */

// ── Auth keys & salts ───────────────────────────────────────────────
if ( ! defined( 'AUTH_KEY' ) )          define( 'AUTH_KEY',          'put-your-unique-phrase-here' );
if ( ! defined( 'SECURE_AUTH_KEY' ) )   define( 'SECURE_AUTH_KEY',   'put-your-unique-phrase-here' );
if ( ! defined( 'LOGGED_IN_KEY' ) )     define( 'LOGGED_IN_KEY',     'put-your-unique-phrase-here' );
if ( ! defined( 'NONCE_KEY' ) )         define( 'NONCE_KEY',         'put-your-unique-phrase-here' );
if ( ! defined( 'AUTH_SALT' ) )         define( 'AUTH_SALT',         'put-your-unique-phrase-here' );
if ( ! defined( 'SECURE_AUTH_SALT' ) )  define( 'SECURE_AUTH_SALT',  'put-your-unique-phrase-here' );
if ( ! defined( 'LOGGED_IN_SALT' ) )    define( 'LOGGED_IN_SALT',    'put-your-unique-phrase-here' );
if ( ! defined( 'NONCE_SALT' ) )        define( 'NONCE_SALT',        'put-your-unique-phrase-here' );
if ( ! defined( 'WP_CACHE_KEY_SALT' ) ) define( 'WP_CACHE_KEY_SALT', 'put-your-unique-phrase-here' );

// ── DB credential fallbacks ─────────────────────────────────────────
// Used only on environments where docker/hosting env vars aren't set.
if ( ! defined( 'DB_NAME_FALLBACK' ) )     define( 'DB_NAME_FALLBACK',     '' );
if ( ! defined( 'DB_USER_FALLBACK' ) )     define( 'DB_USER_FALLBACK',     '' );
if ( ! defined( 'DB_PASSWORD_FALLBACK' ) ) define( 'DB_PASSWORD_FALLBACK', '' );
if ( ! defined( 'DB_HOST_FALLBACK' ) )     define( 'DB_HOST_FALLBACK',     '127.0.0.1' );
