@extends('layouts.main')

@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            @for ($i = 1; $i <= $num; $i++)
                <div class="p-6">
                    <div class="shadow text-gray-600 dark:text-gray-400 text-lg">
                        This {{ $i }} News of {{ $num }}
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
