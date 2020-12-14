@extends('layouts.main')
@section('title', $name)

@section('content')
    <h1 class="text-gray-400">Hello {{ $name }}</h1>
@endsection
