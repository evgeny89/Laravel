@extends('layouts.main')
@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="/registration" class="p-5 col-3 m-auto shadow w-50 d-flex flex-column">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Login</label>
            <input type="text" name="name" class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" placeholder="login">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" placeholder="name@example.com">
        </div>
        <div class="mb-5">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" type="password" name="password" placeholder="password">
        </div>
        <button class="btn btn-primary d-block m-auto w-25 shadow-sm" type="submit">Регистрация</button>
    </form>
@endsection
