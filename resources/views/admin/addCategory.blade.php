@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        <ul class="list-group w-75 mb-5">
            @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
                    {{ $category->name }}
                    <div class="d-flex align-items-center justify-content-between w-25">
                        @if($category->deleted_at)
                            <a href="/admin/restoreCategory/{{ $category->id }}" class="nav-link badge bg-warning">{{ __('messages.pages.admin.restore') }}</a>
                        @else
                            <a href="/admin/delCategory/{{ $category->id }}" class="nav-link badge bg-primary">{{ __('messages.pages.admin.softDelete') }}</a>
                        @endif
                        <a href="/admin/delCategory/{{ $category->id }}/1" class="nav-link badge bg-warning mx-3">{{ __('messages.pages.admin.hardDelete') }}</a>
                        <span class="badge bg-primary badge-pill">{{ $category->news_count }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
        @isset($status)
            <h4 class="text-center mb-5">{{ $status }}</h4>
        @endisset
        <form method="POST" action="/admin/saveCat" class="col-6">
            @csrf
            <input class="w-100 p-2 mb-5 bg-transparent border-0 shadow-lg bg-gradient" type="text" name="name">
            <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">{{ __('messages.pages.admin.save') }}</button>
        </form>
    </div>
@endsection
