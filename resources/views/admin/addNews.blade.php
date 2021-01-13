@extends('layouts.main')
@section('title', 'Добавить новость')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @isset($status)
            <h3 class="text-center mb-5">{{ $status }}</h3>
        @endisset
        @if(count($categories) > 0)
            <form method="POST" action="/admin/save" class="col-8">
                @csrf
                <input type="hidden" name="author_id" value="{{ $author_id }}">
                <div class="form-group">
                    <label for="category">Категория:</label>
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
                    <label for="source">Источник:</label>
                    <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                           name="source" id="source" placeholder="source" value="{{ old('source') }}">
                </div>
                <div class="form-group">
                    <label for="title">Заголовок:</label>
                    <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                           name="title" id="title" placeholder="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="news">Текст:</label>
                    <textarea class="form-control text-white mb-4 bg-transparent border-0 shadow-lg bg-gradient"
                              name="description"
                              rows="10" id="news">{{ old('news') }}</textarea>
                </div>
                <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">Save</button>
            </form>
        @else
                <div class="m-2 list-group-item bg-transparent border-0 shadow-lg bg-gradient">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Нет ни одной категории!
                        <a href="/admin/category/add" class="nav-link">Добавить категорию</a>
                    </h4>
                </div>
        @endif
    </div>
@endsection
