<?php

declare(strict_types=1);

namespace App\Support\Hydrator\Hydrates\Types;

use DateTime;

class DateTimeResolver implements TypeResolveInterface
{
    public function resolve($value): DateTime
    {
        if (is_int($value)) {
            $dateTime = new DateTime("@{$value}");
        } else {
            $dateTime = DateTime::createFromFormat('d.m.Y H:i:s', $value);
        }

        return $dateTime;
    }
}
