<?php

declare(strict_types=1);

namespace Modules\Client\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Client\Models\Client;

class ClientRepository
{
    /**
     * @return LengthAwarePaginator<Client>
     */
    public function list(): LengthAwarePaginator
    {
        return Client::query()
            ->with('contacts')
            ->paginate();
    }

    public function show(int $id): Client
    {
        return Client::query()->findOrFail($id);
    }

    public function store(array $data): Client
    {
        return Client::query()->create($data);
    }

    public function update(int $id, array $data): int
    {
        return Client::query()
            ->where('id', $id)
            ->update($data);
    }

    public function delete(int $id): int
    {
        return Client::destroy($id);
    }
}
