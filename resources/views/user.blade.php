@extends('layouts.main')
@section('title', $user->name)

@section('content')
    <h1 class="p-3 shadow">Hello <span class=" text-primary">{{ $user->name }}</span></h1>
    <p class="p-2 shadow">Your e-mail address: <b class="text-info">{{ $user->email }}</b></p>
@endsection
