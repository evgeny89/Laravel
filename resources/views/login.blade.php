@extends('layouts.main')
@section('title', 'Авторизация')

@section('content')
    @if(session('status'))
        <h3 class="text-center mb-5">{{ session('status') }}</h3>
    @endif
    <form method="POST" action="/login" class="p-5 col-3 m-auto shadow w-50 d-flex flex-column">
        @csrf
        <div class="mb-3">
            <input class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light px-3" type="text"
                   name="name"
                   placeholder="login" value="{{ old('name') }}">
            @if($errors->has('name'))
                <div class="alert alert-danger p-2">
                    @foreach($errors->get('name') as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="mb-3">
            <input class="form-control bg-transparent border-0 shadow-lg bg-gradient text-light px-3" type="password"
                   name="password"
                   placeholder="password">
            @if($errors->has('password'))
                <div class="alert alert-danger p-2">
                    @foreach($errors->get('password') as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="remember" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                {{ __('messages.pages.other.rememberMe') }}
            </label>
        </div>
        <button class="btn btn-primary m-auto p-2 shadow-sm w-25 mb-5"
                type="submit">{{ __('messages.pages.other.comeIn') }}</button>
        <div class="m-auto">
            <a href="/login/social/steam" class="nav-link">{{ __('messages.pages.other.social', ['name' => 'steam']) }}</a>
        </div>
        <p class="m-auto"><a href="/registration">{{ __('messages.pages.other.singUp') }}</a></p>
    </form>
@endsection
