# Mitramedia Advertising Website

Laravel 12 website for Mitramedia Advertising. The app contains a public landing site, article pages, project portfolio, admin dashboard, and dynamic SEO settings for public routes.

## Features

- Public landing pages rendered through one dynamic route.
- SEO settings managed from `/admin/seo`.
- Article CRUD from `/admin/article`.
- Project CRUD from `/admin/projects`.
- Sitemap generated from active public SEO routes and articles.
- Google Analytics dashboard with safe fallback when GA dependencies/config are unavailable.

## Stack

- PHP `^8.2`
- Laravel `^12`
- MySQL
- Vite
- Tailwind CSS v4
- Alpine.js
- AOS, Lenis
- CKEditor for article content

## Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
```

For local development:

```bash
php artisan serve
npm run dev
```

Or use the Composer script:

```bash
composer run dev
```

## Environment

Configure the database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mitramedia_db
DB_USERNAME=root
DB_PASSWORD=
```

Google Analytics is optional. If enabled, set:

```env
GA_CREDENTIALS=path/to/service-account.json
GA_PROPERTY_ID=123456789
```

The GA client requires PHP `bcmath`. If it is missing, the dashboard falls back to zero values instead of crashing.

## Public Routing

Public pages are handled by one catch-all route:

```php
Route::get('/{path?}', [Main::class, 'show'])
    ->where('path', '.*')
    ->name('public.page');
```

The route is resolved from the `public_page_seos` table:

- `path`: public URL, for example `/`, `/about-us`, `/artikel`, `/project`.
- `view_name`: Blade view or special handler, for example `pages.home` or `article_detail`.
- `is_active`: inactive routes return 404.

Default mappings:

- `/` -> `pages.home`
- `/about-us` -> `pages.about`
- `/artikel` -> `pages.artikel`
- `/artikel/*` -> `article_detail`
- `/project` -> `pages.project`
- `/contact-us` -> `pages.contact`

## Dynamic SEO

SEO is managed from:

```text
/admin/seo
```

Supported fields:

- Meta title
- Meta description
- Meta keywords
- Robots
- Open Graph title, description, image
- Twitter title, description, image

For route patterns such as `/artikel/*`, these tokens can be used:

```text
{title}
{description}
{keywords}
{site}
```

Example for article detail:

```text
Meta Title: {title} | Mitramedia Advertising
Meta Description: {description}
Meta Keywords: {keywords}, jasa reklame surabaya
```

## Admin Routes

```text
/login
/admin/dashboard
/admin/article
/admin/projects
/admin/seo
```

## Articles

Articles use:

- Table: `articles_data`
- Tags table: `tags_data`
- Pivot table: `article_tag_data`

Admin article features:

- Create article
- Edit article
- Delete article
- Upload thumbnail
- CKEditor image upload
- Auto slug fallback
- SEO title and description per article

Public article pages:

- `/artikel`
- `/artikel/{slug}`

## Assets

Build frontend assets:

```bash
npm run build
```

Development server:

```bash
npm run dev
```

## Storage

Article and project uploads use the public disk. Ensure the storage symlink exists:

```bash
php artisan storage:link
```

## Sitemap

Sitemap is available at:

```text
/sitemap.xml
```

It includes:

- Active public SEO routes without wildcard paths.
- Article detail URLs.

## Tests

```bash
php artisan test
```

## Troubleshooting

If `/admin/dashboard` shows a Google protobuf `bccomp()` error, install PHP bcmath:

```bash
sudo apt install php-bcmath
sudo systemctl restart php8.2-fpm
```

Adjust `php8.2-fpm` to the PHP-FPM version used by the server.

If public SEO changes do not appear:

```bash
php artisan view:clear
php artisan cache:clear
```

Then confirm the matching row in `/admin/seo` is active and has the correct `path`.
