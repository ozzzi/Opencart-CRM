<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

use DateTime;

class FactoryDateTime
{
    public function make($value): DateTime
    {
        return (new DateTimeResolver())->resolve($value);
    }
}
