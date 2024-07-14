<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates;

use ReflectionException;
use ReflectionProperty;

class TypeResolver
{
    private TypeStrategy $typeStrategy;

    public function __construct()
    {
        $this->typeStrategy = new TypeStrategy();
    }

    /**
     * @throws ReflectionException
     */
    public function resolveType(object $model, string $property): string
    {
        $reflectionProperty = new ReflectionProperty($model, $property);
        $type = $reflectionProperty->getType();

        if ($type === null) {
            throw new ReflectionException('Invalid property type');
        }

        /* @phpstan-ignore-next-line */
        return $type->getName();
    }

    public function resolveValue($value, string $type)
    {
        return $this->typeStrategy->resolve($value, $type);
    }
}
