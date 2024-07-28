@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            {{ __('actions.editing') }}
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

    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <x-form action="{{ route('requests.update', $request->id) }}" method="put">
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-2">
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                    <x-inputs.input
                        name="name"
                        :value="$request->name"
                        placeholder="{{ __('fields.name') }}"
                    />
                    <x-inputs.input
                        name="phone"
                        :value="$request->phone"
                        placeholder="{{ __('fields.phone') }}"
                    />
                    <x-inputs.textarea
                        name="comment"
                        :value="$request->comment"
                        placeholder="{{ __('fields.comment') }}"
                    />
                    <x-inputs.select
                        name="status_id"
                        placeholder="{{ __('fields.status') }}"
                        value_field="external_id"
                        :options="$statuses"
                        :value="$request->status_id"
                    />
                    <x-inputs.select
                        name="store"
                        placeholder="{{ __('fields.store') }}"
                        :options="$stores"
                        :value="$request->store->value"
                    />

                    <x-buttons.button type="submit" color="blue">{{ __('actions.save') }}</x-buttons.button>
                </div>
            </div>
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default">
                    <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                        <h3 class="font-medium text-black dark:text-white">
                            {{ __('shipment.ttn') }}
                        </h3>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5">
                        <div class="flex gap-2">
                            <div class="flex-none">
                                <x-inputs.select
                                    name="shipment[type]"
                                    placeholder="{{ __('shipment.title') }}"
                                    :isLabel="true"
                                    :options="$shipments"
                                    :value="$trackingType"
                                />
                            </div>
                            <div class="grow">
                                <label for="input-number" class="block mb-2 text-sm font-medium text-gray-900">
                                    {{ __('shipment.number') }}
                                </label>
                                <input type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="shipment[number]" placeholder="{{ __('shipment.number') }}"
                                       value="{{ $trackingNumber }}"
                                       id="input-number">
                                @error('shipment.number')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-form>
@endsection
