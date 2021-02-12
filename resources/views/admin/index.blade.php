@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-4 shadow mb-5">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        <div class="p-3 shadow mb-5">
            <a href="{{ route('parser', ['name' => 'lenta']) }}" class="mx-2">{{ __('messages.pages.admin.lenta') }}</a>
            <a href="{{ route('parser', ['name' => 'yandex']) }}" class="mx-2">{{ __('messages.pages.admin.yandex') }}</a>
        </div>
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
                                <span class="badge bg-warning">{{ __('messages.pages.admin.deleted', ['data' => $new->deleted_at]) }}</span>
                            </div>
                        @endif
                    </div>
                    <span>{{ $new->created_at }}</span>
                </div>
                <p class="p-4 text-truncate fs-3">{{ $new->description }}</p>
                <div class="d-flex justify-content-between">
                    <p class="ms-3">{{ __('messages.pages.news.author') }}
                        <a href="/user/{{ $new->author_id }}">{{ $new->author->name }}</a>
                    </p>
                    <span class="ms-5">{{ __('messages.pages.news.category') }} <a
                            href="/news/categories/{{ $new->category_id }}">{{ $new->category->name }}</a></span>
                </div>
                <div class="mt-3">
                    @if($new->category->deleted_at)
                        <p class="nav-link badge bg-danger">{{ __('messages.pages.admin.categoryIsDeleted') }}</p>
                    @else
                        @if($new->status === 'added')
                            <a href="/admin/publish/{{ $new->id }}" class="nav-link badge bg-warning">{{ __('messages.pages.admin.publish') }}</a>
                        @else
                            <a href="/admin/publish/{{ $new->id }}/1" class="nav-link badge bg-primary">{{ __('messages.pages.admin.cancelPublish') }}</a>
                        @endif
                    @endif
                    <a href="/admin/edit/{{ $new->id }}" class="nav-link badge bg-primary">{{ __('messages.pages.admin.edit') }}</a>
                        @if($new->deleted_at)
                            @if($new->category->deleted_at)
                                <p class="nav-link badge bg-danger">{{ __('messages.pages.admin.categoryIsDeleted') }}</p>
                            @else
                                <a href="/admin/restore/{{ $new->id }}" class="nav-link badge bg-warning">{{ __('messages.pages.admin.restore') }}</a>
                            @endif
                        @else
                            <a href="/admin/delNews/{{ $new->id }}" class="nav-link badge bg-primary">{{ __('messages.pages.admin.softDelete') }}</a>
                        @endif
                    <a href="/admin/delNews/{{ $new->id }}/1" class="nav-link badge bg-danger ms-3">{{ __('messages.pages.admin.hardDelete') }}</a>
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
