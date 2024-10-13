<?php

namespace App\Http\Controllers\Request;

use App\Enums\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request\RequestRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Client\Data\ClientData;
use Modules\Client\Data\ContactsData;
use Modules\Client\Enums\ContactType;
use Modules\Client\Services\ClientCreateService;
use Modules\OrderStatus\Repositories\OrderStatusRepository;
use Modules\Request\Data\RequestData;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Services\RequestCreateService;
use Modules\Shipment\Enums\Shipment;
use Modules\Shipment\Repositories\TrackingRepository;
use Throwable;

class RequestController extends Controller
{
    public function __construct(
        private readonly RequestRepository $requestRepository,
        private readonly OrderStatusRepository $orderStatusRepository
    ) {
    }

    public function index(Request $request): View
    {
        $allowedFilters = [
            'date_from',
            'date_to',
            'name',
            'phone',
            'store',
            'status',
            'not_completed',
        ];

        $filterData = $request->only($allowedFilters);
        $requests = $this->requestRepository->list($filterData);

        $filters = [];

        foreach ($allowedFilters as $filter) {
            $filters[$filter] = $request->input($filter);
        }

        $stores = array_column(Store::cases(), 'value');
        $statuses = $this->orderStatusRepository->list()->toArray();

        return view('request.index', compact('requests', 'filters', 'stores', 'statuses'));
    }

    public function create(): View
    {
        $stores = Store::cases();
        $statuses = $this->orderStatusRepository->list();

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
            orderId: $data['order_id'] ?? null,
            orderIdExt: null,
            clientId: $clientId,
            statusId: $data['status_id'],
            name: $data['name'],
            phone: $data['phone'] ?? null,
            comment: $data['comment'] ?? null,
            store: Store::from($data['store']),
            dateAdded: Carbon::now()->format('Y-m-d H:i:s')
        ));

        flash()->success(__('request.created'));

        return redirect()->route('requests.index');
    }

    public function edit(int $id, OrderStatusRepository $orderStatusRepository): View
    {
        $request = $this->requestRepository->show($id);
        $trackingType = $request->tracking->type->value ?? null;
        $trackingNumber = $request->tracking->number ?? null;

        $stores = Store::cases();
        $shipments = collect(Shipment::cases());
        $statuses = $orderStatusRepository->list();

        return view('request.edit', compact(
            'request',
            'stores',
            'statuses',
            'shipments',
            'trackingType',
            'trackingNumber',
        ));
    }

    /**
     * @throws Throwable
     */
    public function update(int $id, RequestRequest $request, TrackingRepository $trackingRepository): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($trackingRepository, $id, $data) {
            if (\array_key_exists('shipment', $data)) {
                $shipmentData = $data['shipment'];
                unset($data['shipment']);
            }

            $this->requestRepository->update($id, $data);

            if (isset($shipmentData['number'])) {
                $trackingRepository->upsert([
                    'request_id' => $id,
                    'type' => $shipmentData['type'],
                    'number' => $shipmentData['number'],
                ]);
            }
        });


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
