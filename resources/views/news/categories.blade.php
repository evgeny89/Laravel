@extends('layouts.main')
@section('title', 'Список категорий')

@section('content')
    <h3 class="p-2">Категории:</h3>
    <div class="p-3 d-flex justify-content-between">
        @foreach ($categories as $cat)
            <div class="m-2">
                <h4><a href="{{ $cat['path'] }}" class="nav-link">{{ $cat['name'] }}</a></h4>
            </div>
        @endforeach
    </div>
@endsection
