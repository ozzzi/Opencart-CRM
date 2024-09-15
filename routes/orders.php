<?php

declare(strict_types=1);

use App\Http\Controllers\Order\OrderController;

Route::controller(OrderController::class)
    ->name('orders.')
    ->group(static function () {
        Route::get('', 'index')->name('index');
        Route::get('{order}', 'show')->name('show');
    });
