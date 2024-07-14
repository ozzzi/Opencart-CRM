<?php

declare(strict_types=1);

namespace App\Support\Hydrator;

use App\Support\Hydrator\Extracts\Extract;

final class Extractor
{
    private Extract $extractStrategy;

    public function __construct()
    {
        $this->extractStrategy = new Extract();
    }

    public function extract(object $model): array
    {
        return $this->extractStrategy->extract($model);
    }
}
