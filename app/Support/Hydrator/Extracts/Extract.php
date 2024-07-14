<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Extracts;

use Illuminate\Support\Str;
use ReflectionClass;

class Extract
{
    public function extract(object $model): array
    {
        $fields = $this->getExtractFields($model);
        $data = [];

        foreach ($fields as $name => $key) {
            $data[$key] = $model->$name;
        }

        return $data;
    }

    private function getExtractFields(object $model): array
    {
        $fields = [];

        $reflection = new ReflectionClass($model);

        foreach ($reflection->getProperties() as $property) {
            if (!$property->isPublic()) {
                continue;
            }

            $name = $property->getName();
            $fields[$name] = Str::snake($name);
        }

        return $fields;
    }
}
