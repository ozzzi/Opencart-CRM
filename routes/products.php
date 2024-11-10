<?php

declare(strict_types=1);

use App\Http\Controllers\Product\ProductController;

Route::controller(ProductController::class)
    ->name('products.')
    ->group(static function () {
        Route::get('', 'index')->name('index');
        Route::get('{product}', 'show')->name('show');
    });
