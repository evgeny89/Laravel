@extends('layouts.main')
@section('title', $news->title ?? 'error')

@section('content')
    @if($news)
        <div class="p-5 shadow">
            <div class="border-t p-6">
                <h3>{{ $news->title }} {{ $news->created_at }}</h3>
                <p class="p-2 fs-4">{{ $news->description }}</p>
                <div class="d-flex justify-content-between">
                    <p>автор: <a href="/user/{{ $news->author_id }}">{{ $news->author_id }}</a></p
                    <span class="ms-5">категория: <a
                            href="/news/categories/{{ $news->category_id }}">{{ $news->category->name }}</a></span>
                </div>
            </div>
        </div>
    @endif
@endsection
