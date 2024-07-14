<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

class FactoryEnum implements FactoryType
{
    /**
     * @param class-string $enumClass
     */
    public function __construct(private readonly string $enumClass)
    {
    }

    public function make($value): mixed
    {
        return (new EnumResolver($this->enumClass))->resolve($value);
    }
}
