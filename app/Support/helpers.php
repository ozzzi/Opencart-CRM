<?php

declare(strict_types=1);

use App\Support\Flash\Flash;

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if (!function_exists('phoneNormalise')) {
    function phoneNormalise(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) < 10 || strlen($phone) > 12) {
            throw new InvalidArgumentException('Invalid phone length');
        }

        if (strlen($phone) === 10) {
            $phone = '38' . $phone;
        }

        if (strlen($phone) === 11) {
            $phone = '3' . $phone;
        }

        if (!str_starts_with($phone, '38')) {
            throw new InvalidArgumentException('Foreign phone number');
        }

        return $phone;
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat(float $price): string
    {
        return number_format($price, 2, '.', '');
    }
}
