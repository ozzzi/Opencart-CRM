<?php

namespace App\Http\Controllers\Request;

use App\Enums\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request\RequestRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Data\ClientData;
use Modules\Client\Data\ContactsData;
use Modules\Client\Enums\ContactType;
use Modules\Client\Services\ClientCreateService;
use Modules\OrderStatus\Repositories\OrderStatusRepository;
use Modules\Request\Data\RequestData;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Services\RequestCreateService;

class RequestController extends Controller
{
    public function __construct(private readonly RequestRepository $requestRepository)
    {
    }

    public function index(): View
    {
        $requests = $this->requestRepository->list();

        return view('request.index', compact('requests'));
    }

    public function create(OrderStatusRepository $orderStatusRepository): View
    {
        $stores = Store::cases();
        $statuses = $orderStatusRepository->list();

        return view('request.create', compact('stores', 'statuses'));
    }

    public function store(
        RequestRequest $request,
        ClientCreateService $clientService,
        RequestCreateService $requestCreateService
    ): RedirectResponse {
        $data = $request->validated();

        if (empty($data['client_id']) && !empty($data['phone'])) {
            $clientData = new ClientData(
                name: $data['name'],
                address: $data['address'] ?? '',
                isBad: $data['is_bad'] ?? false,
                store: Store::from($data['store']),
                contacts: [
                    new ContactsData(
                        type: ContactType::Phone,
                        value: $data['phone']
                    ),
                ]
            );

            $clientId = $clientService($clientData);
        } else {
            $clientId = null;
        }

        $requestCreateService(new RequestData(
            order_id: $data['order_id'] ?? null,
            client_id: $clientId,
            status_id: $data['status_id'],
            name: $data['name'],
            phone: $data['phone'] ?? null,
            comment: $data['comment'] ?? null,
            store: Store::from($data['store'])
        ));

        flash()->success(__('request.created'));

        return redirect()->route('requests.index');
    }

    public function edit(int $id, OrderStatusRepository $orderStatusRepository): View
    {
        $request = $this->requestRepository->show($id);

        $stores = Store::cases();
        $statuses = $orderStatusRepository->list();

        return view('request.edit', compact('request', 'stores', 'statuses'));
    }

    public function update(int $id, RequestRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->requestRepository->update($id, $data);

        flash()->success(__('request.updated'));

        return redirect()->route('requests.index');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->requestRepository->delete($id);

        flash()->success(__('request.deleted'));

        return redirect()->route('requests.index');
    }
}
