@extends('layouts.dashboard_layout')

@section('title', lang('App.dashboard.title'))

@section('content')
<div class="container">
    <!-- Header de Bienvenida -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1 text-dark">{{ lang('App.dashboard.welcome') }}, {{ session('name') }}! 👋</h1>
                    <p class="text-muted mb-0">{{ lang('App.dashboard.subtitle') }}</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ lang('App.dashboard.today') }}</small>
                    <div class="fw-semibold">{{ date('l, d F Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas Rápidas -->
    <div class="row mb-5">
        @if(session('role') === 'student')
        <!-- Estadísticas para Estudiantes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.student.courses_enrolled') }}</h6>
                            <h3 class="mb-0 text-primary">5</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-journal-bookmark text-primary fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">+2 este mes</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.student.pending_tasks') }}</h6>
                            <h3 class="mb-0 text-warning">8</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-clock text-warning fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">3 vencen pronto</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.student.completed_tasks') }}</h6>
                            <h3 class="mb-0 text-success">12</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">85% de efectividad</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.student.average_grade') }}</h6>
                            <h3 class="mb-0 text-info">8.5</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="bi bi-award text-info fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">+0.3 vs último mes</p>
                </div>
            </div>
        </div>

        @elseif(session('role') === 'teacher')
        <!-- Estadísticas para Profesores -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.teacher.active_courses') }}</h6>
                            <h3 class="mb-0 text-primary">4</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-journal-text text-primary fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">+1 este semestre</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.teacher.total_students') }}</h6>
                            <h3 class="mb-0 text-success">45</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-people text-success fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">En todos los cursos</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.teacher.tasks_to_grade') }}</h6>
                            <h3 class="mb-0 text-warning">15</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-clipboard-check text-warning fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">Por calificar</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.teacher.avg_course_rating') }}</h6>
                            <h3 class="mb-0 text-info">4.7</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="bi bi-star text-info fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">Basado en 32 reviews</p>
                </div>
            </div>
        </div>

        @elseif(session('role') === 'admin')
        <!-- Estadísticas para Administradores -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.admin.total_users') }}</h6>
                            <h3 class="mb-0 text-primary">156</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-people text-primary fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">+12 este mes</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.admin.active_courses') }}</h6>
                            <h3 class="mb-0 text-success">24</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-journals text-success fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">En plataforma</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.admin.system_health') }}</h6>
                            <h3 class="mb-0 text-info">98%</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="bi bi-heart-pulse text-info fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">Todo funcionando</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title text-muted mb-2">{{ lang('App.dashboard.admin.storage_used') }}</h6>
                            <h3 class="mb-0 text-warning">65%</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-hdd text-warning fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-0 mt-2">2.1GB de 3.2GB</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Acciones Rápidas y Actividad Reciente -->
    <div class="row">
        <!-- Acciones Rápidas -->
        <div class="col-lg-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning me-2 text-primary"></i>
                        {{ lang('App.dashboard.quick_actions') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @if(session('role') === 'student')
                        <div class="col-6">
                            <a href="{{ base_url('tasks') }}" class="btn btn-outline-primary w-100 h-100 py-3">
                                <i class="bi bi-list-task d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.view_tasks') }}
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ base_url('courses') }}" class="btn btn-outline-success w-100 h-100 py-3">
                                <i class="bi bi-book d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.my_courses') }}
                            </a>
                        </div>
                        @elseif(session('role') === 'teacher')
                        <div class="col-6">
                            <a href="{{ base_url('tasks/create') }}" class="btn btn-outline-primary w-100 h-100 py-3">
                                <i class="bi bi-plus-circle d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.create_task') }}
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ base_url('courses') }}" class="btn btn-outline-success w-100 h-100 py-3">
                                <i class="bi bi-journal-plus d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.manage_courses') }}
                            </a>
                        </div>
                        @elseif(session('role') === 'admin')
                        <div class="col-6">
                            <a href="{{ base_url('users') }}" class="btn btn-outline-primary w-100 h-100 py-3">
                                <i class="bi bi-person-plus d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.manage_users') }}
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ base_url('system') }}" class="btn btn-outline-success w-100 h-100 py-3">
                                <i class="bi bi-gear d-block mb-2 fs-4"></i>
                                {{ lang('App.dashboard.actions.system_settings') }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="col-lg-6 mb-4">
            <div class="card card-soft border-0 h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2 text-primary"></i>
                        {{ lang('App.dashboard.recent_activity') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                    <i class="bi bi-check-circle text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <small class="text-muted">Hace 2 horas</small>
                                    <p class="mb-0 small">{{ lang('App.dashboard.activity.completed_task') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                    <i class="bi bi-book text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <small class="text-muted">Ayer</small>
                                    <p class="mb-0 small">{{ lang('App.dashboard.activity.joined_course') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                    <i class="bi bi-chat-dots text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <small class="text-muted">Hace 3 días</small>
                                    <p class="mb-0 small">{{ lang('App.dashboard.activity.new_message') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection