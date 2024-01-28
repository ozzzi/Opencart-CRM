<?php

declare(strict_types=1);

namespace App\Support\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait StoreColor
{
    protected function storeColor(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->store->color();
            }
        );
    }
}
