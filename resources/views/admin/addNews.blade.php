@extends('layouts.main')
@section('title', 'Добавить новость')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @if(session('status'))
            <h3 class="text-center mb-5">{{ session('status') }}</h3>
        @endif
        @if(count($categories) > 0)
            <form method="POST" action="/admin/save" class="col-8">
                @csrf
                <input type="hidden" name="author_id" value="{{ $author_id }}">
                <label for="category">{{ __('messages.pages.news.category') }}</label>
                <div class="form-group">
                    @if($errors->has('category_id'))
                        <div class="alert alert-danger p-2">
                            @foreach($errors->get('category_id') as $error)
                                <p class="m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <select name="category_id"
                            class="form-control text-white mb-3 bg-transparent border-0 shadow-lg bg-gradient"
                            id="category">
                        @foreach($categories as $category)
                            <option class="bg-transparent bg-gradient text-dark"
                                    value="{{ $category->id }}"
                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="source">{{ __('messages.pages.news.source') }}</label>
                    <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                           name="source" id="source" placeholder="source" value="{{ old('source') }}">
                </div>
                <div class="form-group">
                    <label for="title">{{ __('messages.pages.news.title') }}</label>
                    @if($errors->has('title'))
                        <div class="alert alert-danger p-2">
                            @foreach($errors->get('title') as $error)
                                <p class="m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                           name="title" id="title" placeholder="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="news">{{ __('messages.pages.news.text') }}</label>
                    @if($errors->has('description'))
                        <div class="alert alert-danger p-2">
                            @foreach($errors->get('description') as $error)
                                <p class="m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <textarea class="form-control text-white mb-4 bg-transparent border-0 shadow-lg bg-gradient"
                              name="description"
                              rows="10" id="news">{{ old('news') }}</textarea>
                </div>
                <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">Save</button>
            </form>
        @else
                <div class="m-2 list-group-item bg-transparent border-0 shadow-lg bg-gradient">
                    <h4 class="d-flex justify-content-between align-items-center">
                        {{ __('messages.pages.admin.notCategory') }}
                        <a href="/admin/category/add" class="nav-link">{{ __('messages.pages.admin.addCategory') }}</a>
                    </h4>
                </div>
        @endif
    </div>
@endsection
