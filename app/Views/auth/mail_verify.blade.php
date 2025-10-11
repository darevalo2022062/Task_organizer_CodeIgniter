@extends('layouts.main')

@section('title', lang('App.auth.mail_verify.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-envelope fa-3x text-primary"></i>
                        </div>
                        <h3 class="mb-0">{{ lang('App.auth.mail_verify.title') }}</h3>
                    </div>

                    <div class="card-body p-4 text-center">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <p class="mb-3">{{ lang('App.auth.mail_verify.instruction') }}</p>
                        <p class="mb-4">{{ lang('App.auth.mail_verify.check_email') }}</p>

                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ lang('App.auth.mail_verify.spam_notice') }}
                        </div>

                        <form action="{{ route_to('auth.verification.resend') }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-redo me-2"></i>
                                {{ lang('App.auth.mail_verify.resend_button') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection