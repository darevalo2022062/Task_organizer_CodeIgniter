<!doctype html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#4361ee">

  <!-- Bootswatch Lux -->
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- App CSS -->
  <link href="{{ base_url('assets/css/app.css') }}" rel="stylesheet">

  <title>@yield('title', 'Task Organizer')</title>

  @stack('styles')

  <style>
    :root{
      --app-primary:#4361ee;
      --app-primary-soft: rgba(208, 213, 236, 0.12);
      --app-radius: 16px;
    }
    html,body{font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";}

    .skip-link{
      position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;
    }
    .skip-link:focus{
      position:static; width:auto; height:auto; padding:.5rem .75rem; z-index:1051;
      background:#fff; border-radius:.5rem; box-shadow:0 6px 18px rgba(0,0,0,.15);
    }

    .navbar-glass .nav-link{
      border-radius: 999px;
      padding: .45rem .9rem;
      transition: transform .15s ease, background-color .15s ease, color .15s ease;
    }
    .navbar-glass .nav-link:hover{
      background: var(--app-primary-soft);
      transform: translateY(-1px);
    }
    

    .avatar-pill{
      display:inline-flex; align-items:center; gap:.5rem;
      padding:.35rem .65rem; border-radius:999px; background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12); color:#f8f9fa;
      transition: background .15s ease;
      color: #ffffff !important;
    }
    .avatar-pill:hover{ background: rgba(255,255,255,.12); }

    .offcanvas-modern{
      border-top-left-radius: 16px; border-top-right-radius: 16px;
    }
    @media (min-width: 992px){
      .offcanvas-modern{ border-radius: 16px; }
    }
    .list-group-nav .list-group-item{
      display:flex; align-items:center; gap:.75rem; border:0;
      padding:.75rem 1rem; border-radius:12px; margin-bottom:.25rem;
    }
    .list-group-nav .list-group-item:hover{
      background: var(--app-primary-soft);
    }
    .list-group-nav .list-group-item.active{
      background: var(--app-primary); color:#fff;
      box-shadow: 0 8px 18px rgba(67,97,238,.25);
    }


    main.content{ padding-top: clamp(16px, 2vw, 24px); }
    .card-soft{
      border-radius: var(--app-radius);
      border:1px solid rgba(0,0,0,.06);
      box-shadow: 0 6px 22px rgba(20,20,20,.06);
    }

    /* Footer */
    footer{ border-top:1px solid rgba(0,0,0,.06); }

    /* Reduce motion respecting user preference */
    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation: none !important; }
    }
  </style>
</head>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const flashSuccess = <?= json_encode(session()->getFlashdata('success') ?? null) ?>;
    const flashError   = <?= json_encode(session()->getFlashdata('error') ?? null) ?>;
    const flashInfo    = <?= json_encode(session()->getFlashdata('info') ?? null) ?>;
    //Errors
    const flashErrors   = <?= json_encode(session()->getFlashdata('errors') ?? null) ?>;

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    if(flashErrors){
      let errorMessages = '';
      if(typeof flashErrors === 'object'){
        for(const key in flashErrors){
          if(Array.isArray(flashErrors[key])){
            flashErrors[key].forEach(msg => {
              errorMessages += `&#8226; ${msg}<br>`;
            });
          } else {
            errorMessages += `&#8226; ${flashErrors[key]}<br>`;
          }
        }
      } else {
        errorMessages = flashErrors;
      }
      Swal.fire({
        icon: 'error',
        title: 'Error',
        html: errorMessages,
        confirmButtonText: 'Cerrar'
      });
    } 

    if (flashSuccess) {
      Toast.fire({ icon: 'success', title: flashSuccess });
    } else if (flashError) {
      Toast.fire({ icon: 'error', title: flashError });
    } else if (flashInfo) {
      Toast.fire({ icon: 'info', title: flashInfo });
    }
  });
</script>


<body class="d-flex flex-column min-vh-100">
  <a href="#main-content" class="skip-link">Saltar al contenido</a>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-glass sticky-top">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ base_url('/') }}">
        <span class="brand-badge">
          <i class="bi bi-backpack3-fill"></i>
          <span>{{ lang('App.brand') ?? 'Task Organizer' }}</span>
        </span>
      </a>

       <!-- Language toggle -->
        <div class="btn-group ms-2" role="group" aria-label="Cambiar idioma">
          <a href="{{ base_url('lang/es') }}"
             class="btn btn-sm {{ service('request')->getLocale()==='es' ? 'btn-light text-primary' : 'btn-outline-light' }}">ES</a>
          <a href="{{ base_url('lang/en') }}"
             class="btn btn-sm {{ service('request')->getLocale()==='en' ? 'btn-light text-primary' : 'btn-outline-light' }}">EN</a>
        </div>

      <!-- Right actions (desktop) -->
      <div class="d-none d-lg-flex align-items-center ms-auto gap-2">
        
        <a class="nav-link {{ url_is('usuarios*') ? 'active' : '' }}" href="{{ base_url('usuarios') }}" style="color: #ffffff !important;">
            <i class="bi bi-people me-1" style="color: #ffffff !important;"></i> 
            {{ lang('App.nav.users') ?? 'Usuarios' }}
        </a>
        <a class="nav-link {{ url_is('tareas*') ? 'active' : '' }}" href="{{ base_url('tasks') }}" style="color: #ffffff !important;">
            <i class="bi bi-list-task me-1" style="color: #ffffff !important;"></i> 
            {{ lang('App.nav.tasks') ?? 'Tareas' }}
        </a>
        <a class="nav-link {{ url_is('asignaciones*') ? 'active' : '' }}" href="{{ base_url('assignments') }}" style="color: #ffffff !important;">
            <i class="bi bi-clipboard-check me-1" style="color: #ffffff !important;"></i> 
            {{ lang('App.nav.assignments') ?? 'Asignaciones' }}
        </a>
        <a class="nav-link {{ url_is('cursos*') ? 'active' : '' }}" href="{{ base_url('courses') }}" style="color: #ffffff !important;">
            <i class="bi bi-book me-1" style="color: #ffffff !important;"></i> 
            {{ lang('App.nav.courses') ?? 'Cursos' }}
        </a>

       

        <!-- User dropdown -->
        <div class="dropdown ms-2">
    <button class="btn avatar-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle"></i>
        <span class="text-truncate" style="max-width:140px;">
            {{ lang('App.nav.hello') ?? 'Hola,' }} 
            <strong>{{ session('name') ?? 'Usuario' }}</strong>
        </span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow">
        <li><a class="dropdown-item" href="{{ base_url('profile') }}"><i class="bi bi-person me-2"></i> {{ lang('App.nav.profile') ?? 'Perfil' }}</a></li>
        <li><a class="dropdown-item" href="{{ base_url('settings') }}"><i class="bi bi-gear me-2"></i> {{ lang('App.nav.settings') ?? 'Ajustes' }}</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form action="{{ base_url('logout') }}" method="POST" class="d-inline">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i> {{ lang('App.nav.logout') ?? 'Salir' }}
                </button>
            </form>
        </li>          
    </ul>
</div>

      <!-- Mobile toggler: Offcanvas -->
      <button class="navbar-toggler border-0 ms-2" type="button"
              data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav"
              aria-controls="offcanvasNav" aria-label="Abrir menú">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- OFFCANVAS (Mobile / tablet) -->
  <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title d-flex align-items-center gap-2" id="offcanvasNavLabel">
        <i class="bi bi-backpack3-fill text-primary"></i> {{ lang('App.brand') ?? 'Task Organizer' }}
      </h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <!-- User pill -->
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-person-circle fs-4 text-primary"></i>
          <div class="small">
            <div class="text-muted">{{ lang('App.nav.hello') ?? 'Hola,' }}</div>
              <strong>{{ session('name') ?? 'Usuario' }}</strong>          </div>
        </div>
        <form action="{{ base_url('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="bi bi-box-arrow-right me-1"></i> {{ lang('App.nav.logout') ?? 'Salir' }}
    </button>
</form>
      </div>

      <!-- Nav links -->
      <div class="list-group list-group-flush list-group-nav mb-3">
        <a class="list-group-item {{ url_is('perfil*') ? 'active' : '' }}" href="{{ base_url('profile') }}">
          <i class="bi bi-person"></i> {{ lang('App.nav.profile') ?? 'Perfil' }}
        </a>
        <a class="list-group-item {{ url_is('usuarios*') ? 'active' : '' }}" href="{{ base_url('usuarios') }}">
          <i class="bi bi-people"></i> {{ lang('App.nav.users') ?? 'Usuarios' }}
        </a>
        <a class="list-group-item {{ url_is('tareas*') ? 'active' : '' }}" href="{{ base_url('tareas') }}">
          <i class="bi bi-list-task"></i> {{ lang('App.nav.tasks') ?? 'Tareas' }}
        </a>
        <a class="list-group-item {{ url_is('asignaciones*') ? 'active' : '' }}" href="{{ base_url('assignments') }}">
          <i class="bi bi-clipboard-check"></i> {{ lang('App.nav.assignments') ?? 'Asignaciones' }}
        </a>
        <a class="list-group-item" href="{{ base_url('ayuda') }}">
          <i class="bi bi-life-preserver"></i> {{ lang('App.nav.help') ?? 'Ayuda' }}
        </a>
      </div>

      <!-- Language -->
      <div class="mt-auto">
        <div class="d-flex align-items-center justify-content-between">
          <span class="text-muted small">{{ lang('App.lang.select') ?? 'Idioma' }}</span>
          <div class="btn-group" role="group" aria-label="Cambiar idioma">
            <a href="{{ base_url('lang/es') }}"
               class="btn btn-sm {{ service('request')->getLocale()==='es' ? 'btn-primary' : 'btn-outline-primary' }}">ES</a>
            <a href="{{ base_url('lang/en') }}"
               class="btn btn-sm {{ service('request')->getLocale()==='en' ? 'btn-primary' : 'btn-outline-primary' }}">EN</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MAIN -->
  <main id="main-content" class="content flex-grow-1 py-4">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="py-4 mt-auto bg-light">
    <div class="container">
      <div class="row align-items-center g-2">
        <div class="col-md-6 text-center text-md-start">
          <span class="text-muted small">&copy; {{ date('Y') }} {{ lang('App.brand') ?? 'Task Organizer' }}</span>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <a href="{{ base_url('terminos') }}" class="small text-decoration-none me-3">
            {{ lang('App.footer.terms') ?? 'Términos' }}
          </a>
          <a href="{{ base_url('privacidad') }}" class="small text-decoration-none">
            {{ lang('App.footer.privacy') ?? 'Privacidad' }}
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Cierra el offcanvas al hacer click en enlaces internos (mejor UX)
    document.addEventListener('click', (e) => {
      const target = e.target.closest('a');
      if(!target) return;
      const offcanvasEl = document.querySelector('#offcanvasNav');
      if(offcanvasEl && offcanvasEl.classList.contains('show') && target.getAttribute('href')?.startsWith('{{ base_url() }}')){
        const oc = bootstrap.Offcanvas.getInstance(offcanvasEl);
        oc?.hide();
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
