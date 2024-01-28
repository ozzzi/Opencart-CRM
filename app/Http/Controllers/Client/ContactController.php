<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ContactRequest;
use App\Http\Resources\Clients\ContactResource;
use App\Support\Traits\JsonResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Client\Repositories\ClientContactRepository;
use Modules\Client\Repositories\ClientRepository;

class ContactController extends Controller
{
    use JsonResponser;

    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly ClientContactRepository $clientContactRepository
    ) {
    }

    public function list(int $clientId): AnonymousResourceCollection
    {
        $client = $this->clientRepository->show($clientId);
        $contacts = $this->clientContactRepository->list($client);

        return ContactResource::collection($contacts);
    }

    public function store(int $clientId, ContactRequest $request): JsonResponse
    {
        $data = $request->validated();

        $client = $this->clientRepository->show($clientId);
        $contact = $this->clientContactRepository->store($client, $data);

        return $this->success($contact);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->clientContactRepository->delete($id);

        return $this->success($result);
    }
}
