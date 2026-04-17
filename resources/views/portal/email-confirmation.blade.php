<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Confirmation - SmartHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <main class="mx-auto flex min-h-screen max-w-3xl items-center px-6 py-12">
        <section class="w-full rounded-2xl border border-slate-800 bg-gradient-to-r from-slate-900 to-slate-950 p-8 shadow-2xl">
            <p class="mb-3 inline-flex rounded-full border border-cyan-500/60 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-cyan-300">
                Email Confirmation
            </p>
            <h1 class="mb-3 text-3xl font-bold leading-tight text-cyan-300">Your email has been confirmed</h1>
            <p class="mb-6 text-slate-300">
                Return to the SmartHub Windows app and sign in using your account. If needed, you can download the latest installer below.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('windows.download') }}" class="rounded-lg bg-cyan-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">
                    Download Windows App
                </a>
                <a href="{{ route('portal.home') }}" class="rounded-lg border border-slate-600 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:border-cyan-400 hover:text-cyan-300">
                    Back to Portal
                </a>
            </div>

            <p class="mt-6 text-xs text-slate-400">
                If this page was opened automatically from your email link, your confirmation step is complete.
            </p>
        </section>
    </main>
</body>
</html>
