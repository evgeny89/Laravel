@extends('layouts.main')
@section('title', $user->name)

@section('content')
    <h1 class="p-3 shadow">{{ __('messages.pages.personal.hello') }} <span
            class=" text-primary">{{ $user->name }}</span></h1>
    <p class="p-2 shadow">{{ __('messages.pages.personal.yourEmail') }} <b class="text-info">{{ $user->email }}</b></p>
    @if(!$user->social_id)
        <p class="p-2 shadow"><a href="/login/social/steam"
                                 class="nav-link">{{ __('messages.pages.personal.social', ['name' => 'steam']) }}</a>
        </p>
    @endif
    <h4 class="p-3">{{ __('messages.pages.personal.yourNews') }}</h4>
    @forelse ($user->news as $news)
        <div class="p-4 shadow mb-5">
            <h4 class="d-flex justify-content-between"><a href="news/{{ $news->id }}"
                                                          class="nav-link">{{ $news->title }}</a>
                <span>{{ $news->created_at }}</span></h4>
            <p class="p-3 text-truncate fs-3">{{ $news->description }}</p>
            <div class="d-flex">
                <span class="ms-5">{{ __('messages.pages.news.category') }}
                        <a href="/news/categories/{{ $news->category_id }}">{{ $news->category->name }}</a>
                    </span>
            </div>
        </div>
    @empty
        <div class="p-4 shadow mb-5">{{ __('messages.pages.main.notNews') }}</div>
    @endforelse
@endsection
