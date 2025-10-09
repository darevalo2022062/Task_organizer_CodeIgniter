<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0d6efd">
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <title>@yield('title', 'Task Organizer')</title>
  <style>
    :root {
      --hero-grad: radial-gradient(1200px 600px at 20% -10%, rgba(13, 110, 253, .25), transparent), radial-gradient(800px 400px at 90% 10%, rgba(32, 201, 151, .15), transparent);
    }

    body {
      min-height: 100vh;
      background-image: var(--hero-grad);
      background-attachment: fixed;
    }

    .navbar {
      box-shadow: 0 2px 16px rgba(0, 0, 0, .15);
    }

    .hero {
      padding: 4rem 0 2rem;
    }

    .hero .card {
      border: 0;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
    }

    .content {
      padding: 2rem 0 3rem;
    }

    footer {
      border-top: 1px solid rgba(255, 255, 255, .15);
    }
  </style>
  @stack('styles')
</head>

<body class="d-flex flex-column">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ base_url('/') }}">
        <i class="bi bi-star-fill"></i> Task Organizer - WebApp
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGuest"
        aria-controls="navbarGuest" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarGuest" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="{{ base_url('features') }}">Características</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ base_url('precios') }}">Precios</a></li>
          <li class="nav-item me-lg-2"><a class="btn btn-outline-light btn-sm" href="{{ base_url('login') }}">Iniciar
              sesión</a></li>
          <li class="nav-item"><a class="btn btn-light btn-sm text-primary fw-semibold"
              href="{{ base_url('register') }}">Crear cuenta</a></li>
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
      <span class="text-muted small">&copy; {{ date('Y') }} Mi App. Todos los derechos reservados.</span>
      <div class="d-flex gap-3">
        <a href="{{ base_url('terminos') }}"
          class="link-light link-underline-opacity-0 link-underline-opacity-100-hover small">Términos</a>
        <a href="{{ base_url('privacidad') }}"
          class="link-light link-underline-opacity-0 link-underline-opacity-100-hover small">Privacidad</a>
        <a href="{{ base_url('contacto') }}"
          class="link-light link-underline-opacity-0 link-underline-opacity-100-hover small">Contacto</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>