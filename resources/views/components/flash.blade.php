@php
    $type = flash()->type();
@endphp

@if($message = flash()->get())
    @if ($type === 'info')
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
             {{ $message->message }}
        </div>
    @elseif ($type === 'danger')
        <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-red-800 border-red-300 bg-red-50" role="alert">
            {{ $message->message }}
        </div>
    @elseif ($type === 'success')
        <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-green-800 border-green-300 bg-green-50" role="alert">
            {{ $message->message }}
        </div>
    @else
        <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-yellow-800 border-yellow-300 bg-yellow-50" role="alert">
            {{ $message->message }}
        </div>
    @endif
@endif
