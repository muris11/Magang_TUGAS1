<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', function () {
    $checks = [
        'app_key' => config('app.key') ? 'set' : 'EMPTY',
        'app_env' => app()->environment(),
        'app_debug' => config('app.debug') ? 'true' : 'false',
        'app_url' => config('app.url'),
        'db' => 'unknown',
        'session_driver' => config('session.driver'),
        'cache_store' => config('cache.default'),
        'storage_writable' => is_writable(storage_path('framework/sessions')) ? 'yes' : 'NO',
        'bootstrap_cache_writable' => is_writable(base_path('bootstrap/cache')) ? 'yes' : 'NO',
    ];
    try {
        \DB::connection()->getPdo();
        $checks['db'] = 'ok (' . \DB::connection()->getDatabaseName() . ')';
        $checks['user_count'] = \App\Models\User::count();
    } catch (\Throwable $e) {
        $checks['db'] = 'FAIL: ' . $e->getMessage();
    }
    return response()->json($checks);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/barang', function () {
        return view('barang.index');
    })->name('barang.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
