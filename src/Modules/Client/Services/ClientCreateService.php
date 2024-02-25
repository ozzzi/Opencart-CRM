<?php

declare(strict_types=1);

namespace Modules\Client\Services;

use Illuminate\Support\Facades\DB;
use Modules\Client\Data\ClientData;
use Modules\Client\Repositories\ClientContactRepository;
use Modules\Client\Repositories\ClientRepository;

class ClientCreateService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly ClientContactRepository $clientContactRepository
    ) {
    }

    /**
     * @throws \Throwable
     */
    public function __invoke(ClientData $data): int
    {
        try {
            DB::beginTransaction();

            $client = $this->clientRepository->store([
                'name' => $data->name,
                'address' => $data->address ?? '',
                'comment' => $data->comment ?? '',
                'is_bad' => $data->isBad ?? false,
                'store' => $data->store,
            ]);

            foreach ($data->contacts as $contact) {
                $this->clientContactRepository->store($client, [
                    'type' => $contact->type,
                    'value' => $contact->value
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $client->id;
    }
}
