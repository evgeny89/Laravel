@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        <ul class="list-group w-50 mb-5">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
                    {{ $category->name }}
                    <div class="d-flex align-items-center">
                        <a href="/admin/delCategory/{{ $category->id }}" class="nav-link badge bg-primary">delete soft</a>
                        <a href="/admin/delCategory/{{ $category->id }}/1" class="nav-link badge bg-primary mx-3">delete hard</a>
                        <span class="badge bg-primary badge-pill">{{ $category->news_count }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
        @isset($status)
            <h4 class="text-center mb-5">{{ $status }}</h4>
        @endisset
        <form method="POST" action="/admin/saveCat" class="col-4">
            @csrf
            <input class="w-100 p-2 mb-5 bg-transparent border-0 shadow-lg bg-gradient" type="text" name="name">
            <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">Save</button>
        </form>
    </div>
@endsection
