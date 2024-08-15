<div class="{{ $containerClass }}">
    @if($isLabel)
        <label
            for="{{ $id }}"
            class="block mb-2 text-sm font-medium text-gray-900"
        >
            {{ $placeholder }}
        </label>
    @endif
        <select
            @if ($name) name="{{ $name }}" @endif
            @if ($id) id="{{ $id }}" @endif
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            @if($required) required @endif
        >
            @if(!$isLabel)
                <option value="">{{ $placeholder }}</option>
            @else
                <option value=""></option>
            @endif
            @foreach($options as $option)
                <option
                    value="{{ $optionValue($option) }}"
                    @selected($isSelected($optionValue($option)))
                >
                    {{ $optionLabel($option) }}
                </option>
            @endforeach
        </select>
</div>
