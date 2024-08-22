@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">
            {{ __('order.title') }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">{{ __('main.home') }} /</a>
                </li>
                <li class="font-medium text-primary">{{ __('order.title') }}</li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">order_id</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.store') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.name') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.phone') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.status') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.total') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.date_created') }}</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4">{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->order_id }}</td>
                                <td class="px-6 py-4">
                                    <x-badge type="{{ $order->storeColor }}">{{ $order->store->value }}</x-badge>
                                </td>
                                <td class="px-6 py-4">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>
                                <td class="px-6 py-4">{{ $order->status->name }}</td>
                                <td class="px-6 py-4">{{ $order->total }}</td>
                                <td class="px-6 py-4">{{ $order->date_added }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="px-3 py-2 text-green-700 border border-green-700 hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs text-center inline-flex items-center me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
