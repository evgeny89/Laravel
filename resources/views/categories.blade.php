@extends('layouts.main')

@section('content')
    <div class="my-8 sm:rounded-lg  flex">
        @foreach ($categories as $cat)
            <div class="shadow mx-4 px-6 ml-2 mr-2">
                <h4><a href="{{ $cat['path'] }}">{{ $cat['name'] }}</a></h4>
            </div>
        @endforeach
    </div>
@endsection
