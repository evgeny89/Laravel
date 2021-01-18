@extends('layouts.main')
@section('title', 'Главная')

@section('content')
        <h3 class="my-5">Последние новости на сайте:</h3>
        @forelse ($news as $new)
            <div class="p-4 shadow mb-5">
                <h4 class="d-flex justify-content-between"><a href="news/{{ $new->id }}" class="nav-link">{{ $new->title }}</a> <span>{{ $new->created_at }}</span></h4>
                <p class="p-3 text-truncate fs-3">{{ $new->description }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">автор:
                        <a href="/user/{{ $new->author_id }}">{{ $new->author->name }}</a>
                    </p>
                    <span class="ms-5">категория:
                        <a href="/news/categories/{{ $new->category_id }}">{{ $new->category->name }}</a>
                    </span>
                </div>
            </div>
        @empty
            <div class="p-4 shadow mb-5">Новостей нет</div>
        @endforelse
@endsection

