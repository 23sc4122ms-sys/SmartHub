<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }} Download Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="{{ route('portal.home') }}" class="text-lg font-semibold tracking-wide text-cyan-300">{{ $appName }}</a>
            <nav class="flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-md border border-cyan-400 px-4 py-2 font-medium text-cyan-300 transition hover:bg-cyan-500/10">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md border border-slate-700 px-4 py-2 font-medium text-slate-200 transition hover:border-cyan-400 hover:text-cyan-300">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-cyan-500 px-4 py-2 font-semibold text-slate-950 transition hover:bg-cyan-400">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-10">
        <section class="grid gap-6 rounded-2xl border border-slate-800 bg-gradient-to-r from-slate-900 to-slate-950 p-8 shadow-2xl lg:grid-cols-2">
            <div>
                <p class="mb-3 inline-flex rounded-full border border-cyan-500/60 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-cyan-300">Latest Desktop Release</p>
                <h1 class="mb-4 text-4xl font-bold leading-tight">{{ $appName }} <span class="text-cyan-300">{{ $appVersion }}</span></h1>
                <p class="mb-6 text-slate-300">Secure diagnostics companion for Windows. Download the latest installer and manage your account from one portal.</p>

                <div class="flex flex-wrap items-center gap-3">
                    @if($downloadUrl !== '')
                        <a href="{{ route('windows.download') }}" class="rounded-lg bg-cyan-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">Download Windows App</a>
                    @else
                        <button type="button" disabled class="cursor-not-allowed rounded-lg bg-slate-700 px-5 py-3 text-sm font-semibold text-slate-300">Download not configured yet</button>
                    @endif

                    @if($releaseNotesUrl !== '')
                        <a href="{{ $releaseNotesUrl }}" target="_blank" rel="noopener" class="rounded-lg border border-slate-600 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:border-cyan-400 hover:text-cyan-300">Release Notes</a>
                    @endif
                </div>

                @if($sha256 !== '')
                    <p class="mt-5 text-xs text-slate-400">SHA-256: <span class="font-mono">{{ $sha256 }}</span></p>
                @endif
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-900/70 p-6">
                <h2 class="mb-4 text-lg font-semibold text-cyan-300">Use the same account in desktop app</h2>
                <p class="mb-4 text-sm text-slate-300">This portal uses Laravel authentication. Your registered users can also log in from your desktop app through API endpoints.</p>
                <ul class="space-y-2 text-sm text-slate-200">
                    <li><span class="font-semibold text-cyan-300">POST</span> /api/v1/register</li>
                    <li><span class="font-semibold text-cyan-300">POST</span> /api/v1/login</li>
                    <li><span class="font-semibold text-cyan-300">GET</span> /api/v1/me</li>
                    <li><span class="font-semibold text-cyan-300">GET</span> /api/v1/releases/windows-app</li>
                </ul>
                <p class="mt-4 text-xs text-slate-400">Support: {{ $supportEmail }}</p>
            </div>
        </section>

        <section class="mt-10 grid gap-6 lg:grid-cols-3">
            <article class="rounded-xl border border-slate-800 bg-slate-900 p-5">
                <h3 class="mb-2 text-base font-semibold text-cyan-300">Recommended File Storage</h3>
                <p class="text-sm text-slate-300">Best options for hosting your .exe or setup files:</p>
                <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-slate-200">
                    <li>GitHub Releases (free, stable, versioned)</li>
                    <li>Cloudflare R2 (S3-compatible, low-cost/free tier)</li>
                    <li>MediaFire (easy sharing, less control)</li>
                </ul>
                @if($storageUrl !== '')
                    <a href="{{ $storageUrl }}" target="_blank" rel="noopener" class="mt-4 inline-block text-sm font-semibold text-cyan-300 hover:underline">Current storage link</a>
                @endif
            </article>

            <article class="rounded-xl border border-slate-800 bg-slate-900 p-5">
                <h3 class="mb-2 text-base font-semibold text-cyan-300">Free Hosting Stack</h3>
                <ul class="list-disc space-y-1 pl-5 text-sm text-slate-200">
                    <li>Render free web service for Laravel</li>
                    <li>Neon free PostgreSQL database</li>
                    <li>Cloudflare R2 or GitHub Releases for installers</li>
                </ul>
                <p class="mt-3 text-xs text-slate-400">See DEPLOY_FREE_GUIDE.md inside this Laravel project for step-by-step setup.</p>
            </article>

            <article class="rounded-xl border border-slate-800 bg-slate-900 p-5">
                <h3 class="mb-2 text-base font-semibold text-cyan-300">Before Go-live</h3>
                <ul class="list-disc space-y-1 pl-5 text-sm text-slate-200">
                    <li>Set WINDOWS_APP_DOWNLOAD_URL in .env</li>
                    <li>Run database migrations</li>
                    <li>Enable HTTPS on your host</li>
                    <li>Test register/login from web and desktop</li>
                </ul>
            </article>
        </section>
    </main>
</body>
</html>
