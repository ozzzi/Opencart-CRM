<?php

declare(strict_types=1);

namespace Modules\Shipment\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Modules\Shipment\Enums\Shipment;

/**
 * @property int $id
 * @property int $request_id
 * @property Shipment $type
 * @property string $number
 * @property string $delivered
 * @property string $received
 * @property string $canceled
 * @property bool $expired
 * @property-read string $color
 * @property-read string $title
 */
class Tracking extends Model
{
    protected $fillable = [
        'request_id',
        'type',
        'number',
        'delivered',
        'received',
        'canceled',
        'expired'
    ];

    protected $casts = [
        'type' => Shipment::class,
    ];

    public function color(): Attribute
    {
        return Attribute::make(
            get: function () {
                return match ($this->type) {
                    Shipment::NovaPoshta => 'red',
                };
            }
        );
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: function () {
                return match ($this->type) {
                    Shipment::NovaPoshta => 'Nova',
                };
            }
        );
    }
}
