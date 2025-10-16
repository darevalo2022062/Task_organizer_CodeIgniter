@extends('layouts.dashboard_layout')

@section('title', lang('App.dashboard.title'))

@section('content')
    <div class="container">
        <h1>{{ lang('App.dashboard.welcome') }}, {{ session('name') }}!</h1>
    </div>
@endsection