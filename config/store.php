<?php

declare(strict_types=1);

use App\Enums\Store;

return [
    'list' => [
        Store::Wildbear,
        Store::Procord,
    ],

    'status_processing' => [
        Store::Wildbear->value => [2],
        Store::Procord->value => [1],
    ],
];
