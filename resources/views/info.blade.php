@extends('layouts.main')
@section('title', 'Info')

@section('content')
    <?php
        phpinfo();
    ?>
@endsection
