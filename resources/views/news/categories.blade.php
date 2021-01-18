@extends('layouts.main')
@section('title', 'Список категорий')

@section('content')
    <h3 class="p-2">Категории:</h3>
    <div class="p-3 list-group">
        @forelse ($categories as $cat)
            <div class="m-2 list-group-item bg-transparent border-0 shadow-lg bg-gradient">
                <h4 class="d-flex justify-content-between align-items-center">
                    <a href="/news/categories/{{ $cat->id }}" class="nav-link">{{ $cat->name }}</a>
                    <span class="badge bg-primary badge-pill">{{ $cat->news_count }}</span>
                </h4>
            </div>
        @empty
            <div class="p-3 shadow mb-5">Категорий нет</div>
        @endforelse
    </div>
@endsection
