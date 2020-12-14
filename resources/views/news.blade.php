@extends('layouts.main')
@section('title', 'Список новостей')

@section('content')
    <div class="my-8 sm:rounded-lg">
        @foreach ($news as $new)
            <div class="p-6 shadow mt-8">
                <h4><a href="news/{{ $new['id'] }}">{{ $new['title'] }}</a> ({{ $new['date'] }})</h4>
                <p>{{ $new['text'] }}</p>
                <p class="mt-8">автор: {{ $new['author_id'] }} <span class="ml-12">категория: <a
                            href="{{ $new['category_id']['path'] }}">{{ $new['category_id']['name'] }}</a></span></p>
            </div>
        @endforeach
    </div>
@endsection
