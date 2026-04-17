# SmartHub Portal: Free Hosting and File Storage Guide

## 1) Recommended free stack

- Web hosting: Render (Free Web Service)
- Database + user accounts: Supabase Postgres (Free Tier)
- Windows installer storage: GitHub Releases (free) or Cloudflare R2 (free tier)

## 2) Where to upload Windows setup file

### Option A: GitHub Releases (recommended for installer downloads)

1. Create a release in your repository (example tag: v5.0.0).
2. Upload your installer file (for example: SmartHub-Setup-v5.0.0.exe).
3. Copy the direct asset URL from the release.
4. Set it in your portal environment variable:

WINDOWS_APP_DOWNLOAD_URL=https://github.com/OWNER/REPO/releases/download/v5.0.0/SmartHub-Setup-v5.0.0.exe

### Option B: Cloudflare R2

1. Create an R2 bucket.
2. Upload installer file.
3. Create public URL (or use signed URL with your own API flow).
4. Put URL in WINDOWS_APP_DOWNLOAD_URL.

### Option C: MediaFire

- Fast and easy for sharing, but less control and branding than GitHub/R2.
- If you use MediaFire, place that link in WINDOWS_APP_DOWNLOAD_URL.

## 3) Deploy Laravel on Render (free)

1. Push the website folder to GitHub.
2. On Render, create a new Web Service from your repo.
3. Use these settings:
   - Build Command: composer install --no-dev --optimize-autoloader ; npm ci ; npm run build ; php artisan config:cache
   - Start Command: php artisan serve --host 0.0.0.0 --port $PORT
4. Add environment variables from .env.example, especially:
   - APP_ENV=production
   - APP_DEBUG=false
   - APP_KEY=generate from local app key
   - APP_URL=https://your-render-url.onrender.com
   - DB_CONNECTION=pgsql
   - DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD from Supabase
   - DB_SSLMODE=require
   - WINDOWS_APP_DOWNLOAD_URL=your installer URL
5. Run migrations:
   - php artisan migrate --force

## 4) Supabase database setup (stores all user accounts)

1. Create a Supabase project.
2. Open Project Settings -> Database -> Connection string.
3. Use either direct DB host (5432) or pooler host (6543) values.
   - Direct host example: db.<project-ref>.supabase.co with DB_PORT=5432
   - Pooler host example: aws-<region>.pooler.supabase.com with DB_PORT=6543
4. Set Render variables:
   - DB_CONNECTION=pgsql
   - DB_HOST=your_supabase_host
   - DB_PORT=5432_or_6543
   - DB_DATABASE=postgres
   - DB_USERNAME=your_supabase_db_user
   - DB_PASSWORD=your_supabase_db_password
   - DB_SSLMODE=require
5. Deploy and run migrations:
   - php artisan migrate --force

Alternative (manual SQL import):
- Run this file in Supabase SQL Editor:
   - website/database/supabase/smarthub_portal_schema.sql
- This creates all required Laravel tables and marks migrations as applied.

After migration, Laravel Breeze users are saved in Supabase Postgres table users.

## 5) Use same users for web and desktop

- Web users: register/login pages from Laravel Breeze.
- Desktop app: call API endpoints in this portal:
  - POST /api/v1/register
  - POST /api/v1/login
  - GET /api/v1/me (Bearer token)
  - GET /api/v1/releases/windows-app

## 6) Local run notes

- For local Supabase/Postgres, enable these in D:\PHP\php.ini:
   - extension=pdo_pgsql
   - extension=pgsql
- Then restart terminal and verify:
   - php -m | findstr pgsql
- Generate app key if needed:
  - php artisan key:generate
- Run migration:
  - php artisan migrate
