@extends('layouts.main')
@section('title', 'Главная')

@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <h3>Последние новости на сайте:</h3>
        @foreach ($news as $new)
            <div class="border-t py-4">
                <h4><a href="news/{{ $new['id'] }}">{{ $new['title'] }}</a> ({{ $new['date'] }})</h4>
                <p>{{ $new['text'] }}</p>
                <p class="mt-8">автор: {{ $new['author_id'] }} <span class="ml-12">категория: <a href="{{ $new['category_id']['path'] }}">{{ $new['category_id']['name'] }}</a></span></p>
            </div>
        @endforeach
    </div>
@endsection

