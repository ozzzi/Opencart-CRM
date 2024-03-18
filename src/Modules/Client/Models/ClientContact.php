<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Client\Enums\ContactType;

/**
 * @property int $id
 * @property int $client_id
 * @property ContactType::class $type
 * @property string $value
 */
class ClientContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',
        'value',
    ];

    protected $casts = [
        'type' => ContactType::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function value(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($this->type === ContactType::Phone) {
                    return preg_replace('/\D/', '', $value);
                }

                return $value;
            },
        );
    }
}
