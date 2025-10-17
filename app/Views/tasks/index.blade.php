@extends('layouts.dashboard_layout')

@section('title', lang('App.tasks.title'))

@section('content')
    <div class="container">
        <!-- Header con acciones según rol -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ lang('App.tasks.title') }}</h1>
                <p class="text-muted mb-0">{{ lang('App.tasks.subtitle') }}</p>
            </div>
            
            @if(session('role') !== 'student')
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearTaskModal">
                    <i class="bi bi-plus-circle me-2"></i>{{ lang('App.tasks.create_new') }}
                </button>
                @if(session('role') === 'admin')
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-download me-2"></i>{{ lang('App.tasks.export') }}
                </button>
                @endif
            </div>
            @endif
        </div>

        <!-- Lista de Tareas -->
        <div class="card card-soft">
            <div class="card-body">
                @if(session('role') === 'student')
                <!-- Vista para estudiantes -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ lang('App.tasks.task_name') }}</th>
                                <th>{{ lang('App.tasks.description') }}</th>
                                <th>{{ lang('App.tasks.due_date') }}</th>
                                <th>{{ lang('App.tasks.status') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para estudiantes -->
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task['name'] }}</td>
                                <td>{{ $task['description'] }}</td>
                                    <td>{{ $task['created_at'] }}</td>
                                <td>{{ $task['status'] === 0 ? lang('App.tasks.status_completed') : lang('App.tasks.status_pending') }}</td>
                                <td>
                                    <a href="{{ route_to('tasks.view', $task['id']) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> {{ lang('App.common.view') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            

                @if(session('role') === 'teacher' || session('role') === 'admin')
                <!-- Vista para teachers y admin -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ lang('App.tasks.task_name') }}</th>
                                <th>{{ lang('App.tasks.course') }}</th>
                                <th>{{ lang('App.tasks.due_date') }}</th>
                                <th>{{ lang('App.tasks.status') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para teachers/admin -->
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task['name'] }}</td>
                                <td>{{ $task['course_name'] }}</td>
                                <td>{{ $task['due_date'] }}</td>
                                <td>{{ $task['status'] === 0 ? lang('App.common.desactive') : lang('App.common.active') }}</td>
                                <td>
                                    <a href="{{ route_to('tasks.view', $task['id']) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i> {{ lang('App.common.view') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal: Crear Tarea -->
    @if(session('role') !== 'student')
    <div class="modal fade" id="crearTaskModal" tabindex="-1" aria-labelledby="crearTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearTaskModalLabel">{{ lang('App.tasks.create_new_task') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route_to('tasks.create') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.task_name') }}</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.course') }}</label>
                                <select class="form-select" name="course_id" required>
                                    <option value="">{{ lang('App.tasks.select_course') }}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.tasks.description') }}</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ lang('App.tasks.due_date') }}</label>
                                <input type="datetime-local" class="form-control" name="due_date" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ lang('App.tasks.priority') }}</label>
                                <select class="form-select" name="priority" required>
                                    <option value="low">{{ lang('App.tasks.priority_low') }}</option>
                                    <option value="medium" selected>{{ lang('App.tasks.priority_medium') }}</option>
                                    <option value="high">{{ lang('App.tasks.priority_high') }}</option>
                                    <option value="urgent">{{ lang('App.tasks.priority_urgent') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">{{ lang('App.tasks.max_points') }}</label>
                                <input type="number" class="form-control" name="max_points" min="1" value="100">
                            </div>
                            @if(session('role') === 'admin')
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.tasks.assign_to_teacher') }}</label>
                                <select class="form-select" name="teacher_id">
                                    <option value="">{{ lang('App.tasks.select_teacher') }}</option>
                                </select>
                            </div>
                            @endif
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.tasks.attachments') }}</label>
                                <input type="file" class="form-control" name="attachments[]" multiple>
                                <div class="form-text">{{ lang('App.tasks.attachments_help') }}</div>
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

    <!-- Modal: Entregar Tarea (Estudiantes) -->
    @if(session('role') === 'student')
    <div class="modal fade" id="submitTaskModal" tabindex="-1" aria-labelledby="submitTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitTaskModalLabel">{{ lang('App.tasks.submit_task') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route_to('tasks.submit') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="task_id" id="submitTaskId">
                        <div class="mb-3">
                            <label class="form-label">{{ lang('App.tasks.submission_notes') }}</label>
                            <textarea class="form-control" name="submission_notes" rows="3" placeholder="{{ lang('App.tasks.notes_placeholder') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ lang('App.tasks.upload_files') }}</label>
                            <input type="file" class="form-control" name="submission_files[]" multiple>
                            <div class="form-text">{{ lang('App.tasks.files_help') }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                        <button type="submit" class="btn btn-success">{{ lang('App.tasks.submit_work') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lógica para el modal de entrega (estudiantes)
    const submitTaskModal = document.getElementById('submitTaskModal');
    if (submitTaskModal) {
        submitTaskModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const taskId = button.getAttribute('data-task-id');
            document.getElementById('submitTaskId').value = taskId;
        });
    }
});
</script>
@endpush