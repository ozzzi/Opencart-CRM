<div class="{{ $containerClass }}">
    @if($isLabel)
        <label
            for="{{ $id }}"
            class="block mb-2 text-sm font-medium text-gray-900"
        >
            {{ $placeholder }}
        </label>
    @endif
    <input
        type="{{ $type }}"
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        @if (!is_null($value)) value="{{ $value }}" @endif
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
    />
    @error($name)<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
