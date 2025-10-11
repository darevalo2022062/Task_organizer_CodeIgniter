<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#4361ee">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
  
  <title>@yield('title', 'Task Organizer')</title>
  
  @stack('styles')
</head>

<body class="d-flex flex-column">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ base_url('/') }}">
        <i class="bi bi-backpack3-fill"></i> {{ lang('App.brand') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGuest"
        aria-controls="navbarGuest" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarGuest" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item me-lg-2">
            <a class="btn btn-outline-light btn-sm" href="{{ base_url('auth/login') }}">{{ lang('App.nav.login') }}</a>
          </li>
          <li class="nav-item me-lg-2">
            <a class="btn btn-light btn-sm fw-semibold" href="{{ base_url('auth/register') }}">{{ lang('App.nav.register') }}</a>
          </li>
          <li class="nav-item">
            <div class="btn-group lang-switcher" role="group">
              <a href="{{ base_url('lang/es') }}" 
                 class="btn btn-sm {{ service('request')->getLocale() === 'es' ? 'btn-light text-primary' : 'btn-outline-light' }}">
                ES
              </a>
              <a href="{{ base_url('lang/en') }}" 
                 class="btn btn-sm {{ service('request')->getLocale() === 'en' ? 'btn-light text-primary' : 'btn-outline-light' }}">
                EN
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('hero')

  <main class="content flex-grow-1">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="py-4">
    <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
      <span class="text-muted small">&copy; {{ date('Y') }} {{ lang('App.brand') }} | {{ lang('App.footer.copyright') }}</span>
      <div class="d-flex gap-3">
        <a href="{{ base_url('terminos') }}" class="small">{{ lang('App.footer.terms') }}</a>
        <a href="{{ base_url('privacidad') }}" class="small">{{ lang('App.footer.privacy') }}</a>
        <a href="{{ base_url('contacto') }}" class="small">{{ lang('App.footer.contact') }}</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>