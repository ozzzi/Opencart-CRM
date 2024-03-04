<?php

declare(strict_types=1);

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait ObjectArray
{
    public function toArray(): array
    {
        $objectVars = get_object_vars($this);

        $stack = new \SplStack();
        $stack->push($objectVars);

        $result = [];

        while (!$stack->isEmpty()) {
            $current = $stack->pop();

            foreach ($current as $key => $value) {
                if (is_string($key)) {
                    $key = Str::snake($key);
                }

                if (is_array($value)) {
                    $stack->push($value);
                } elseif (is_object($value)) {
                    $result[$key] = $value->toArray();
                } else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }
}
