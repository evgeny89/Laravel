@extends('layouts.main')
@section('title', 'Новости '. $category->name)

@section('content')
    <h3>{{ __('messages.pages.news.newsInCategory', ['name' => $category->name]) }}</h3>
    <div class="p-5">
        @forelse ($news as $new)
            <div class="p-3 shadow mb-5">
                <h4 class="d-flex justify-content-between mb-3"><a href="/news/{{ $new->id }}" class="nav-link">{{ $new->title }}</a>{{ $new->created_at }}</h4>
                <p class="p-3 text-truncate fs-3">{{ $new->description }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">{{ __('messages.pages.news.author') }}
                        <a href="/user/{{ $new->author_id }}">{{ $new->author->name }}</a>
                    </p>
                    <span class="ms-5">{{ __('messages.pages.news.category') }} {{ $new->category->name }}</span>
                </div>
            </div>
        @empty
            <div class="p-3 shadow mb-5">{{ __('messages.pages.news.notNewsInCategory') }}</div>
        @endforelse
    </div>
    <div class="mb-5 pb-5">
        {{ $news->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
