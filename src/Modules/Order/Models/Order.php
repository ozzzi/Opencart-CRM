<?php

declare(strict_types=1);

namespace Modules\Order\Models;

use App\Enums\Store;
use App\Support\Traits\StoreColor;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Models\Builders\OrderBuilder;
use Modules\OrderStatus\Models\OrderStatus;

/**
 * @property int $id
 * @property int $order_id
 * @property Store $store
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $payment_method
 * @property string $shipping_method
 * @property string $shipping_city
 * @property string $shipping_zone
 * @property string $comment
 * @property float $total
 * @property int $status_id
 * @property string $date_added
 * @property-read Collection<OrderProduct> $products
 * @property-read OrderStatus $status
 */
class Order extends Model
{
    use HasFactory;
    use StoreColor;

    protected $fillable = [
        'order_id',
        'store',
        'name',
        'email',
        'phone',
        'payment_method',
        'shipping_method',
        'shipping_city',
        'shipping_zone',
        'comment',
        'total',
        'status_id',
        'date_added',
    ];

    protected $casts = [
        'store' => Store::class,
    ];

    public function phone(): Attribute
    {
        return Attribute::make(
            set: static function ($value) {
                return preg_replace('/\D/', '', $value);
            },
        );
    }

    /**
     * @return HasMany<OrderProduct>
     */
    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'external_id');
    }

    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }
}
