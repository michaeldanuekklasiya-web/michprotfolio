<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\SiteLike;
use App\Models\SiteLikeDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

// Contact form routes
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::post('/api/contact', [ContactController::class, 'storeAjax'])->middleware('throttle:5,1')->name('api.contact.store');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Like counter (one like per IP)
Route::get('/like-count', fn () => response()->json(['count' => (int) SiteLike::value('count')]));

Route::get('/like-status', fn (Request $request) => response()->json([
    'liked' => SiteLikeDevice::where('ip_address', $request->ip())->exists(),
]));

Route::post('/like-toggle', function (Request $request) {
    $like = SiteLike::firstOrCreate([], ['count' => 0]);
    $device = SiteLikeDevice::where('ip_address', $request->ip())->first();

    if ($device) {
        $device->delete();
        $like->count = max(0, $like->count - 1);
        $like->save();
    } else {
        SiteLikeDevice::create(['ip_address' => $request->ip()]);
        $like->increment('count');
    }

    return response()->json(['liked' => ! $device, 'count' => $like->count]);
})->middleware('throttle:20,1');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'show'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');
        Route::resource('posts', Admin\PostController::class)->except('show');
        Route::resource('projects', Admin\ProjectController::class)->except('show');
        Route::resource('messages', Admin\MessageController::class)->only(['index', 'show', 'destroy']);
        Route::get('account', [Admin\AccountController::class, 'edit'])->name('account');
        Route::put('account', [Admin\AccountController::class, 'update'])->name('account.update');
    });
});
