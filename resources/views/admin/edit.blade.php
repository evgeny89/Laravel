@extends('layouts.main')
@section('title', 'Редактировать новость')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @isset($status)
            <h3 class="text-center mb-5">{{ $status }}</h3>
        @endisset
        <form method="POST" action="/admin/edit/{{ $news->id }}" class="col-4">
            @csrf
            <div class="form-group">
                <label for="category">Категория:</label>
                <select name="category"
                        class="form-control text-white mb-3 bg-transparent border-0 shadow-lg bg-gradient"
                        id="category">
                    @foreach($categories as $category)
                        <option class="bg-transparent bg-gradient text-dark"
                                value="{{ $category->id }}"
                            {{ $news->acegory_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="source">Источник:</label>
                <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                       name="source" id="source" placeholder="source" value="{{ $news->source }}">
            </div>
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input class="w-100 text-white p-2 mb-3 bg-transparent border-0 shadow-lg bg-gradient" type="text"
                       name="title" id="title" placeholder="title" value="{{ $news->title }}">
            </div>
            <div class="form-group">
                <label for="news">Текст:</label>
                <textarea class="form-control text-white mb-4 bg-transparent border-0 shadow-lg bg-gradient"
                          name="description"
                          rows="5" id="news">{{ $news->description }}</textarea>
            </div>
            <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">Save</button>
        </form>
    </div>
@endsection
