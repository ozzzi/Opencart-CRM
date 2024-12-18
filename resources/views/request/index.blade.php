@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">
            {{ __('request.title') }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">{{ __('main.home') }} /</a>
                </li>
                <li class="font-medium text-primary">{{ __('request.title') }}</li>
            </ol>
        </nav>
    </div>

    <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5 mb-4">
        <form action="" id="filter">
            <div class="flex gap-3">
                <div>
                    <input type="date" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" name="date_from" value="{{ $filters['date_from'] }}">
                </div>
                <div>
                    <input type="date" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" name="date_to" value="{{ $filters['date_to'] }}">
                </div>
                <div>
                    <input type="text"class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" name="name" value="{{ $filters['name'] }}" placeholder="{{ __('fields.name') }}">
                </div>
                <div>
                    <input type="text" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" name="phone" value="{{ $filters['phone'] }}" placeholder="{{ __('fields.phone') }}">
                </div>
            </div>
            <div class="flex gap-3 mt-3">
                <div>
                    <label for="store" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('fields.store') }}</label>
                    <select id="store" name="store" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        <option></option>
                        @foreach($stores as $store)
                            <option value="{{ $store }}" @selected($filters['store'] === $store)>{{ $store }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('fields.status') }}</label>
                    <select id="status" name="status" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        <option></option>
                        @foreach($statuses as $status)
                            <option value="{{ $status['external_id'] }}" @selected($status['external_id'] === (int) $filters['status'])>{{ $status['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-1">
                    <label for="new_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('fields.new_status') }}</label>
                    <input type="checkbox" id="new_status" name="not_completed" @checked($filters['not_completed']) class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                </div>
            </div>
            <div class="mt-3">
                <x-buttons.button type="submit" color="blue">{{ __('actions.search') }}</x-buttons.button>
                <button type="reset" onclick="document.getElementById('filter').reset().submit();"
                        class="btn btn-danger btn-sm">{{ __('actions.reset') }}
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                <div class="my-5">
                    <x-buttons.link type="blue" href="{{ route('requests.create') }}">{{ __('actions.create') }}</x-buttons.link>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-5">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">id</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.store') }}</th>
                            <th scope="col" class="py-3"></th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.order') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.status') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.name') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.phone') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('fields.date_created') }}</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr @if($request->isNew) class="bg-blue-400" @endif>
                                <td class="px-6 py-4">{{ $request->id }}</td>
                                <td class="px-6 py-4">
                                    <x-badge type="{{ $request->storeColor }}">{{ $request->store->value }}</x-badge>
                                </td>
                                <td class="py-4">
                                    @if($request->tracking)
                                        <span class="bg-{{ $request->tracking->color }}-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                            {{ $request->tracking->title }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($request->order_id)
                                        <a href="{{ route('orders.show', $request->order_id) }}">{{ $request->order_id }}</a>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $request->status?->name }}</td>
                                <td class="px-6 py-4">{{ $request->name }}</td>
                                <td class="px-6 py-4">{{ $request->phone }}</td>
                                <td class="px-6 py-4 text-xs">{{ $request->date_added }}</td>
                                <td class="px-6 py-4 text-right">
                                    <x-form action="{{ route('requests.delete', $request->id) }}" method="delete">
                                        <a href="{{ route('requests.edit', $request->id) }}" class="px-3 py-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs text-center inline-flex items-center me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>

                                        <button type="submit" class="px-3 py-2 text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs text-center inline-flex items-center me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </x-form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $requests->links() }}
            </div>
        </div>
    </div>
@endsection
