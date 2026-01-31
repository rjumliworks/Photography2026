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
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::post('/', [App\Http\Controllers\WelcomeController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/search', [App\Http\Controllers\DashboardController::class, 'search']);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search']);

Route::middleware(['role:Photographer'])->group(function () {
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

Route::get('/viewer/login', [App\Http\Controllers\ViewerController::class, 'login'])->name('viewer.login');
Route::middleware('auth:viewer')->group(function () {
    Route::get('/viewer', [App\Http\Controllers\ViewerController::class, 'view'])->name('viewer.dashboard');
    Route::get('/viewer/logout', [App\Http\Controllers\ViewerController::class, 'logout'])->name('viewer.logout');
    Route::get('/viewer/{folder}/download', [App\Http\Controllers\ViewerController::class, 'download']);
});
Route::post('/mail', [App\Http\Controllers\OtpController::class, 'mail']);
Route::post('/verify', [App\Http\Controllers\OtpController::class, 'verify']);

require __DIR__.'/auth.php';
