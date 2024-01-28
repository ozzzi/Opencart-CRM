<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Client\Enums\ContactType;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(ContactType::class)],
            'value' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'type' => __('fields.type'),
            'value' => __('fields.contact'),
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => __('validation.required'),
            'value.required' => __('validation.required'),
        ];
    }
}
