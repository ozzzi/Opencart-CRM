<?php

declare(strict_types=1);

namespace Modules\Client\Enums;

enum ContactType: string
{
    case Email = 'email';
    case Phone = 'phone';
    case Viber = 'viber';
    case Telegram = 'telegram';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Email => 'Email',
            self::Phone => 'Телефон',
            self::Viber => 'Viber',
            self::Telegram => 'Telegram',
        };
    }
}
