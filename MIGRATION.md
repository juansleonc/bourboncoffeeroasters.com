# Migración bourboncoffeesip.com → bourboncoffeeroasters.com

## Entorno local (Docker)

```bash
docker compose up -d
# Esperar ~2 min en el primer arranque (importa el dump SQL).
```

URLs locales:
- Sitio: http://localhost:8086
- Admin: http://localhost:8086/wp-admin
- phpMyAdmin: http://localhost:8087  (usuario `root` / pwd `rootpw`)
- MariaDB en host: `127.0.0.1:3308`

`wp-config.php` detecta la variable `WORDPRESS_DB_HOST` (presente en el contenedor)
y aplica `WP_HOME` / `WP_SITEURL` = `http://localhost:8086` para evitar redirects al
dominio de producción durante el desarrollo.

### WP-CLI

```bash
docker exec -it bourbon_wpcli wp --allow-root <comando>
# o usando el alias
docker compose exec wpcli wp --allow-root <comando>
```

## Deploy al hosting nuevo (bourboncoffeeroasters.com)

### 1. Subir archivos
Sube todo el directorio del proyecto **excepto**:
- `docker-compose.yml`
- `MIGRATION.md`
- `db-roasters.sql` / `db-roasters.sql.gz`
- `u373836252_2doYc (1).sql` (dump original)
- `wp-content/cache/`, `wp-content/litespeed/`, `wp-content/upgrade/`, `wp-content/upgrade-temp-backup/`

### 2. Importar la BD migrada
Sube `db-roasters.sql.gz` (14 MB) e impórtalo en el panel del nuevo hosting:

```bash
gunzip db-roasters.sql.gz
mysql -u <usuario_db> -p <nombre_db> < db-roasters.sql
```

O por phpMyAdmin (importar el `.sql.gz` directo).

### 3. Ajustar credenciales de BD
En el nuevo hosting edita los datos en `wp-config.php` (líneas 25-34):

```php
define( 'DB_NAME',     getenv('WORDPRESS_DB_NAME')     ?: 'NUEVO_DB_NAME' );
define( 'DB_USER',     getenv('WORDPRESS_DB_USER')     ?: 'NUEVO_DB_USER' );
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: 'NUEVA_PASSWORD' );
define( 'DB_HOST',     getenv('WORDPRESS_DB_HOST')     ?: 'localhost' );
```

Como el hosting no setea `WORDPRESS_DB_HOST`, los `getenv()` caen al fallback —
no rompe nada con respecto al código original.

### 4. Verificar dominio
La BD ya tiene `https://bourboncoffeeroasters.com` en `siteurl` y `home`.
Apunta el DNS del nuevo dominio al hosting y pega un certificado SSL.

### 5. Reactivar plugins desactivados para el desarrollo local
Tras subir, reactivar (en wp-admin → Plugins):
- LiteSpeed Cache
- Hostinger (si el nuevo hosting es Hostinger; si no, déjalo desactivado)

### 6. Actualizar enlaces permanentes
En wp-admin → Ajustes → Enlaces permanentes → Guardar (regenera `.htaccess`).

## Resumen del search-replace ejecutado
- `https://bourboncoffeesip.com` → `https://bourboncoffeeroasters.com`: 512 reemplazos
- `http://www.bourboncoffeesip.com` → `https://bourboncoffeeroasters.com`: 1 reemplazo
- `bourboncoffeesip.com` → `bourboncoffeeroasters.com` (cualquier protocolo): 3064 reemplazos

Las columnas `guid` se omitieron a propósito (recomendación oficial de WordPress:
los GUID son identificadores únicos, no URLs activas).
