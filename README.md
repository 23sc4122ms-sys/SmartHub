# SmartHub Portal (Laravel 13)

This folder contains the SmartHub web portal built with Laravel.

## Features

- Public download page for Windows app
- Register and login (Laravel Breeze)
- Shared account system for web and desktop API usage
- Token auth API (Laravel Sanctum)

## Web routes

- `/` download portal
- `/download/windows-app` redirects to configured installer URL
- `/register` and `/login` user authentication
- `/dashboard` authenticated user dashboard

## API routes

- `POST /api/v1/register`
- `POST /api/v1/login`
- `GET /api/v1/releases/windows-app`
- `GET /api/v1/me` (Bearer token required)
- `POST /api/v1/logout` (Bearer token required)

## Configure installer URL

Set these in `.env`:

- `WINDOWS_APP_DOWNLOAD_URL`
- `WINDOWS_APP_VERSION`
- `WINDOWS_APP_SHA256` (optional)
- `WINDOWS_APP_RELEASE_NOTES_URL` (optional)

## Local setup

1. `composer install`
2. `cp .env.example .env` (or use Windows equivalent)
3. `php artisan key:generate`
4. Configure database in `.env`
5. `php artisan migrate`
6. `npm install`
7. `npm run build`
8. `php artisan serve`

## Free hosting and storage

See `DEPLOY_FREE_GUIDE.md` for a full guide using Render + Neon + GitHub Releases/Cloudflare R2.
