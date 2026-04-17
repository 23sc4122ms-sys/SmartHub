<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ReleaseController extends Controller
{
    public function windowsApp(): JsonResponse
    {
        $downloadUrl = (string) config('portal.windows_app.download_url');

        return response()->json([
            'ok' => true,
            'release' => [
                'name' => (string) config('portal.windows_app.name'),
                'version' => (string) config('portal.windows_app.version'),
                'download_url' => $downloadUrl,
                'sha256' => (string) config('portal.windows_app.sha256'),
                'release_notes_url' => (string) config('portal.windows_app.release_notes_url'),
                'storage_url' => (string) config('portal.windows_app.storage_url'),
                'is_download_ready' => $downloadUrl !== '',
            ],
        ]);
    }
}
