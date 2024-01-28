<?php

declare(strict_types=1);

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ContactController;
use Illuminate\Support\Facades\Route;

Route::controller(ClientController::class)
    ->name('clients.')
    ->group(static function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('{client}/edit', 'edit')->name('edit');
        Route::put('{client}', 'update')->name('update');
        Route::delete('{client}', 'delete')->name('delete');
    });

Route::controller(ContactController::class)
    ->name('contacts.')
    ->group(static function () {
        Route::get('{client}/contacts', 'list')->name('list');
        Route::post('{client}/contacts', 'store')->name('store');
        Route::delete('/contacts/{contact}', 'delete')->name('delete');
    });
