<?php

declare(strict_types=1);

namespace App\Support\Flash;

enum FlashTypes: string
{
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';
    case DANGER = 'danger';
}
