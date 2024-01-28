@extends('layouts.app')

@section('content')
    <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-blue-800 border-blue-300 bg-blue-50" role="alert">
            Info
    </div>

    <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-red-800 border-red-300 bg-red-50" role="alert">
        Danger
    </div>

    <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-green-800 border-green-300 bg-green-50" role="alert">
        Success
    </div>

    <div class="flex items-center p-4 mb-4 text-sm border rounded-lg text-yellow-800 border-yellow-300 bg-yellow-50" role="alert">
        Warning
    </div>
@endsection
