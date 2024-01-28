<?php

namespace Modules\Client\Models;

use App\Enums\Store;
use App\Support\Traits\StoreColor;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Client\Enums\ContactType;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $comment
 * @property bool $is_bad
 * @property Store $store
 * @property-read string $phone
 * @property-read string $email
 * @property-read string $storeColor
 * @property-read Collection $contacts
 */
class Client extends Model
{
    use HasFactory;
    use StoreColor;

    protected $fillable = [
        'name',
        'address',
        'comment',
        'is_bad',
        'store',
    ];

    protected $casts = [
        'is_bad' => 'boolean',
        'store' => Store::class,
    ];

    /**
     * @return HasMany<ClientContact>
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(ClientContact::class);
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->contacts?->where('type', ContactType::Email)->value('value');
            },
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->contacts?->where('type', ContactType::Phone)->value('value');
            },
        );
    }
}
