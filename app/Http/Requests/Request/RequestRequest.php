<?php

namespace App\Http\Requests\Request;

use App\Enums\Store;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Shipment\Enums\Shipment;

class RequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => ['nullable', 'exists:orders,id'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'status_id' => ['required', 'exists:order_statuses,external_id'],
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'min:10'],
            'comment' => ['nullable'],
            'store' => ['required', Rule::enum(Store::class)],
            'shipment' => ['nullable', 'array:type,number'],
            'shipment.type' => ['nullable', Rule::enum(Shipment::class)],
            'shipment.number' => ['required_with:shipment.type'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('fields.name'),
            'phone' => __('fields.phone'),
            'comment' => __('fields.comment'),
            'store' => __('fields.store'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'store.required' => __('validation.required'),
        ];
    }
}
