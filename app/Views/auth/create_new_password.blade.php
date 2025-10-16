@extends('layouts.main')

@section('title', lang('App.auth.new_password.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h3 class="mb-0">{{ lang('App.auth.new_password.title') }}</h3>
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
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="post" action="{{ route_to('auth.process_new_password') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id ?? '' }}">
                            <input type="hidden" name="token" value="{{ $token ?? '' }}">

                            <div class="mb-4">
                                <p class="text-muted">{{ lang('App.auth.new_password.instructions') }}</p>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ lang('App.auth.new_password.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" required 
                                    placeholder="{{ lang('App.auth.new_password.password_placeholder') }}"
                                    minlength="8">
                                <div class="form-text">{{ lang('App.auth.new_password.password_help') }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">{{ lang('App.auth.new_password.password_confirm') }}</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required
                                    placeholder="{{ lang('App.auth.new_password.password_confirm_placeholder') }}">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                {{ lang('App.auth.new_password.submit') }}
                            </button>

                            <div class="text-center">
                                <a href="{{ route_to('auth.login') }}" class="btn btn-link">
                                    {{ lang('App.auth.new_password.back_to_login') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection