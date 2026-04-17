<?php

return [
    'windows_app' => [
        'name' => env('WINDOWS_APP_NAME', 'SmartHub Diagnostics ALPHA'),
        'version' => env('WINDOWS_APP_VERSION', 'v5.0.0'),
        'download_url' => env('WINDOWS_APP_DOWNLOAD_URL', ''),
        'sha256' => env('WINDOWS_APP_SHA256', ''),
        'release_notes_url' => env('WINDOWS_APP_RELEASE_NOTES_URL', ''),
        'storage_url' => env('WINDOWS_APP_STORAGE_URL', ''),
    ],

    'support_email' => env('PORTAL_SUPPORT_EMAIL', 'support@example.com'),
];
