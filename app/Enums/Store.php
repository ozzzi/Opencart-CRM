<?php

declare(strict_types=1);

namespace App\Enums;

enum Store: string
{
    case Wildbear = 'wildbear';
    case Procord = 'procord';

    public function color(): string
    {
        return match ($this) {
            self::Wildbear => 'red',
            self::Procord => 'blue',
        };
    }
}
