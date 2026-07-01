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
        'session_secure' => var_export(config('session.secure'), true),
        'session_domain' => var_export(config('session.domain'), true),
        'session_same_site' => config('session.same_site'),
        'cache_store' => config('cache.default'),
        'storage_writable' => is_writable(storage_path('framework/sessions')) ? 'yes' : 'NO',
        'bootstrap_cache_writable' => is_writable(base_path('bootstrap/cache')) ? 'yes' : 'NO',
        'request_secure' => request()->isSecure() ? 'yes' : 'no',
        'x_forwarded_proto' => request()->header('X-Forwarded-Proto') ?: '(empty)',
    ];
    try {
        \DB::connection()->getPdo();
        $checks['db'] = 'ok (' . \DB::connection()->getDatabaseName() . ')';
        $checks['user_count'] = \App\Models\User::count();
        $checks['session_count'] = \DB::table('sessions')->count();
        $checks['last_session'] = \DB::table('sessions')->orderBy('last_activity', 'desc')->first();
    } catch (\Throwable $e) {
        $checks['db'] = 'FAIL: ' . $e->getMessage();
    }
    return response()->json($checks);
});

Route::get('/health-session', function (Request $request) {
    $request->session()->put('test_key', 'test_value_' . time());
    $request->session()->save();
    return response()->json([
        'session_id' => $request->session()->getId(),
        'test_key' => $request->session()->get('test_key'),
        'cookie_set' => true,
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/barang', function () {
        return view('barang.index');
    })->name('barang.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/fix-cookie', function (\Illuminate\Http\Request $request) {
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response('Session cleared. Silakan login ulang di /login', 200)
        ->header('Content-Type', 'text/plain');
});

Route::get('/whoami', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'authenticated' => \Auth::check(),
        'user_id' => \Auth::id(),
        'session_id' => $request->session()->getId(),
        'has_session' => $request->session()->isStarted(),
        'session_name' => config('session.cookie'),
    ]);
});

require __DIR__.'/auth.php';
