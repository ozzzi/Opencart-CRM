<?php

namespace App\Http\Requests\Client;

use App\Enums\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Client\Enums\ContactType;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'comment' => ['nullable', 'string'],
            'is_bad' => ['nullable', 'boolean'],
            'store' => ['required', Rule::enum(Store::class)],
            'contacts' => ['required', 'array'],
            'contacts.*.type' => ['required', Rule::enum(ContactType::class)],
            'contacts.*.value' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('fields.name'),
            'address' => __('fields.address'),
            'comment' => __('fields.comment'),
            'is_bad' => __('fields.is_bad'),
            'store' => __('fields.store'),
            'contacts' => __('fields.contact'),
            'contacts.*.type' => __('fields.type'),
            'contacts.*.value' => __('fields.contact'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'store.required' => __('validation.required'),
            'contacts.required' => __('validation.required'),
            'contacts.*.type.required' => __('validation.required'),
            'contacts.*.value.required' => __('validation.required'),
        ];
    }
}
