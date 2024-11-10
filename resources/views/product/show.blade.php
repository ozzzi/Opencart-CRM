@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">
            {{ $productWildbear->name }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">{{ __('main.home') }} /</a>
                </li>
                <li class="font-medium text-primary">
                    <a class="font-medium" href="{{ route('products.index') }}">{{ __('product.title') }}</a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default">
                <div class="py-4 px-6.5">
                    <h3 class="font-medium text-black">
                        Wildbear
                    </h3>
                </div>

                <div class="text-gray-900 bg-white border border-gray-200">
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.model') }}: <strong>{{ $productWildbear->model }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.sku') }}: <strong>{{ $productWildbear->sku }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.price') }}: <strong>{{ priceFormat($productWildbear->price) }}</strong> грн/{{ $productWildbear->unit }}
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.quantity') }}: <strong>{{ $productWildbear->quantity }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.status') }}: <strong>@if($productWildbear->status) {{ __('product.active') }} @else {{ __('product.inactive') }} @endif</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.link') }}: <a class="text-primary" href="https://wildbear.com.ua/admin/index.php?route=catalog/product/edit&product_id={{ $productWildbear->product_id }}" target="_blank">{{ $productWildbear->name }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-9">
            <div class="rounded-sm border border-stroke bg-white shadow-default">
                <div class="py-4 px-6.5">
                    <h3 class="font-medium text-black">
                        Procord
                    </h3>
                </div>

                <div class="text-gray-900 bg-white border border-gray-200">
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.name') }}: <strong>{{ $productProcord->name }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.model') }}: <strong>{{ $productProcord->model }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.price') }}: <strong>{{ priceFormat($productProcord->price) }}</strong> грн/{{ $productWildbear->unit }}
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.quantity') }}: <strong>{{ $productProcord->quantity }}</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.status') }}: <strong>@if($productProcord->status) {{ __('product.active') }} @else {{ __('product.inactive') }} @endif</strong>
                    </div>
                    <div class="items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        {{ __('product.link') }}: <a class="text-primary" href="https://procord.com.ua/admin/index.php?route=catalog/product/edit&product_id={{ $productProcord->product_id }}" target="_blank">{{ $productProcord->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
