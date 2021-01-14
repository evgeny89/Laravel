@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-4 shadow mb-5">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        @forelse($news as $new)
            <div class="p-3 shadow mb-5">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <h4 class="d-flex align-items-center">
                            <a href="/news/{{ $new->id }}" class="nav-link">{{ $new->title }}</a>
                            <span class="badge bg-primary mx-4">{{ $new->status }}</span>
                        </h4>
                        @if($new->deleted_at)
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="badge bg-warning">удалено: {{ $new->deleted_at }}</span>
                            </div>
                        @endif
                    </div>
                    <span>{{ $new->created_at }}</span>
                </div>
                <p class="p-4 text-truncate fs-3">{{ $new->description }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">автор: {{ $new->author_id }}</p><span class="ms-5">категория: <a
                            href="/news/categories/{{ $new->category_id }}">{{ $new->category->name }}</a></span>
                </div>
                <div class="mt-3">
                    @if($new->category->deleted_at)
                        <p class="nav-link badge bg-danger">категория новости удалена</p>
                    @else
                        @if($new->status === 'added')
                            <a href="/admin/publish/{{ $new->id }}" class="nav-link badge bg-warning">опубликовать</a>
                        @else
                            <a href="/admin/publish/{{ $new->id }}/1" class="nav-link badge bg-primary">отменить публикацию</a>
                        @endif
                    @endif
                    <a href="/admin/edit/{{ $new->id }}" class="nav-link badge bg-primary">edit</a>
                        @if($new->deleted_at)
                            @if($new->category->deleted_at)
                                <p class="nav-link badge bg-danger">категория новости удалена</p>
                            @else
                                <a href="/admin/restore/{{ $new->id }}" class="nav-link badge bg-warning">востановить</a>
                            @endif
                        @else
                            <a href="/admin/delNews/{{ $new->id }}" class="nav-link badge bg-primary">delete soft</a>
                        @endif
                    <a href="/admin/delNews/{{ $new->id }}/1" class="nav-link badge bg-danger ms-3">delete hard</a>
                </div>
            </div>
        @empty
            <div class="p-3 shadow mb-5">Новостей нет</div>
        @endforelse
    </div>
    <div class="mb-5 pb-5">
        {{ $news->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
