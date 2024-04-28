<?php

declare(strict_types=1);

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductOption extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_product_id',
        'name',
        'value',
    ];
}
