<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates;

use App\Support\Hydrator\Hydrates\Types\FactoryDateTime;
use App\Support\Hydrator\Hydrates\Types\FactoryEnum;

class TypeStrategy
{
    public function resolve(mixed $value, string $type)
    {
        $factory = null;

        if ($type === 'DateTime') {
            $factory = new FactoryDateTime();
        }

        if (enum_exists($type)) {
            $factory = new FactoryEnum($type);
        }

        if ($factory === null) {
            return $value;
        }

        return $factory->make($value);
    }
}
