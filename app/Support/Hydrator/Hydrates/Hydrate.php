<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates;

use Closure;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionProperty;

class Hydrate
{
    private Closure $fn;

    private array $cache = [];

    public function __construct(array $names = [])
    {
        $this->fn = static function (array $data, object $model) use ($names): void {
            $typeResolver = new TypeResolver();

            foreach ($data as $name => $value) {
                if (array_key_exists($name, $names)) {
                    $property = $names[$name];
                } else {
                    $property = Str::camel($name);
                }

                if (property_exists($model, $property)) {
                    $type = $typeResolver->resolveType($model, $property);
                    $model->$property = $typeResolver->resolveValue($value, $type);
                }
            }

            $reflection = new ReflectionClass($model);
            foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                if (!$property->isInitialized($model)) {
                    $property->setValue($model, $property->getDefaultValue());
                }
            }
        };
    }

    public function hydrate(array $data, object $model): void
    {
        $class = get_class($model);

        if (!isset($this->cache[$class])) {
            $this->cache[$class] = Closure::bind($this->fn, null, $class);
        }

        $this->cache[$class]($data, $model);
    }
}
