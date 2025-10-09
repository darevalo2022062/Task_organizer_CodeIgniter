@extends('layouts.main')

@section('title', lang('App.home.title'))

@section('hero')
<section class="hero">
  <div class="container">
    <div class="row align-items-center min-vh-75">
      <div class="col-lg-6 fade-in-up">
        <h1 class="display-4 fw-bold mb-4">{{ lang('App.home.hero.title') }}</h1>
        <p class="lead mb-4">{{ lang('App.home.hero.subtitle') }}</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="{{ base_url('register') }}" class="btn btn-primary btn-lg">
            {{ lang('App.home.hero.cta_primary') }} <i class="bi bi-arrow-right ms-2"></i>
          </a>
          <a href="{{ base_url('features') }}" class="btn btn-outline-primary btn-lg">
            {{ lang('App.home.hero.cta_secondary') }}
          </a>
        </div>
      </div>
      <div class="col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
        <div class="card p-4">
          <img src="<?= base_url('assets/img/dashboard-preview.png') ?>" 
               alt="Task Organizer Dashboard" 
               class="img-fluid rounded-3 shadow-sm">
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('content')
<section class="features py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="h1 text-gradient mb-3">{{ lang('App.home.features.title') }}</h2>
      <p class="lead text-muted">{{ lang('App.home.features.subtitle') }}</p>
    </div>
    
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="bi bi-kanban"></i>
          </div>
          <h4>{{ lang('App.home.features.1.title') }}</h4>
          <p class="text-muted">{{ lang('App.home.features.1.description') }}</p>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="bi bi-clock"></i>
          </div>
          <h4>{{ lang('App.home.features.2.title') }}</h4>
          <p class="text-muted">{{ lang('App.home.features.2.description') }}</p>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="bi bi-graph-up"></i>
          </div>
          <h4>{{ lang('App.home.features.3.title') }}</h4>
          <p class="text-muted">{{ lang('App.home.features.3.description') }}</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection