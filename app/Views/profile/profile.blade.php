@extends('layouts.dashboard_layout')

@section('title', lang('App.profile.title'))

@section('content')
    <div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">{{ lang('App.profile.title') }}</h1>
                <a href="{{ base_url('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>{{ lang('App.profile.back_to_dashboard') }}
                </a>
            </div>

            <div class="row">
                <!-- Columna Izquierda - Foto de Perfil -->
                <div class="col-md-4 mb-4">
                    <div class="card card-soft">
                        <div class="card-body text-center">
                            <!-- Foto de Perfil -->
                            <div class="position-relative d-inline-block">
                                <img src="<?= base_url('assets/img/default_user_photo.png') ?>" 
                                     alt="Foto de perfil" 
                                     class="rounded-circle border"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <!-- Nombre del Usuario -->
                            <h5 class="mt-3 mb-1">{{ session('name') ?? 'Usuario' }}</h5>
                            <p class="text-muted small mb-3">{{ session('email') ?? 'usuario@ejemplo.com' }}</p>
                            <!-- Acciones de Foto -->
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#cambiarFotoModal">
                                    <i class="bi bi-camera me-2"></i>{{ lang('App.profile.change_picture') }}
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarFotoModal">
                                    <i class="bi bi-trash me-2"></i>{{ lang('App.profile.delete_picture') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha - Información y Configuración -->
                <div class="col-md-8">
                    <!-- Información Personal -->
                    <div class="card card-soft mb-4">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ lang('App.profile.user_profile') }}</h5>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                                <i class="bi bi-pencil me-1"></i>{{ lang('App.profile.edit_profile') }}
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label text-muted small mb-1">{{ lang('App.profile.name') }}</label>
                                    <p class="mb-0">{{ session('name') ?? 'No especificado' }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label text-muted small mb-1">{{ lang('App.profile.email') }}</label>
                                    <p class="mb-0">{{ session('email') ?? 'No especificado' }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label text-muted small mb-1">{{ lang('App.profile.role') }}</label>
                                    <p class="mb-0">
                                        <span class="badge bg-primary">{{ session('role') ?? 'Usuario' }}</span>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Cambiar Contraseña -->
                    <div class="card card-soft">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">{{ lang('App.profile.security.title') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">{{ lang('App.profile.security.description') }}</p>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cambiarPasswordModal">
                                <i class="bi bi-shield-lock me-2"></i>{{ lang('App.profile.security.change_password') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Foto de Perfil -->
<div class="modal fade" id="cambiarFotoModal" tabindex="-1" aria-labelledby="cambiarFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarFotoModalLabel">{{ lang('App.profile.change_picture') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCambiarFoto" enctype="multipart/form-data">
                    <div class="text-center mb-3">
                        <img id="fotoPreview" src="<?= base_url('assets/img/default_user_photo.png') ?>" 
                             alt="Vista previa" 
                             class="rounded-circle border mb-3"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="mb-3">
                        <label for="fotoPerfil" class="form-label">{{ lang('App.profile.image.select') }}</label>
                        <input type="file" class="form-control" id="fotoPerfil" accept="image/*">
                        <div class="form-text">{{ lang('App.profile.image.help') }}</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                <button type="button" class="btn btn-primary">{{ lang('App.profile.image.save') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Eliminar Foto de Perfil -->
<div class="modal fade" id="eliminarFotoModal" tabindex="-1" aria-labelledby="eliminarFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarFotoModalLabel">Eliminar Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle text-warning display-4 mb-3"></i>
                <p>{{ lang('App.profile.image.delete_confirm') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ lang('App.common.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Editar Perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPerfilModalLabel">{{ lang('App.profile.edit_profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarPerfil" method="post" action="{{ route_to('profile.update') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombreCompleto" class="form-label">{{ lang('App.profile.name') }}</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="name" value="{{ session('name') ?? '' }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">{{ lang('App.profile.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ session('email') ?? '' }}" required>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3 mt-3">
                        <h6 class="text-muted mb-3">
                            <i class="bi bi-shield-check me-2"></i>
                            {{ lang('App.profile.confirm_changes') }}
                        </h6>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">{{ lang('App.profile.security.current_password') }}</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" 
                            placeholder="{{ lang('App.profile.enter_password_to_save') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ lang('App.common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Contraseña -->
<div class="modal fade" id="cambiarPasswordModal" tabindex="-1" aria-labelledby="cambiarPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarPasswordModalLabel">{{ lang('App.profile.security.change_password') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCambiarPassword">
                    <div class="mb-3">
                        <label for="passwordActual" class="form-label">{{ lang('App.profile.security.current_password') }}</label>
                        <input type="password" class="form-control" id="passwordActual" required>
                    </div>
                    <div class="mb-3">
                        <label for="nuevaPassword" class="form-label">{{ lang('App.profile.security.new_password') }}</label>
                        <input type="password" class="form-control" id="nuevaPassword" required>
                        <div class="form-text">{{ lang('App.profile.security.password_help') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmarPassword" class="form-label">{{ lang('App.profile.security.confirm_new_password') }}</label>
                        <input type="password" class="form-control" id="confirmarPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ lang('App.common.cancel') }}</button>
                <button type="button" class="btn btn-warning">{{ lang('App.common.update') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vista previa de foto
    const fotoInput = document.getElementById('fotoPerfil');
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
});
</script>
@endsection