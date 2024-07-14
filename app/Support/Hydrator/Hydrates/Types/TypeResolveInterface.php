<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

interface TypeResolveInterface
{
    public function resolve($value): mixed;
}
