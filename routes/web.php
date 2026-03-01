<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/search', [App\Http\Controllers\DashboardController::class, 'search']);
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search']);

Route::domain('viewer.' . config('app.app_host'))
    ->as('viewer.')
    ->group(function () {
        // Landing page
        Route::get('/', function () {
            if (auth('viewer')->check()) {
                return redirect()->route('viewer.dashboard');
            }
            // Show login page directly instead of redirecting
            return app(App\Http\Controllers\ViewerController::class)->login();
        });

        // Guest routes
        Route::middleware('guest:viewer')->group(function () {
            Route::get('/login', [App\Http\Controllers\Viewer\LoginController::class, 'index'])->name('login');
            Route::post('/mail', [App\Http\Controllers\Viewer\LoginController::class, 'mail']);
            Route::post('/verify', [App\Http\Controllers\Viewer\LoginController::class, 'verify']);
        });

        // Authenticated routes
        Route::middleware('auth:viewer')->group(function () {
            Route::post('/logout', [App\Http\Controllers\Viewer\LoginController::class, 'logout'])->name('logout');
            Route::get('/dashboard', [App\Http\Controllers\Viewer\DashboardController::class, 'index'])->name('dashboard');

            Route::get('/{folder}/download', [App\Http\Controllers\Viewer\DownloadController::class, 'download'])->name('download');
            Route::resource('folders', App\Http\Controllers\Viewer\FolderController::class);
            Route::resource('downloads', App\Http\Controllers\Viewer\DownloadController::class);
            Route::resource('/files', App\Http\Controllers\Viewer\FileController::class);
        });
    });

Route::domain(config('app.url_host'))
    ->middleware(['auth:web'])
    ->as('web.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
        Route::post('/', [App\Http\Controllers\WelcomeController::class, 'store']);
        Route::middleware(['role:Photographer'])->group(function () {
            
            Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
            Route::resource('/folders', App\Http\Controllers\Common\FolderController::class);
            Route::resource('/files', App\Http\Controllers\Common\FileController::class);
            Route::resource('/trash', App\Http\Controllers\Common\TrashController::class);

            Route::resource('/payments', App\Http\Controllers\Common\PaymentController::class);
            Route::resource('/subscriptions', App\Http\Controllers\Common\SubscriptionController::class);
        });

        Route::middleware(['role:Administrator'])->group(function () {
            Route::resource('/users', App\Http\Controllers\Executive\UserController::class);
            Route::resource('/plans', App\Http\Controllers\Executive\PlanController::class);
            Route::resource('/references', App\Http\Controllers\Executive\ReferenceController::class);
        });

        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    });

    Route::middleware('auth:web,viewer')->group(function () {
        Route::get('/shared-route', function () {
            return "Accessible by web OR viewer user";
        });
    });

    
    require __DIR__.'/auth.php';

