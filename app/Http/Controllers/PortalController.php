<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function home(): View
    {
        return view('portal.home', [
            'appName' => (string) config('portal.windows_app.name'),
            'appVersion' => (string) config('portal.windows_app.version'),
            'downloadUrl' => (string) config('portal.windows_app.download_url'),
            'storageUrl' => (string) config('portal.windows_app.storage_url'),
            'sha256' => (string) config('portal.windows_app.sha256'),
            'releaseNotesUrl' => (string) config('portal.windows_app.release_notes_url'),
            'supportEmail' => (string) config('portal.support_email'),
        ]);
    }

    public function downloadWindowsApp(): RedirectResponse
    {
        $downloadUrl = (string) config('portal.windows_app.download_url');

        abort_if($downloadUrl === '', 404, 'Windows app download URL is not configured yet.');

        return redirect()->away($downloadUrl);
    }
}
