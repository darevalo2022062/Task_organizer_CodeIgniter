@extends('layouts.dashboard_layout')

@section('title', lang('App.courses.title'))

@section('content')
    <div class="container">
        <!-- Header con acciones según rol -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ lang('App.courses.title') }}</h1>
                <p class="text-muted mb-0">{{ lang('App.courses.subtitle') }}</p>
            </div>
            
            @if(session('role') !== 'student')
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearCourseModal">
                    <i class="bi bi-plus-circle me-2"></i>{{ lang('App.courses.create_new') }}
                </button>
                @if(session('role') === 'admin')
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-download me-2"></i>{{ lang('App.courses.export') }}
                </button>
                @endif
            </div>
            @endif
        </div>

        <!-- Filtros para admin -->
        @if(session('role') === 'admin')
        <div class="card card-soft mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ lang('App.courses.filter_by_teacher') }}</label>
                        <select class="form-select" id="filterTeacher">
                            <option value="">{{ lang('App.courses.all_teachers') }}</option>
                            <!-- Options dinámicas para teachers -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ lang('App.courses.filter_by_status') }}</label>
                        <select class="form-select" id="filterStatus">
                            <option value="">{{ lang('App.courses.all_status') }}</option>
                            <option value="active">{{ lang('App.courses.status_active') }}</option>
                            <option value="inactive">{{ lang('App.courses.status_inactive') }}</option>
                            <option value="archived">{{ lang('App.courses.status_archived') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Grid de Cursos -->
        <div class="row">
            @if(empty($courses))
                <!-- No hay cursos para ningún rol -->
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-journal-x display-4 mb-3"></i>
                        <p class="h5">{{ lang('App.courses.no_courses_found') }}</p>
                        @if(session('role') !== 'student')
                        <p class="small">{{ lang('App.courses.create_first_course') }}</p>
                        @endif
                    </div>
                </div>
            @else
                <!-- Mostrar cursos dinámicamente para TODOS los roles -->
                @foreach($courses as $course)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card card-soft h-100 course-card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-journal-check"></i> {{ lang('App.courses.status_active') }}
                                </span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary border-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if(session('role') !== 'student')
                                        <li>
                                            <form action="{{ base_url('courses/delete/' . $course['id']) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger border-0 bg-transparent" 
                                                        onclick="return confirm('{{ lang('App.common.confirm_delete') }}')">
                                                    <i class="bi bi-trash me-2"></i>{{ lang('App.courses.delete_course') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $course['name'] ?? 'Curso sin nombre' }}</h5>
                            <p class="card-text text-muted small">{{ $course['description'] ?? 'Sin descripción' }}</p>
                            <div class="course-meta">
                                <div class="d-flex justify-content-between align-items-center text-sm text-muted mb-2">
                                    <span><i class="bi bi-person me-1"></i>
                                        @if(isset($course['teacher_name']))
                                            {{ $course['teacher_name'] }}
                                        @else
                                            {{ lang('App.courses.teacher_unknown') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-sm text-muted">
                                    <span>
                                        <i class="bi bi-calendar3 me-1"></i>
                                        @if(isset($course['created_at']))
                                            {{ date('d/m/Y', strtotime($course['created_at'])) }}
                                        @else
                                            {{ lang('App.courses.no_date') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            @if(session('role') === 'student')
                            <a href="{{ base_url('courses/enter/' . $course['id']) }}" class="btn btn-primary btn-sm w-100">
                                {{ lang('App.courses.enter_course') }}
                            </a>
                            @else
                            <div class="d-flex gap-2">
                                <a href="{{ base_url('courses/manage/' . $course['id']) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                    {{ lang('App.courses.manage') }}
                                </a>
                                <a href="{{ base_url('courses/students/' . $course['id']) }}" class="btn btn-outline-secondary btn-sm">
                                    {{ lang('App.courses.students') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Modal: Crear Curso -->
    @if(session('role') !== 'student')
    <div class="modal fade" id="crearCourseModal" tabindex="-1" aria-labelledby="crearCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearCourseModalLabel">{{ lang('App.courses.create_new_course') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route_to('courses.create') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">{{ lang('App.courses.course_name') }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ lang('App.courses.description') }}</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        
                        @if(session('role') === 'admin')
                        <div class="mb-3">
                            <label class="form-label">{{ lang('App.courses.assign_to_teacher') }}</label>
                            <select class="form-select" name="teacher_id">
                                <option value="">{{ lang('App.courses.select_teacher') }}</option>
                                <!-- Options dinámicas de teachers -->
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ lang('App.common.create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection