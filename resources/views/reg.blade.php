@extends('layouts.main')
@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="/registration" class="p-5 col-3 m-auto shadow w-50 d-flex flex-column">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">{{ __('messages.pages.other.login') }}</label>
            <input type="text" name="name" class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" placeholder="login">
            @if($errors->has('name'))
                <div class="alert alert-danger p-2">
                    @foreach($errors->get('name') as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">{{ __('messages.pages.other.email') }}</label>
            <input type="email" name="email" class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" placeholder="name@example.com">
            @if($errors->has('email'))
                <div class="alert alert-danger p-2">
                    @foreach($errors->get('email') as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="mb-5">
            <label for="exampleFormControlInput1" class="form-label">{{ __('messages.pages.other.password') }}</label>
            <input class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light" type="password" name="password" placeholder="password">
            @if($errors->has('password'))
                <div class="alert alert-danger p-2">
                    @foreach($errors->get('password') as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <button class="btn btn-primary d-block m-auto w-25 shadow-sm" type="submit">{{ __('messages.pages.other.registration') }}</button>
    </form>
@endsection
