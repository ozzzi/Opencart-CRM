<?php

namespace App\Http\Controllers\Client;

use App\Enums\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Client\Enums\ContactType;
use Modules\Client\Repositories\ClientContactRepository;
use Modules\Client\Repositories\ClientRepository;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly ClientContactRepository $clientContactRepository
    ) {
    }

    public function index(Request $request): Response
    {
        $allowedFilters = [
            'name',
            'contact',
            'address',
            'is_bad',
            'store',
        ];

        $filterData = $request->only($allowedFilters);
        $clients = $this->clientRepository->list($filterData);

        $filters = [];

        foreach ($allowedFilters as $filter) {
            $filters[$filter] = $request->input($filter);
        }

        $stores = array_column(Store::cases(), 'value');

        return Inertia::render('Client/Index', compact('clients', 'filters', 'stores'));
    }

    public function create(): Response
    {
        $types = ContactType::cases();
        $stores = Store::cases();

        return Inertia::render('Client/Create', compact('types', 'stores'));
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $client = $this->clientRepository->store([
                'name' => $data['name'],
                'address' => $data['address'] ?? '',
                'comment' => $data['comment'] ?? '',
                'is_bad' => $data['is_bad'] ?? false,
                'store' => $data['store'],
            ]);
            $this->clientContactRepository->storeMany($client, $data['contacts']);
        });

        flash()->success(__('client.created'));

        return redirect()->route('clients.index');
    }

    public function edit(int $id): Response
    {
        $client = $this->clientRepository->show($id);
        $contacts = $this->clientContactRepository->list($client);
        $types = ContactType::cases();
        $stores = Store::cases();

        return Inertia::render(
            'Client/Edit',
            compact(
                'client',
                'contacts',
                'types',
                'stores'
            )
        );
    }

    public function update(int $id, ClientRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($id, $request) {
            $data = $request->validated();

            $this->clientRepository->update($id, [
                'name' => $data['name'],
                'address' => $data['address'] ?? '',
                'comment' => $data['comment'] ?? '',
                'is_bad' => $data['is_bad'] ?? false,
                'store' => $data['store'],
            ]);

            foreach ($data['contacts'] as $contactId => $contact) {
                $this->clientContactRepository->update($id, $contactId, $contact);
            }
        });

        flash()->success(__('client.updated'));

        return redirect()->route('clients.index');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->clientRepository->delete($id);

        flash()->success(__('client.deleted'));

        return redirect()->route('clients.index');
    }
}
