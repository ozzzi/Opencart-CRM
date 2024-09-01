<?php

declare(strict_types=1);

namespace Modules\Client\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Client\Models\Client;
use Modules\Client\Models\ClientContact;

class ClientContactRepository
{
    /**
     * @return Collection<ClientContact>
     */
    public function list(Client $client): Collection
    {
        return $client->contacts()->get();
    }

    public function show(int $id): Model
    {
        return ClientContact::query()->findOrFail($id);
    }

    /**
     * @param string[] $values
     * @return Model|null
     */
    public function search(array $values): Model|null
    {
        return ClientContact::query()->whereIN('value', $values)->first();
    }

    public function store(Client $client, array $data): Model
    {
        return $client->contacts()->create($data);
    }

    public function storeMany(Client $client, array $data): Collection
    {
        return $client->contacts()->createMany($data);
    }

    public function update(int $clientId, ?int $contactId, array $data): void
    {
        if ($contactId === null) {
            ClientContact::query()
                ->create([
                    'client_id' => $clientId,
                    'type' => $data['type'],
                    'value' => $data['value']
                ]);
        } else {
            ClientContact::query()
                ->where('id', $contactId)
                ->update($data);
        }
    }

    public function delete(int $id): int
    {
        return ClientContact::destroy($id);
    }

    public function deleteAll(Client $client): int
    {
        return $client->contacts()->delete();
    }
}
