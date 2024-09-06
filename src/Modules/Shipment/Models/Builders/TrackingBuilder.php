<?php

declare(strict_types=1);

namespace Modules\Shipment\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class TrackingBuilder extends Builder
{
    public function new(): self
    {
        return $this->whereNull('delivered')
            ->whereNull('received')
            ->whereNull('canceled');
    }
}
