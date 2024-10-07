<?php

declare(strict_types=1);

namespace Modules\Request\Model;

use App\Enums\Store;
use App\Models\Filter\Filter;
use App\Models\Filter\Filterable;
use App\Models\Scopes\RecentByDateAdded;
use App\Support\Traits\StoreColor;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Client\Models\Client;
use Modules\OrderStatus\Models\OrderStatus;
use Modules\Shipment\Models\Tracking;

/**
 * @property int $id
 * @property ?int $order_id
 * @property ?int $order_id_ext
 * @property int $client_id
 * @property int $status_id
 * @property string $name
 * @property ?string $phone
 * @property ?string $comment
 * @property Store $store
 * @property string $date_added
 * @property-read OrderStatus $status
 * @property-read Client $client
 * @property-read string $storeColor
 * @property-read Tracking $tracking
 * @method static Builder filter(Filter $filter)
 */
#[ScopedBy([RecentByDateAdded::class])]
class Request extends Model
{
    use HasFactory;
    use StoreColor;
    use Filterable;

    protected $fillable = [
        'order_id',
        'order_id_ext',
        'client_id',
        'status_id',
        'name',
        'phone',
        'comment',
        'store',
        'date_added',
    ];

    protected $casts = [
        'store' => Store::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'external_id');
    }

    /**
     * @return HasOne<Tracking>
     */
    public function tracking(): HasOne
    {
        return $this->hasOne(Tracking::class);
    }

    public function isNew(): Attribute
    {
        return Attribute::make(
            get: function () {
                return in_array($this->status_id, config('store.status_processing')[$this->store->value], true);
            }
        );
    }
}
