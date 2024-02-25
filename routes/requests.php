<?php

declare(strict_types=1);

use App\Http\Controllers\Request\RequestController;
use Illuminate\Support\Facades\Route;

Route::controller(RequestController::class)
    ->name('requests.')
    ->group(static function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('{request}/edit', 'edit')->name('edit');
        Route::put('{request}', 'update')->name('update');
        Route::delete('{request}', 'delete')->name('delete');
    });
