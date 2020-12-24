@extends('layouts.main')
@section('title', $news['title'])

@section('content')
    <div class="my-8 overflow-hidden shadow sm:rounded-lg">
            <div class="border-t p-6">
                <h4>{{ $news['title'] }} ({{ $news['date'] }})</h4>
                <p>{{ $news['text'] }}</p>
                <p class="mt-8">автор: {{ $news['author_id'] }} <span class="ml-12">категория: <a
                            href="{{ $news['category_id']['path'] }}">{{ $news['category_id']['name'] }}</a></span></p>
            </div>
    </div>
@endsection
