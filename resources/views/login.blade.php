@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')
    <form method="POST" action="/login" class="p-5 col-3 m-auto shadow w-50 d-flex flex-column">
        @csrf
        <input class="mb-5 m-auto p-3 bg-transparent border-0 shadow-lg bg-gradient w-50" type="text" name="login" placeholder="login">
        <input class="mb-5 m-auto p-3 bg-transparent border-0 shadow-lg bg-gradient w-50" type="password" name="password" placeholder="password">
        <button class="btn btn-primary d-block m-auto p-3 w-25 shadow-sm" type="submit">Log In</button>
        <p class="mt-3 m-auto p-3">или <a href="/registration">зарегистроваться</a></p>
    </form>
@endsection
