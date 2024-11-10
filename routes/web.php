<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', static function () {
        return redirect()->route('requests.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('clients')->group(__DIR__ . '/clients.php');
    Route::prefix('requests')->group(__DIR__ . '/requests.php');
    Route::prefix('orders')->group(__DIR__ . '/orders.php');
    Route::prefix('products')->group(__DIR__ . '/products.php');
});

require __DIR__.'/auth.php';
