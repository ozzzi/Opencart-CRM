<?php

declare(strict_types=1);

namespace App\Support\Hydrator;

use App\Support\Hydrator\Hydrates\Hydrate;
use ReflectionClass;
use ReflectionException;

final class Hydrator
{
    private array $models = [];

    private Hydrate $hydrate;

    public function __construct(private readonly array $names = [])
    {
        $this->hydrate = new Hydrate($this->names);
    }

    /**
     * @param array $data
     * @param class-string $class
     * @return object
     * @throws ReflectionException
     */
    public function hydrate(array $data, string $class): object
    {
        $model = $this->createModel($class);
        $this->hydrate->hydrate($data, $model);

        return $model;
    }

    /**
     * @param class-string $class
     * @return object
     * @throws ReflectionException
     */
    private function createModel(string $class): object
    {
        if (!isset($this->models[$class])) {
            $reflection = new ReflectionClass($class);
            $this->models[$class] = $reflection->newInstanceWithoutConstructor();
        }

        return clone $this->models[$class];
    }
}
