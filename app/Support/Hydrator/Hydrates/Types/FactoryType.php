<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

interface FactoryType
{
    public function make($value);
}
