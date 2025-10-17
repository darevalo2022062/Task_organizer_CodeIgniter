@extends('layouts.dashboard_layout')

@section('title', lang('App.tasks.title'))

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ base_url('tasks') }}" class="text-decoration-none">{{ lang('App.tasks.title') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $task['name'] }}</li>
                </ol>
            </nav>
            <h1 class="h3 mb-1">{{ $task['name'] }}</h1>
            <p class="text-muted mb-0">{{ $course['name'] ?? lang('App.common.unknown_course') }}</p>
        </div>
        
        @if(session('role') === 'student')
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#submitTaskModal">
            <i class="bi bi-cloud-upload me-2"></i>{{ lang('App.tasks.submit_task') }}
        </button>
        @endif

        @if(session('role') != 'student')
        <div>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal">
            <i class="bi bi-pencil me-2"></i>{{ lang('App.common.edit') }}
        </button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal">
            <i class="bi bi-trash me-2"></i>{{ lang('App.common.delete') }}
        </button>
        </div>
        @endif

    </div>

    <div class="row">
        <!-- Información Principal -->
        <div class="col-lg-8">
            <div class="card card-soft mb-4">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>{{ lang('App.tasks.task_details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">{{ lang('App.tasks.description') }}</h6>
                        <p class="mb-0">
                            @php
                                function autoLinkUrls($text) {
                                    // Patrón para detectar URLs
                                    $pattern = '/(https?:\/\/[^\s<]+[^\s<\.)])/';
                                    return preg_replace($pattern, '<a href="$1" target="_blank" rel="noopener" class="text-success text-decoration-underline">$1</a>', $text);
                                }
                                
                                $description = $task['description'] ?? lang('App.tasks.no_description');
                                echo autoLinkUrls($description);
                            @endphp
                        </p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted mb-2">{{ lang('App.tasks.due_date') }}</h6>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event text-primary me-2"></i>
                                <span class="{{ strtotime($task['due_date']) < time() ? 'text-danger' : '' }}">
                                    {{ date('d \d\e F \d\e Y \a \l\a\s H:i', strtotime($task['due_date'])) }}
                                </span>
                            </div>
                            @if(strtotime($task['due_date']) < time())
                            <small class="text-danger"><i class="bi bi-exclamation-triangle me-1"></i>{{ lang('App.tasks.overdue') }}</small>
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted mb-2">{{ lang('App.tasks.status') }}</h6>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-circle-fill {{ $task['status'] === 0 ? 'text-success' : 'text-warning' }} me-2"></i>
                                <span class="badge {{ $task['status'] === 0 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $task['status'] === 0 ? lang('App.tasks.status_completed') : lang('App.tasks.status_pending') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted mb-2">{{ lang('App.tasks.ponderation') }}</h6>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-star text-warning me-2"></i>
                                <span>{{ $task['max_points'] ?? 100 }} {{ lang('App.tasks.points') }}</span>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

            <!-- Archivos Adjuntos -->
            @if(!empty($task['attachments']))
            <div class="card card-soft">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0"><i class="bi bi-paperclip me-2"></i>{{ lang('App.tasks.attachments') }}</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($task['attachments'] as $attachment)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark me-3 text-primary"></i>
                                <div>
                                    <h6 class="mb-1">{{ $attachment['name'] }}</h6>
                                    <small class="text-muted">{{ $attachment['size'] }} • {{ $attachment['type'] }}</small>
                                </div>
                            </div>
                            <a href="{{ $attachment['url'] }}" class="btn btn-outline-primary btn-sm" download>
                                <i class="bi bi-download me-1"></i>{{ lang('App.tasks.download') }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar Información -->
        <div class="col-lg-4">
            <!-- Información del Curso -->
            <div class="card card-soft mb-4">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0"><i class="bi bi-journal me-2"></i>{{ lang('App.tasks.course_info') }}</h6>
                </div>
                <div class="card-body">
                    <h6 class="mb-2">{{ $course['name'] ?? lang('App.common.unknown_course') }}</h6>
                    <p class="text-muted small mb-3">{{ $course['description'] ?? '' }}</p>
                    
                    @if(session('role') === 'teacher' || session('role') === 'admin')
                    <div class="d-grid gap-2">
                        <a href="{{ base_url('courses/view/' . $course['id']) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye me-1"></i>{{ lang('App.tasks.view_course') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Progreso y Estadísticas -->
            <div class="card card-soft">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0"><i class="bi bi-graph-up me-2"></i>{{ lang('App.tasks.progress') }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-muted">{{ lang('App.tasks.completion') }}</span>
                            <span class="small text-muted">{{ $task['status'] === 0 ? '100%' : '0%' }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar {{ $task['status'] === 0 ? 'bg-success' : 'bg-warning' }}" 
                                 style="width: {{ $task['status'] === 0 ? '100' : '0' }}%"></div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ base_url('tasks') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>{{ lang('App.tasks.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Eliminar Tarea -->
@if(session('role') != 'student')
<div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaskModalLabel">
                    <i class="bi bi-cloud-upload me-2"></i>{{ lang('App.tasks.delete') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route_to('tasks.delete', $task['id']) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p>{{ lang('App.common.confirm_delete') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ lang('App.common.delete') }}</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endif


<!-- Modal: Editar Tarea -->
@if(session('role') != 'student')
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">
                    <i class="bi bi-cloud-upload me-2"></i>{{ lang('App.tasks.edit') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route_to('tasks.edit', $task['id']) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.task_name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $task['name'] }}" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ lang('App.tasks.description') }}</label>
                                <textarea class="form-control" name="description" rows="3">{{ $task['description'] }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.due_date') }}</label>
                                <input type="datetime-local" class="form-control" name="due_date" value="{{ $task['due_date'] }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ lang('App.tasks.max_points') }}</label>
                                <input type="number" class="form-control" name="grade" id="grade" min="1" value="{{ $task['grade'] }}" max="10">
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ lang('App.common.edit') }}</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endif

<!-- Modal: Entregar Tarea -->
@if(session('role') === 'student')
<div class="modal fade" id="submitTaskModal" tabindex="-1" aria-labelledby="submitTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitTaskModalLabel">
                    <i class="bi bi-cloud-upload me-2"></i>{{ lang('App.tasks.submit_task') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route_to('tasks.submit') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task['id'] }}">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ lang('App.tasks.submit_instructions') }}
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-3">{{ $task['name'] }}</h6>
                        <p class="text-muted small mb-0">{{ $task['description'] }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.tasks.upload_files') }}</label>
                        <input type="file" class="form-control" name="submission_files[]" multiple 
                               accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.jpeg,.png">
                        <div class="form-text">{{ lang('App.tasks.files_help') }}</div>
                    </div>

                    <!-- Vista previa de archivos -->
                    <div id="filePreview" class="mb-3" style="display: none;">
                        <h6 class="mb-2">{{ lang('App.tasks.selected_files') }}</h6>
                        <div id="fileList" class="list-group"></div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ lang('App.tasks.submission_warning') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ lang('App.common.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-cloud-upload me-2"></i>{{ lang('App.tasks.submit_work') }}
                    </button>
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
    const fileInput = document.querySelector('input[name="submission_files[]"]');
    const filePreview = document.getElementById('filePreview');
    const fileList = document.getElementById('fileList');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            fileList.innerHTML = '';
            
            if (this.files.length > 0) {
                filePreview.style.display = 'block';
                
                Array.from(this.files).forEach((file, index) => {
                    const listItem = document.createElement('div');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    listItem.innerHTML = `
                        <div>
                            <i class="bi bi-file-earmark me-2"></i>
                            <span class="small">${file.name}</span>
                        </div>
                        <span class="badge bg-secondary rounded-pill">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                    `;
                    fileList.appendChild(listItem);
                });
            } else {
                filePreview.style.display = 'none';
            }
        });
    }
});
</script>
@endpush