@extends('layouts.dashboard_layout')

@section('title', lang('App.assignments.title'))

@section('content')
    <div class="container">
        <!-- Header con acciones según rol -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ lang('App.assignments.title') }}</h1>
                <p class="text-muted mb-0">{{ lang('App.assignments.subtitle') }}</p>
            </div>
            
            @if(session('role') !== 'student')
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearAssignmentModal">
                    <i class="bi bi-plus-circle me-2"></i>{{ lang('App.assignments.create_new') }}
                </button>
                @if(session('role') === 'admin')
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-download me-2"></i>{{ lang('App.assignments.export') }}
                </button>
                @endif
            </div>
            @endif
        </div>

        <!-- Filtros para admin y teacher -->
        @if(session('role') !== 'student')
        <div class="card card-soft mb-4">
            <div class="card-body">
                <div class="row g-3">
                    @if(session('role') === 'admin')
                    <div class="col-md-4">
                        <label class="form-label">{{ lang('App.assignments.filter_by_teacher') }}</label>
                        <select class="form-select" id="filterTeacher">
                            <option value="">{{ lang('App.assignments.all_teachers') }}</option>
                            <!-- Options dinámicas para teachers -->
                        </select>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <label class="form-label">{{ lang('App.assignments.filter_by_course') }}</label>
                        <select class="form-select" id="filterCourse">
                            <option value="">{{ lang('App.assignments.all_courses') }}</option>
                            <!-- Options dinámicas para cursos -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ lang('App.assignments.filter_by_status') }}</label>
                        <select class="form-select" id="filterStatus">
                            <option value="">{{ lang('App.assignments.all_status') }}</option>
                            <option value="pending">{{ lang('App.assignments.status_pending') }}</option>
                            <option value="in_progress">{{ lang('App.assignments.status_in_progress') }}</option>
                            <option value="completed">{{ lang('App.assignments.status_completed') }}</option>
                            <option value="graded">{{ lang('App.assignments.status_graded') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Lista de Assignments -->
        <div class="card card-soft">
            <div class="card-body">
                @if(session('role') === 'student')
                <!-- Vista para estudiantes -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ lang('App.assignments.assignment_name') }}</th>
                                <th>{{ lang('App.assignments.course') }}</th>
                                <th>{{ lang('App.assignments.due_date') }}</th>
                                <th>{{ lang('App.assignments.status') }}</th>
                                <th>{{ lang('App.assignments.grade') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para estudiantes -->
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    {{ lang('App.assignments.no_assignments_found') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <!-- Vista para teachers y admin -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ lang('App.assignments.assignment_name') }}</th>
                                <th>{{ lang('App.assignments.course') }}</th>
                                @if(session('role') === 'admin')
                                <th>{{ lang('App.assignments.teacher') }}</th>
                                @endif
                                <th>{{ lang('App.assignments.due_date') }}</th>
                                <th>{{ lang('App.assignments.students_assigned') }}</th>
                                <th>{{ lang('App.assignments.status') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para teachers/admin -->
                            <tr>
                                <td colspan="{{ session('role') === 'admin' ? '7' : '6' }}" class="text-center text-muted py-4">
                                    {{ lang('App.assignments.no_assignments_found') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal: Crear Assignment -->
    @if(session('role') !== 'student')
    <div class="modal fade" id="crearAssignmentModal" tabindex="-1" aria-labelledby="crearAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearAssignmentModalLabel">{{ lang('App.assignments.create_new_assignment') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route_to('assignments.create') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.assignments.assignment_name') }}</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.assignments.course') }}</label>
                                <select class="form-select" name="course_id" required>
                                    <option value="">{{ lang('App.assignments.select_course') }}</option>
                                    <!-- Options dinámicas de cursos -->
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.assignments.description') }}</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.assignments.due_date') }}</label>
                                <input type="datetime-local" class="form-control" name="due_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.assignments.max_points') }}</label>
                                <input type="number" class="form-control" name="max_points" min="1" value="100">
                            </div>
                            @if(session('role') === 'admin')
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.assignments.assign_to_teacher') }}</label>
                                <select class="form-select" name="teacher_id">
                                    <option value="">{{ lang('App.assignments.select_teacher') }}</option>
                                    <!-- Options dinámicas de teachers -->
                                </select>
                            </div>
                            @endif
                        </div>
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