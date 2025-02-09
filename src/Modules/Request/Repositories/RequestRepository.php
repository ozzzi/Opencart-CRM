<?php

declare(strict_types=1);

namespace Modules\Request\Repositories;

use App\Enums\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\LazyCollection;
use Modules\Request\Model\Filters\RequestFilter;
use Modules\Request\Model\Request;

class RequestRepository
{
    public function list(array $filters = []): LengthAwarePaginator
    {
        return Request::filter(new RequestFilter($filters))
            ->with(['status', 'tracking'])
            ->orderByDesc('date_added')
            ->paginate()
            ->withQueryString();
    }

    public function listNotCompleted(Store $store): LazyCollection
    {
        return Request::query()
            ->whereNotIn('status_id', config('store.status_completed')[$store->value])
            ->lazyById();
    }

    public function show(int $id): Request
    {
        return Request::query()->findOrFail($id);
    }

    public function findWhere(array $criteria): Collection
    {
        return Request::query()
            ->where($criteria)
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
