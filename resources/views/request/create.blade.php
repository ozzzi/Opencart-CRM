@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            {{ __('actions.creating') }}
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

    <x-form action="{{ route('requests.store') }}">
        <div class="grid grid-cols-2 gap-6">
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                    <x-inputs.input
                        name="name"
                        placeholder="{{ __('fields.name') }}"
                    />
                    <x-inputs.input
                        name="phone"
                        placeholder="{{ __('fields.phone') }}"
                    />
                    <x-inputs.textarea
                        name="comment"
                        placeholder="{{ __('fields.comment') }}"
                    />
                    <x-inputs.select
                        name="status_id"
                        placeholder="{{ __('fields.status') }}"
                        value_field="external_id"
                        :options="$statuses"
                    />
                    <x-inputs.select
                        name="store"
                        placeholder="{{ __('fields.store') }}"
                        :options="$stores"
                    />

                    <x-buttons.button type="submit" color="blue">{{ __('actions.save') }}</x-buttons.button>
                </div>
            </div>
        </div>
    </x-form>
@endsection
