@extends('layouts.main')
@section('title', $name)

@section('content')
    <h1 class="p-3 shadow">Hello {{ $name }}</h1>
@endsection
