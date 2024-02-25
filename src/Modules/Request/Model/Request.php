<?php

declare(strict_types=1);

namespace Modules\Request\Model;

use App\Enums\Store;
use App\Models\Scopes\RecentFirstScope;
use App\Support\Traits\StoreColor;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Client\Models\Client;
use Modules\OrderStatus\Models\OrderStatus;

/**
 * @property int $id
 * @property ?int $order_id
 * @property int $client_id
 * @property int $status_id
 * @property string $name
 * @property ?string $phone
 * @property ?string $comment
 * @property Store $store
 * @property-read OrderStatus $status
 * @property-read Client $client
 * @property-read string $storeColor
 */
#[ScopedBy([RecentFirstScope::class])]
class Request extends Model
{
    use HasFactory;
    use StoreColor;

    protected $fillable = [
        'order_id',
        'client_id',
        'status_id',
        'name',
        'phone',
        'comment',
        'store'
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
}
