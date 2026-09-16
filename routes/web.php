<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicVerificationController;

// Guest Authentication Routes (Hidden / Direct URL only)
Route::middleware('guest')->group(function () {
    Route::get('/admin/authentication/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/authentication/login', [LoginController::class, 'login']);
});

// Authenticated Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Public Root & QR Verification Entrypoint
// When ?t={token} or ?ref={token} is present, resolve verification; otherwise 404 (protects admin routes from scanners)
Route::get('/', function (\Illuminate\Http\Request $request) {
    if ($request->filled('t') || $request->filled('ref')) {
        return app(PublicVerificationController::class)->displayVerificationInfo($request);
    }
    abort(404);
})->name('home');

// Public Online QR Verification Endpoints (Full paths & Legacy aliases)
Route::get('/ini/certificates-statements/verification-info-display', [PublicVerificationController::class, 'displayVerificationInfo'])->name('verify.display');

Route::prefix('verify')->name('verify.')->group(function () {
    Route::get('/certificate/{token}', [PublicVerificationController::class, 'verifyCertificate'])->name('certificate');
    Route::get('/statement/{token}', [PublicVerificationController::class, 'verifyStatement'])->name('statement');
});

// Protected Admin Panel (Requires Login)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Unified Bank Verification Management
    Route::prefix('verifications')->name('verifications.')->group(function () {
        Route::get('/', [VerificationController::class, 'index'])->name('index');
        Route::post('/', [VerificationController::class, 'store'])->name('store');
        Route::put('/{verification}', [VerificationController::class, 'update'])->name('update');
        Route::delete('/{verification}', [VerificationController::class, 'destroy'])->name('destroy');
        
        // Backward-compatibility aliases
        Route::get('/certificate', fn() => redirect()->route('admin.verifications.index'))->name('certificate');
        Route::get('/statement', fn() => redirect()->route('admin.verifications.index'))->name('statement');
    });
});
