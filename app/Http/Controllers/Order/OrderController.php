<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Order\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function index(): Response
    {
        $orders = $this->orderRepository->list();

        return Inertia::render('Order/Index', compact('orders'));
    }

    public function show(int $id): Response
    {
        $order = $this->orderRepository->show($id);

        return Inertia::render('Order/Show', compact('order'));
    }
}
