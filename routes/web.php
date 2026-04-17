<?php

use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortalController::class, 'home'])->name('portal.home');
Route::get('/download/windows-app', [PortalController::class, 'downloadWindowsApp'])->name('windows.download');
