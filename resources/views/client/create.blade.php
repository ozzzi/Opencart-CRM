@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black">
            {{ __('actions.creating') }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="/">{{ __('main.home') }} /</a>
                </li>
                <li class="font-medium text-primary">{{ __('client.title') }}</li>
            </ol>
        </nav>
    </div>

    <x-form action="{{ route('clients.store') }}">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default py-4 px-6.5">
                    <x-inputs.input
                        name="name"
                        placeholder="{{ __('fields.name') }}"
                    />
                    <x-inputs.input
                        name="address"
                        placeholder="{{ __('fields.address') }}"
                    />
                    <x-inputs.textarea
                        name="comment"
                        placeholder="{{ __('fields.comment') }}"
                    />
                    <x-inputs.select
                        name="store"
                        placeholder="{{ __('fields.store') }}"
                        :options="$stores"
                    />
                    <x-inputs.checkbox
                        name="is_bad"
                        placeholder="{{ __('fields.is_bad') }}"
                    />

                    <x-buttons.button type="submit" color="blue">{{ __('actions.save') }}</x-buttons.button>
                </div>
            </div>
            <div class="flex flex-col gap-9">
                <div class="rounded-sm border border-stroke bg-white shadow-default">
                    <div class="border-b border-stroke py-4 px-6.5">
                        <h3 class="font-medium text-black">
                            {{ __('client.contacts') }}
                        </h3>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5"
                         x-data="{
                            contacts: [],
                            type: '',
                            contact: '',
                            add() {
                                this.contacts.push({type: this.type, contact: this.contact});
                            },
                            remove(index) {this.contacts.splice(index, 1)}
                         }">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">{{ __('fields.contact') }}</th>
                                    <th scope="col" class="px-6 py-3"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(contact, index) in contacts" :key="index">
                                    <tr class="bg-white" >
                                        <td class="px-6 py-4">
                                            <span x-text="contact.contact"></span>
                                            <input type="hidden" :name="`contacts[${index}][type]`" :value="contact.type">
                                            <input type="hidden" :name="`contacts[${index}][value]`" :value="contact.contact">
                                        </td>
                                        <td class="py-4 text-right">
                                            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg font-medium text-xs p-2.5 text-center inline-flex items-center me-2"
                                                    @click.prevent="remove(index)"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex-none">
                                <select
                                        x-model="type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                                    <option value="">{{ __('fields.type') }}</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grow">
                                <input type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                       x-model="contact"
                                       placeholder="{{ __('fields.contact') }}"
                                />
                            </div>
                            <div class="flex-none">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg font-medium text-xs p-2.5 text-center inline-flex items-center me-2"
                                    @click.prevent="add()"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('contacts')<div class="mt-2 text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
    </x-form>
@endsection
