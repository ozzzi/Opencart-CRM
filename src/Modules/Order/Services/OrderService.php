<?php

declare(strict_types=1);

namespace Modules\Order\Services;

use App\Enums\Store;
use Modules\Client\Data\ClientData;
use Modules\Client\Data\ContactsData;
use Modules\Client\Enums\ContactType;
use Modules\Client\Services\ClientCreateService;
use Modules\Order\Data\OrderData;
use Modules\Order\Data\OrderProductData;
use Modules\Order\Models\Order;
use Modules\Order\Repositories\ExternalOrderRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Request\Data\RequestData;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Services\RequestCreateService;

class OrderService
{
    public function __construct(
        private readonly RequestRepository $requestRepository,
        private readonly OrderRepository $orderRepository,
    ) {
    }

    public function sync(Store $store): void
    {
        $externalOrderRepository = new ExternalOrderRepository($store);

        $externalOrderRepository->listLazy()
            ->each(function ($order) use ($store, $externalOrderRepository) {
                $existRequest = $this->requestRepository->findWhere(['order_id', $order->order_id]);

                if ($existRequest->count()) {
                    return;
                }

                $orderCreated = $this->importOrder($order, $externalOrderRepository, $store);

                $clientId = $this->importClient($order, $store);

                $this->importRequest(
                    new RequestData(
                        orderId: (int) $order->order_id,
                        clientId: $clientId,
                        statusId: $orderCreated->status_id,
                        name: $orderCreated->name,
                        phone: $orderCreated->phone,
                        comment: $orderCreated->comment,
                        store: $store,
                    )
                );
            });
    }

    private function importOrder(object $order, ExternalOrderRepository $externalOrderRepository, Store $store): Order
    {
        $products = $externalOrderRepository->products($order->order_id);
        $productData = [];

        foreach ($products as $product) {
            $productData[] = new OrderProductData(
                orderId: (int) $order->order_id,
                productId: (int) $product->product_id,
                name: $product->name,
                model: $product->model,
                quantity: (int) $product->quantity,
                price: (float) $product->price
            );
        }

        $orderStatusId = $externalOrderRepository->statusId($order->order_id);

        $clientName = sprintf('%s %s', $order->firstname, $order->lastname);

        return $this->orderRepository->store(
            new OrderData(
                orderId: (int) $order->order_id,
                store: $store,
                name: $clientName,
                email: $order->email,
                phone: $order->telephone,
                paymentMethod: $order->payment_method,
                shippingMethod: trim(strip_tags($order->shipping_method)),
                shippingCity: $order->shipping_city,
                shippingZone: $order->shipping_zone,
                comment: $order->comment,
                total: (float) $order->total,
                statusId: $orderStatusId,
                dateAdded: $order->date_added,
                products: $productData
            )
        );
    }

    private function importClient(object $order, Store $store): int
    {
        $service = app()->make(ClientCreateService::class);

        $contactData = [];
        $clientName = sprintf('%s %s', $order->firstname, $order->lastname);

        if ($order->email) {
            $contactData[] = new ContactsData(
                type: ContactType::Email,
                value: $order->email
            );
        }

        if ($order->telephone) {
            $contactData[] = new ContactsData(
                type: ContactType::Phone,
                value: $order->telephone
            );
        }

        $address = sprintf(
            '%s %s',
            $order->shipping_address_1,
            $order->shipping_address_2
        );

        $data = new ClientData(
            name: $clientName,
            address: $address,
            isBad: false,
            store: $store,
            contacts: $contactData
        );

        return $service($data);
    }

    private function importRequest(RequestData $data): void
    {
        $service = app()->make(RequestCreateService::class);

        $service($data);
    }
}
