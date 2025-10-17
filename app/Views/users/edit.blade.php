@extends('layouts.dashboard_layout')

@section('title', lang('App.users.edit_user'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Mejorado -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ base_url('users') }}" class="text-decoration-none">{{ lang('App.users.title') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $user['name'] }}</li>
                        </ol>
                    </nav>
                    <h1 class="h3 mb-1 text-dark">{{ lang('App.users.edit_user') }}</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ base_url('users') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>{{ lang('App.common.back') }}
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarUsuarioModal">
                        <i class="bi bi-trash me-2"></i>{{ lang('App.common.delete') }}
                    </button>
                </div>
            </div>

            <div class="row">
                <!-- Columna Izquierda - Información de Usuario -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Información del Usuario</h5>
                        </div>
                        <div class="card-body text-center">
                            <!-- Foto de Perfil -->
                            <div class="position-relative d-inline-block mb-3">
                                <img src="<?= ($user['image_path']&& !empty($user['image_path'])) ? base_url($user['image_path']) : base_url('assets/img/default_user_photo.png') ?>"
                                     alt="Foto de perfil" 
                                     class="rounded-circle border shadow"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                                <span class="position-absolute bottom-0 end-0 bg-success text-white rounded-circle p-1"
                                      style="width: 24px; height: 24px;">
                                    <i class="bi bi-check"></i>
                                </span>
                            </div>
                            
                            <!-- Información Básica -->
                            <h5 class="mb-1">{{ $user['name'] ?? 'Usuario' }}</h5>
                            <p class="text-muted small mb-2">{{ $user['email'] ?? 'usuario@ejemplo.com' }}</p>
                            
                            <!-- Badges de Estado -->
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-{{ $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'teacher' ? 'warning' : 'primary') }}">
                                    {{ $user['role'] }}
                                </span>
                                <span class="badge bg-{{ $user['status'] ? 'success' : 'secondary' }}">
                                    {{ $user['status'] ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>

                            <!-- Estadísticas Rápidas -->
                            <div class="bg-light rounded p-3 mt-3">
                                <div class="row text-center">
                                    
                                        <h6 class="mb-0 text-primary">{{ $user['number_courses'] }}</h6>
                                        <small class="text-muted">{{ lang('App.courses.title') }}</small>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones Rápidas -->
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="bi bi-lightning me-2"></i>{{ lang('App.common.quick_actions') }}</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#cambiarFotoModal">
                                    <i class="bi bi-camera me-2"></i>{{ lang('App.profile.change_picture') }}
                                </button>
                                <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cambiarPasswordModal">
                                    <i class="bi bi-key me-2"></i>{{ lang('App.profile.security.change_password') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha - Formularios de Edición -->
                <div class="col-md-8">
                    <!-- Información Principal -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 text-dark">
                                <i class="bi bi-pencil-square me-2 text-primary"></i>
                                {{ lang('App.common.information') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formEditarUsuario" method="post" action="{{ route_to('users.update', $user['id']) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">{{ lang('App.users.name') }}</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user['name'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">{{ lang('App.users.email') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user['email'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">{{ lang('App.users.role') }}</label>
                                        <select class="form-select" name="role" required>
                                            <option value="student" {{ $user['role'] === 'student' ? 'selected' : '' }}>{{ lang('App.users.role_student') }}</option>
                                            <option value="teacher" {{ $user['role'] === 'teacher' ? 'selected' : '' }}>{{ lang('App.users.role_teacher') }}</option>
                                            <option value="admin" {{ $user['role'] === 'admin' ? 'selected' : '' }}>{{ lang('App.users.role_admin') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">{{ lang('App.users.status') }}</label>
                                        <select class="form-select" name="status" required>
                                            <option value="1" {{ $user['status'] ? 'selected' : '' }}>{{ lang('App.users.status_active') }}</option>
                                            <option value="0" {{ !$user['status'] ? 'selected' : '' }}>{{ lang('App.users.status_inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-secondary">{{ lang('App.common.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-2"></i>{{ lang('App.common.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h6 class="mb-0">
                                        <i class="bi bi-calendar-event me-2 text-info"></i>
                                        Información de Cuenta
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <small class="text-muted">{{ lang('App.users.created_at') }}</small>
                                        <p class="mb-0">{{ date('d/m/Y H:i', strtotime($user['created_at'])) }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">{{ lang('App.users.updated_at') }}</small>
                                        <p class="mb-0">{{ date('d/m/Y H:i', strtotime($user['update_at'] ?? $user['created_at'])) }}</p>
                                    </div>
                                    <div>
                                        <small class="text-muted">{{ lang('App.users.email_verified') }}</small>
                                        <p class="mb-0">
                                            @if($user['confirm_email_at'])
                                                <span class="badge bg-success">{{ lang('App.common.yes') }} - {{ date('d/m/Y', strtotime($user['confirm_email_at'])) }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ lang('App.users.not_verified') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h6 class="mb-0">
                                        <i class="bi bi-graph-up me-2 text-success"></i>
                                        {{ lang('App.users.statistics') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <small class="text-muted">{{ lang('App.users.enrolled_courses') }}</small>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ $user['number_courses'] }} {{ lang('App.courses.title') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Foto de Perfil -->
<div class="modal fade" id="cambiarFotoModal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= route_to('users.update_avatar', $user['id']) ?>" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img id="fotoPreview" src="<?= ($user['image_path'] && !empty($user['image_path'])) ? base_url($user['image_path']) : base_url('assets/img/default_user_photo.png') ?>"
                             alt="Vista previa" 
                             class="rounded-circle border shadow mb-3"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Seleccionar imagen</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Máx. 2MB</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Resetear Contraseña -->
<div class="modal fade" id="cambiarPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resetear Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route_to('users.reset_password', $user['id']) }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Se generará una nueva contraseña aleatoria y se enviará al usuario por email.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Acción</label>
                        <input type="text" class="form-control" placeholder="Escribe 'RESET' para confirmar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Resetear Contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Eliminar Usuario -->
<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Eliminar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route_to('users.delete', $user['id']) }}">
                @csrf
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle text-danger display-4 mb-3"></i>
                    <h5>¿Estás seguro de eliminar este usuario?</h5>
                    <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán todos los datos asociados al usuario.</p>
                    <div class="mb-3">
                        <label class="form-label">Escribe "ELIMINAR" para confirmar:</label>
                        <input type="text" class="form-control" placeholder="ELIMINAR" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vista previa de foto
    const fotoInput = document.getElementById('avatar');
    const fotoPreview = document.getElementById('fotoPreview');
    
    if (fotoInput && fotoPreview) {
        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Toggle status button
    const toggleStatusBtn = document.getElementById('toggleStatusBtn');
    if (toggleStatusBtn) {
        toggleStatusBtn.addEventListener('click', function() {
            // Aquí iría la lógica para cambiar el estado del usuario
            console.log('Cambiando estado del usuario');
        });
    }
});
</script>

<style>
.card {
    border-radius: 12px;
}
.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}
.breadcrumb {
    background: transparent;
    padding: 0;
}
</style>
@endsection