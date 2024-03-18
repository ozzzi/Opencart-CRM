<?php

declare(strict_types=1);

namespace Modules\Request\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Request\Model\Request;

class RequestRepository
{
    public function list(): LengthAwarePaginator
    {
        return Request::query()
            ->with(['status'])
            ->paginate();
    }

    public function show(int $id): Request
    {
        return Request::query()->findOrFail($id);
    }

    public function findWhere(array $criteria): Collection
    {
        return Request::query()
            ->where([$criteria])
            ->get();
    }

    public function store(array $data): Request
    {
        return Request::query()->create($data);
    }

    public function update(int $id, array $data): int
    {
        return Request::query()
            ->where('id', $id)
            ->update($data);
    }

    public function delete(int $id): int
    {
        return Request::destroy($id);
    }
}
