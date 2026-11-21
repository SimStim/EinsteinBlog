# Einstein Blog

A minimalist blog demo, rebuilt with the current Laravel version.

> "Make it as simple as possible." — Albert Einstein

## Features

- List all posts, newest first
- Read a single post
- Filter posts by category (`/cat/{category}`)
- Create, edit and delete posts
- Validation, flashed status messages and friendly error display
- Seeded demo content (one author, three posts per category)

## Stack

- Laravel 13 / PHP 8.3+
- SQLite by default (no database server required); any Laravel-supported database works via `.env`
- Blade + Bootstrap 5 served from CDN (no JavaScript build step)
- PHPUnit feature tests

## Getting started

```bash
composer install
cp .env.example .env          # optional: composer create-project does this for you
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Then visit <http://localhost:8000>.

Quick setup is also available as `composer run setup`.

Run the test suite with:

```bash
php artisan test
```

## Implementation notes

- **Domain:** `BlogPost` belongs to an author (`User`) and casts its `category` column to a
  backed `App\Enums\Category` enum. Categories are no longer hardcoded in each view.
- **HTTP layer:** a single resource `BlogPostController` handles index/create/store/show/
  edit/update/destroy; validation lives in `BlogPostRequest`. Routes are named, so views use
  `route()` instead of hardcoded paths.
- **Database:** `blog_posts` uses proper types and a real `user_id` foreign key (the old demo
  stored IDs as text and hardcoded `user_id = 1`). The category column is indexed.
- **Security:** all user-provided output is escaped with `{{ }}`, CSRF tokens are present on
  every form, and invalid enum values are rejected by validation and route binding.
- **Simplifications:** authentication is intentionally out of scope for this MVP. New posts are
  attributed to the signed-in user when present, otherwise to the seeded author. Removing the
  Laravel Mix/jQuery toolchain in favour of a CDN stylesheet keeps the demo build-free.
