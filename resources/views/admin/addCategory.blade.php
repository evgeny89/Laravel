@extends('layouts.main')
@section('title', 'Админка')

@section('content')
    <div class="p-5 shadow d-flex justify-content-center flex-column align-items-center">
        @isset($save)
            <h3 class="text-center mb-5">Сохранено</h3>
        @endisset
        <form method="POST" action="/admin/saveCat" class="col-4">
            @csrf
            <input class="w-100 p-2 mb-5 bg-transparent border-0 shadow-lg bg-gradient" type="text" name="name">
            <button class="p-2 w-25 btn btn-secondary bg-gradient d-block m-auto" type="submit">Save</button>
        </form>
    </div>
@endsection
