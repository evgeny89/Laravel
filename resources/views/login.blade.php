@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')
    <form method="POST" action="/auth" class="p-5 col-3 m-auto shadow w-50">
        @csrf
        <input class="d-block mb-5 m-auto p-3 bg-transparent border-0 shadow-lg bg-gradient w-50" type="text" name="login" placeholder="login" value="{{ old('login') }}">
        <input class="d-block mb-5 m-auto p-3 bg-transparent border-0 shadow-lg bg-gradient w-50" type="password" name="password" placeholder="password">
        <button class="btn btn-primary d-block m-auto p-3 w-25 shadow-sm" type="submit">Log In</button>
    </form>
@endsection
