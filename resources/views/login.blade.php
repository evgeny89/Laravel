@extends('layouts.empty')

@section('content')
    <div class="my-8 overflow-hidden shadow sm:rounded-lg p-6">
        <form method="POST" action="/">
            @csrf
            <input class="mx-auto p-6 mb-12" type="text" name="login" placeholder="login">
            <input class="mx-auto p-6 mb-12" type="password" name="password" placeholder="password">
            <button class="mx-auto p-6 w-100 border" type="submit">Log In</button>
        </form>
    </div>
@endsection
