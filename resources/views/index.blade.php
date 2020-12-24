@extends('layouts.main')
@section('title', 'Главная')

@section('content')
        <h3 class="my-5">Последние новости на сайте:</h3>
        @foreach ($news as $new)
            <div class="p-4 shadow mb-5">
                <h4 class="d-flex justify-content-between"><a href="news/{{ $new['id'] }}" class="nav-link">{{ $new['title'] }}</a> <span>{{ $new['date'] }}</span></h4>
                <p class="p-3 text-truncate fs-3">{{ $new['text'] }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">автор: {{ $new['author_id'] }}</p><span class="ms-5">категория: <a href="{{ $new['category_id']['path'] }}">{{ $new['category_id']['name'] }}</a></span>
                </div>
            </div>
        @endforeach
@endsection

