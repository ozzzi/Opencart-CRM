<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

use BackedEnum;
use UnitEnum;

class EnumResolver implements TypeResolveInterface
{
    /**
     * @param class-string $enumClass
     */
    public function __construct(private readonly string $enumClass)
    {
    }

    public function resolve($value): UnitEnum
    {
        /* @var BackedEnum $enum */
        return $this->enumClass::from($value);
    }
}
