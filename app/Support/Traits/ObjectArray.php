<?php

declare(strict_types=1);

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait ObjectArray
{
    public function toArray(): array
    {
        $objectVars = get_object_vars($this);

        return array_combine(
            array_map(static fn($value) => Str::snake($value), array_keys($objectVars)),
            array_values($objectVars)
        );
    }
}
