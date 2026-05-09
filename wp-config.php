<?php
/**
 * The base configuration for WordPress.
 *
 * Secrets (DB credentials and auth salts) live in `wp-config-secrets.php`,
 * which is gitignored. Copy `wp-config-secrets.example.php` to
 * `wp-config-secrets.php` and fill in real values to bootstrap a new env.
 *
 * @package WordPress
 */

// ── Load secrets file if present (gitignored) ───────────────────────
if ( file_exists( __DIR__ . '/wp-config-secrets.php' ) ) {
	require_once __DIR__ . '/wp-config-secrets.php';
}

// ── Database settings ───────────────────────────────────────────────
// Env vars (set by docker-compose locally, by the hosting on prod) take
// precedence; otherwise fall back to constants from wp-config-secrets.php.
define( 'DB_NAME',     getenv('WORDPRESS_DB_NAME')     ?: ( defined('DB_NAME_FALLBACK')     ? DB_NAME_FALLBACK     : '' ) );
define( 'DB_USER',     getenv('WORDPRESS_DB_USER')     ?: ( defined('DB_USER_FALLBACK')     ? DB_USER_FALLBACK     : '' ) );
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: ( defined('DB_PASSWORD_FALLBACK') ? DB_PASSWORD_FALLBACK : '' ) );
define( 'DB_HOST',     getenv('WORDPRESS_DB_HOST')     ?: ( defined('DB_HOST_FALLBACK')     ? DB_HOST_FALLBACK     : '127.0.0.1' ) );

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ── WordPress database table prefix ─────────────────────────────────
$table_prefix = 'wp_';

// ── Debug ───────────────────────────────────────────────────────────
define( 'WP_DEBUG', false );

// ── Tunables ────────────────────────────────────────────────────────
define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

// ── Local docker overrides ──────────────────────────────────────────
// When running inside the docker stack, force URLs to localhost so
// admin/login redirects don't bounce to the production domain.
if ( getenv('WORDPRESS_DB_HOST') ) {
	if ( ! defined( 'WP_HOME' ) )    define( 'WP_HOME',    'http://localhost:8086' );
	if ( ! defined( 'WP_SITEURL' ) ) define( 'WP_SITEURL', 'http://localhost:8086' );
	if ( ! defined( 'WP_DEBUG' ) )   define( 'WP_DEBUG',   true );
}

/* That's all, stop editing! Happy publishing. */

// ── Absolute path to the WordPress directory ────────────────────────
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

// ── Sets up WordPress vars and included files ───────────────────────
require_once ABSPATH . 'wp-settings.php';
