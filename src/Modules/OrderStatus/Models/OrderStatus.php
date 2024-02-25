<?php

declare(strict_types=1);

namespace Modules\OrderStatus\Models;

use App\Enums\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $external_id
 * @property Store $store
 * @property string $name
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'store',
        'name',
    ];

    protected $casts = [
        'store' => Store::class,
    ];
}
