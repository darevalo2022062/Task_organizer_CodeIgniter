@extends('layouts.dashboard_layout')

@section('title', lang('App.users.title'))

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">{{ lang('App.users.title') }}</h1>
            <p class="text-muted mb-0">{{ lang('App.users.subtitle') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
                <i class="bi bi-person-plus me-2"></i>{{ lang('App.users.create_new') }}
            </button>
            <button type="button" class="btn btn-outline-secondary">
                <i class="bi bi-download me-2"></i>{{ lang('App.users.export') }}
            </button>
        </div>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="card card-soft mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ lang('App.users.search') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="{{ lang('App.users.search_placeholder') }}" id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ lang('App.users.filter_by_role') }}</label>
                    <select class="form-select" id="filterRole">
                        <option value="">{{ lang('App.users.all_roles') }}</option>
                        <option value="admin">{{ lang('App.users.role_admin') }}</option>
                        <option value="teacher">{{ lang('App.users.role_teacher') }}</option>
                        <option value="student">{{ lang('App.users.role_student') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ lang('App.users.filter_by_status') }}</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">{{ lang('App.users.all_status') }}</option>
                        <option value="1">{{ lang('App.users.status_active') }}</option>
                        <option value="0">{{ lang('App.users.status_inactive') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Usuarios -->
    <div class="card card-soft">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="usersTable">
                    <thead>
                        <tr>
                            <th>{{ lang('App.users.user') }}</th>
                            <th>{{ lang('App.users.email') }}</th>
                            <th>{{ lang('App.users.role') }}</th>
                            <th>{{ lang('App.users.status') }}</th>
                            <th>{{ lang('App.users.email_verified') }}</th>
                            <th>{{ lang('App.users.created_at') }}</th>
                            <th>{{ lang('App.users.updated_at') }}</th>
                            <th>{{ lang('App.common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user['image_path'] ? base_url($user['image_path']) : base_url('assets/img/default_user_photo.png') }}" 
                                         alt="{{ $user['name'] }}" 
                                         class="rounded-circle me-3"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0">{{ $user['name'] }}</h6>
                                        <small class="text-muted">ID: {{ $user['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                <span class="badge 
                                    @if($user['role'] === 'admin') bg-danger
                                    @elseif($user['role'] === 'teacher') bg-warning
                                    @else bg-primary
                                    @endif">
                                    {{ $user['role'] }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $user['status'] ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user['status'] ? lang('App.users.status_active') : lang('App.users.status_inactive') }}
                                </span>
                            </td>
                            <td>
                                @if($user['confirm_email_at'])
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>{{ lang('App.users.verified') }}
                                </span>
                                @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ lang('App.users.not_verified') }}
                                </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ date('d/m/Y', strtotime($user['created_at'])) }}
                                </small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ date('d/m/Y', strtotime($user['updated_at'])) }}
                                </small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal">
                                                <i class="bi bi-pencil me-2"></i>{{ lang('App.common.edit') }}
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ base_url('users/delete/' . $user['id']) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="dropdown-item text-danger"
                                                        onclick="return confirm('{{ lang('App.users.confirm_delete') }}')">
                                                    <i class="bi bi-trash me-2"></i>{{ lang('App.common.delete') }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-people display-4 mb-3"></i>
                                    <p class="h5">{{ lang('App.users.no_users_found') }}</p>
                                    <p class="small">{{ lang('App.users.create_first_user') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if(count($users) > 0)
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    {{ lang('App.common.showing') }} {{ count($users) }} {{ lang('App.common.of') }} {{ count($users) }} {{ lang('App.users.users') }}
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">{{ lang('App.common.previous') }}</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">{{ lang('App.common.next') }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal: Crear Usuario -->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioModalLabel">{{ lang('App.users.create_new_user') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route_to('users.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.name') }}</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.email') }}</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.password') }}</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.role') }}</label>
                        <select class="form-select" name="role" required>
                            <option value="student">{{ lang('App.users.role_student') }}</option>
                            <option value="teacher">{{ lang('App.users.role_teacher') }}</option>
                            <option value="admin">{{ lang('App.users.role_admin') }}</option>
                        </select>
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
<!-- Modal: Editar Usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">{{ lang('App.users.edit_user') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route_to('users.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.name') }}</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.email') }}</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.password') }}</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ lang('App.users.role') }}</label>
                        <select class="form-select" name="role" required>
                            <option value="student">{{ lang('App.users.role_student') }}</option>
                            <option value="teacher">{{ lang('App.users.role_teacher') }}</option>
                            <option value="admin">{{ lang('App.users.role_admin') }}</option>
                        </select>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtrado y búsqueda
    const searchInput = document.getElementById('searchInput');
    const filterRole = document.getElementById('filterRole');
    const filterStatus = document.getElementById('filterStatus');
    const usersTable = document.getElementById('usersTable');
    
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const roleFilter = filterRole.value;
        const statusFilter = filterStatus.value;
        
        const rows = usersTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let row of rows) {
            const name = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            const role = row.cells[2].textContent.toLowerCase();
            const status = row.cells[3].textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesRole = !roleFilter || role.includes(roleFilter);
            const matchesStatus = !statusFilter || 
                (statusFilter == '1' && status.includes('active')) ||
                (statusFilter == '0' && status.includes('inactive'))|| 
                (statusFilter == '1' && status.includes('activo')) ||
                (statusFilter == '0' && status.includes('inactivo'));

            row.style.display = (matchesSearch && matchesRole && matchesStatus) ? '' : 'none';
        }
    }
    
    searchInput.addEventListener('input', filterUsers);
    filterRole.addEventListener('change', filterUsers);
    filterStatus.addEventListener('change', filterUsers);
});
</script>
@endpush