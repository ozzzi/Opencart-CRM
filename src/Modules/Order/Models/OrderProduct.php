<?php

declare(strict_types=1);

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property string $model
 * @property string $sku
 * @property int $quantity
 * @property float $price
 */
class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'model',
        'sku',
        'quantity',
        'price',
    ];
}
