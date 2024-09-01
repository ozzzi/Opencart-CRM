<?php

declare(strict_types=1);

namespace Modules\Client\Services;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Modules\Client\Data\ClientData;
use Modules\Client\Data\ContactsData;
use Modules\Client\Enums\ContactType;
use Modules\Client\Models\ClientContact;
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
        $clientId = $this->searchByContacts($data);

        if ($clientId) {
            return $clientId;
        }

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

    private function searchByContacts(ClientData $data): int
    {
        $queryContact = ClientContact::query()
            ->select('client_id');

        $values = array_map(static function (ContactsData $contact) {
            if ($contact->type === ContactType::Phone) {
                try {
                    $value = phoneNormalise($contact->value);
                } catch (InvalidArgumentException) {
                    $value = $contact->value;
                }
            } else {
                $value = $contact->value;
            }

            return $value;
        }, $data->contacts);

        $queryContact->whereIn('value', $values);

        return (int) $queryContact->value('client_id');
    }
}
