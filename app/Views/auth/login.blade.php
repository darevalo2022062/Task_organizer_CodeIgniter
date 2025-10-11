@extends('layouts.main')

@section('title', lang('App.auth.login.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h3 class="mb-0">{{ lang('App.auth.login.title') }}</h3>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('errors'))
                            <div class="alert alert-warning mb-3">
                                <ul class="mb-0">
                                    @foreach (session('errors') as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <form method="post" action="{{ route_to('auth.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ lang('App.auth.login.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus
                                    value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ lang('App.auth.login.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label"
                                    for="remember">{{ lang('App.auth.login.remember_me') }}</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                {{ lang('App.auth.login.submit') }}
                            </button>
                        </form>
                    </div>

                    <div class="card-footer text-center py-3">
                        <a href="{{ route_to('auth.register') }}">{{ lang('App.auth.login.register_link') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection