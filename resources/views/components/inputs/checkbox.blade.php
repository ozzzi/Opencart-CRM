<div class="flex items-center {{ $containerClass }}">
    <input
        @if($value) checked @endif
        @if($name) name="{{ $name }}" @endif
        id="{{ $id }}"
        type="checkbox"
        value="1"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
    >
    <label for="{{ $id }}"
           class="ms-2 text-sm font-medium text-gray-900 ">{{ $placeholder }}</label>
</div>
