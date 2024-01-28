<?php

namespace App\Http\Controllers\Client;

use App\Enums\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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

    public function index(): View
    {
        $clients = $this->clientRepository->list();

        return view('client.index', compact('clients'));
    }

    public function create(): View
    {
        $types = ContactType::cases();
        $stores = Store::cases();

        return view('client.create', compact('types', 'stores'));
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

    public function edit(int $id): View
    {
        $client = $this->clientRepository->show($id);
        $contacts = $this->clientContactRepository->list($client);
        $types = ContactType::cases();
        $stores = Store::cases();

        return view('client.edit', compact(
            'client',
            'contacts',
            'types',
            'stores'
        ));
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
