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
                <!-- Ordenamiento Funcional -->
<!-- Versión Compacta Mejorada -->
<!-- Con Separadores Visuales -->
<div class="card card-soft border-0 bg-light mb-4">
    <div class="card-body py-3">
        <div class="d-flex flex-wrap align-items-center gap-1">
            <div class="d-flex align-items-center me-3">
                <i class="bi bi-funnel text-primary me-2"></i>
                <span class="fw-medium text-dark">{{ lang('App.common.sort_by') }}</span>
            </div>
            
            <!-- Fecha Límite -->
            <div class="d-flex align-items-center border-end pe-3 me-3">
                <span class="text-muted small me-2">{{ lang('App.tasks.due_date') }}</span>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="?sort_by=due_date&sort_order=asc" 
                       class="btn {{ $sort_by === 'due_date' && $sort_order === 'asc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-arrow-up-short me-1"></i>{{ lang('App.common.ascending') }}
                    </a>
                    <a href="?sort_by=due_date&sort_order=desc" 
                       class="btn {{ $sort_by === 'due_date' && $sort_order === 'desc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-arrow-down-short me-1"></i>{{ lang('App.common.descending') }}
                    </a>
                </div>
            </div>

            <!-- Fecha Creación -->
            <div class="d-flex align-items-center border-end pe-3 me-3">
                <span class="text-muted small me-2">{{ lang('App.tasks.created_at') }}</span>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="?sort_by=created_at&sort_order=asc" 
                       class="btn {{ $sort_by === 'created_at' && $sort_order === 'asc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-arrow-up-short me-1"></i>{{ lang('App.common.ascending') }}
                    </a>
                    <a href="?sort_by=created_at&sort_order=desc" 
                       class="btn {{ $sort_by === 'created_at' && $sort_order === 'desc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-arrow-down-short me-1"></i>{{ lang('App.common.descending') }}
                    </a>
                </div>
            </div>

            <!-- Nombre -->
            <div class="d-flex align-items-center">
                <span class="text-muted small me-2">{{ lang('App.tasks.task_name') }}</span>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="?sort_by=name&sort_order=asc" 
                       class="btn {{ $sort_by === 'name' && $sort_order === 'asc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-sort-alpha-down me-1"></i>A-Z
                    </a>
                    <a href="?sort_by=name&sort_order=desc" 
                       class="btn {{ $sort_by === 'name' && $sort_order === 'desc' ? 'btn-primary' : 'btn-outline-secondary' }} px-2">
                        <i class="bi bi-sort-alpha-down-alt me-1"></i>Z-A
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                <th>{{ lang('App.tasks.created_at') }}</th>
                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para estudiantes -->
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task['name'] }}</td>
                                <td>{{ $task['description'] }}</td>
                                <td style="color: darkcyan;">{{ date('d \d\e F \d\e Y \a \l\a\s H:i', strtotime($task['due_date'])) }}</td>
                                <td>{{ $task['status'] === 0 ? lang('App.tasks.status_completed') : lang('App.tasks.status_pending') }}</td>
                                <td style="font-size: small; ">{{ date('d \d\e F \d\e Y', strtotime($task['created_at'])) }}</td>
                                <td>
                                    <a href="{{ base_url('tasks/view/' . $task['id']) }}" class="btn btn-sm btn-outline-secondary">
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
                                                                <th>{{ lang('App.tasks.created_at') }}</th>

                                <th>{{ lang('App.common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Datos dinámicos para teachers/admin -->
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task['name'] }}</td>
                                <td>{{ $task['course_name'] }}</td>
                                <td>{{ date('d \d\e F \d\e Y \a \l\a\s H:i', strtotime($task['due_date'])) }}</td>
                                <td>{{ $task['status'] === 0 ? lang('App.common.desactive') : lang('App.common.active') }}</td>
                                <td style="font-size: small; ">{{ date('d \d\e F \d\e Y', strtotime($task['created_at'])) }}</td>

                                <td>
                                    <a href="{{ route_to('tasks.view', $task['id']) }}" class="btn btn-sm btn-outline-success">
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
                                    @foreach ($courses as $course)
                                        <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.tasks.description') }}</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.due_date') }}</label>
                                <input type="datetime-local" class="form-control" name="due_date" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.max_points') }}</label>
                                <input type="number" class="form-control" name="grade" id="grade" min="1" value="10" max="10">
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