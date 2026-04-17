<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-4">
                        <p class="text-lg font-semibold">{{ __("You're logged in!") }}</p>
                        <p class="text-sm text-gray-600">Use this account on both the web portal and desktop app API.</p>

                        <a
                            href="{{ route('windows.download') }}"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500"
                        >
                            Download Windows App
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-3">
                        <h3 class="font-semibold">Desktop API endpoints</h3>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li>POST /api/v1/register</li>
                            <li>POST /api/v1/login</li>
                            <li>GET /api/v1/me (Bearer token required)</li>
                            <li>GET /api/v1/releases/windows-app</li>
                        </ul>
                        <p class="text-xs text-gray-500">Use the token returned by login/register as Authorization: Bearer TOKEN.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
