<div class="{{ $containerClass }}">
    <label
        for="{{ $id }}"
        class="block mb-2 text-sm font-medium text-gray-900"
    >
        {{ $placeholder }}
    </label>
    <textarea
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
        placeholder="{{ $placeholder }}"
    >@if (!is_null($value)){{ $value }}@endif</textarea>
    @error($name)<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
</div>
