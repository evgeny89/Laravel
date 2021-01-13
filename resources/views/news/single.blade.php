@extends('layouts.main')
@section('title', $news['title'])

@section('content')
    <div class="p-5 shadow">
            <div class="border-t p-6">
                <h3>{{ $news['title'] }} {{ $news['date'] }}</h3>
                <p class="p-2 fs-4">{{ $news['text'] }}</p>
                <div class="d-flex justify-content-between">
                    <p>автор: <a href="/user/{{ $news['author_id'] }}">{{ $news['author_id'] }}</a></p><span class="ms-5">категория: <a href="{{ $news['category_id']['path'] }}">{{ $news['category_id']['name'] }}</a></span>
                </div>
            </div>
    </div>
@endsection
