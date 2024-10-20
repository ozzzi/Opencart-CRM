<?php

declare(strict_types=1);

namespace Modules\Order\Models\Builders;

use App\Enums\Store;
use Illuminate\Database\Eloquent\Builder;

class OrderBuilder extends Builder
{
    public function nonCompleted(Store $store): self
    {
        return $this->whereNotIn('status_id', config('store.status_completed')[$store->value])
            ->where('date_added', '>', now()->subDays(2)->format('Y-m-d') . ' 00:00:00');
    }
}
