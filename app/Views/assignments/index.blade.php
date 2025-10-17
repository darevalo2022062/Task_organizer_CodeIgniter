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

        <!-- Lista de Assignments -->
        <div class="card card-soft">
            <div class="card-body">
                @if(session('role') === 'student')
                <!-- Vista para estudiantes -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ lang('App.assignments.course') }}</th>
                                <th>{{ lang('App.assignments.status') }}</th>
                                <th>{{ lang('App.assignments.grade') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <th>{{ lang('App.assignments.course') }}</th>
                                <th>{{ lang('App.assignments.teacher') }}</th>
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
                                <label class="form-label">{{ lang('App.assignments.course') }}</label>
                                <select class="form-select" name="course_id" required>
                                    <option value="">{{ lang('App.assignments.select_course') }}</option>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.assignments.select_student') }}</label>
                                <select class="form-select" name="student_id" required>
                                    <option value="">{{ lang('App.assignments.select_student') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student['id'] }}">{{ $student['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
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