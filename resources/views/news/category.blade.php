@extends('layouts.main')
@section('title', 'Новости '. $name)

@section('content')
    <h3>Новости из категории: {{ $name }}</h3>
    <div class="p-5">
        @foreach ($news as $new)
            <div class="p-3 shadow mb-5">
                <h4 class="d-flex justify-content-between mb-3"><a href="/news/{{ $new['id'] }}" class="nav-link">{{ $new['title'] }}</a>{{ $new['date'] }}</h4>
                <p class="p-3 text-truncate fs-3">{{ $new['text'] }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">автор: {{ $new['author_id'] }}</p><span class="ms-5">категория: <a href="{{ $new['category_id']['path'] }}">{{ $new['category_id']['name'] }}</a></span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
