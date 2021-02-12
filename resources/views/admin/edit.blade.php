@extends('layouts.main')
@section('title', 'Редактировать новость')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        <form method="POST" action="/admin/edit/{{ $news->id }}" class="col-8">
            @csrf
            <input type="hidden" name="author_id" value="{{ $author_id }}">
            <div class="form-group">
                <label for="category">{{ __('messages.pages.news.category') }}</label>
                <select name="category_id"
                        class="form-control text-white mb-3 bg-transparent border-0 shadow-lg bg-gradient"
                        id="category">
                    @foreach($categories as $category)
                        <option class="bg-transparent bg-gradient text-dark"
                                value="{{ $category->id }}"
                            {{ $news->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <div class="alert alert-danger p-2">
                        @foreach($errors->get('category_id') as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="source">{{ __('messages.pages.news.source') }}</label>
                <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                       name="source" id="source" placeholder="source" value="{{ $news->source }}">
                @if($errors->has('source'))
                    <div class="alert alert-danger p-2">
                        @foreach($errors->get('source') as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="title">{{ __('messages.pages.news.title') }}</label>
                <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                       name="title" id="title" placeholder="title" value="{{ $news->title }}">
                @if($errors->has('title'))
                    <div class="alert alert-danger p-2">
                        @foreach($errors->get('description') as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="news">{{ __('messages.pages.news.text') }}</label>
                <textarea class="form-control text-white mb-4 bg-transparent border-0 shadow-lg bg-gradient"
                          name="description"
                          rows="10" id="news">{{ $news->description }}</textarea>
                @if($errors->has('description'))
                    <div class="alert alert-danger p-2">
                        @foreach($errors->get('description') as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto">{{ __('messages.pages.admin.save') }}</button>
        </form>
    </div>
@endsection
