@extends('layouts.main')
@section('title', 'Список новостей')

@section('content')
    <div class="p-4">
        @forelse($news as $new)
            <div class="p-3 shadow mb-5">
                <h4 class="d-flex justify-content-between mb-3"><a href="news/{{ $new->id }}"
                                                                   class="nav-link">{{ $new->title }}</a>
                    <span>{{ $new->created_at }}</span></h4>
                <p class="p-4 text-truncate fs-3">{{ $new->description }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">{{ __('messages.pages.news.author') }}
                        <a href="/user/{{ $new->author_id }}">{{ $new->author->name }}</a>
                    </p>
                    <span class="ms-5">{{ __('messages.pages.news.category') }}
                        <a href="/news/categories/{{ $new->category_id }}">{{ $new->category->name }}</a>
                    </span>
                </div>
            </div>
        @empty
            <div class="p-3 shadow mb-5">{{ __('messages.pages.main.notNews') }}</div>
        @endforelse
    </div>
    <div class="mb-5 pb-5">
        {{ $news->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
