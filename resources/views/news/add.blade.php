@extends('layouts.empty')
@section('title', 'Добавить новость')

@section('content')
    <div class="my-8 overflow-hidden shadow sm:rounded-lg p-6">
        @isset($save)
            <p class="text-center">Сохранено</p>
        @endisset
        <form method="POST" action="/news/save">
            @csrf
            <input class="mx-auto p-6 mb-12" type="text" name="title" placeholder="title">
            <textarea class="mx-auto p-6 mb-12" name="news" cols="80" rows="10"></textarea>
            <button class="mx-auto p-6 border" type="submit">Save</button>
        </form>
    </div>
@endsection
