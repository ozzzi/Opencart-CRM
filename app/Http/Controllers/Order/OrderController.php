<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Order\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function index(): View
    {
        $orders = $this->orderRepository->list();

        return view('order.index', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = $this->orderRepository->show($id);

        return view('order.show', compact('order'));
    }

    public function showByOrderId(int $orderId): View
    {
        $order = $this->orderRepository->showByOrderId($orderId);

        return view('order.show', compact('order'));
    }
}
