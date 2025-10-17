<?php
return [
    'brand' => 'Task Organizer',
    'common' => [
        'view' => 'Ver Detalles',
        'save' => 'Guardar Cambios',
        'cancel' => 'Cancelar',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'update' => 'Actualizar',
        'create' => 'Crear',
        'back' => 'Volver',
        'actions' => 'Acciones',
        'active' => 'Activo',
        'desactive' => 'Inactivo',
        'search' => 'Buscar...',
        'delete_success' => 'Eliminación exitosa.',
        'invalid_password' => 'Contraseña inválida',
        'update_success' => 'Actualización exitosa.',
        'update_failed' => 'Error al actualizar.',
        'create_success' => 'Creación exitosa.',
        'create_failed' => 'Error al crear.',
        'user_not_found' => 'Usuario no encontrado.',
        'loading' => 'Cargando...',
        'no_data' => 'No hay datos disponibles.',
        'confirm_delete' => '¿Estás seguro de que deseas eliminar este elemento?',
        'yes' => 'Sí',
        'no' => 'No',
    ],
    // app/Language/es/App.php
    'courses' => [
        'title' => 'Cursos',
        'subtitle' => 'Gestiona tus cursos y materiales',
        'create_new' => 'Nuevo Curso',
        'export' => 'Exportar',
        
        // Filtros
        'filter_by_teacher' => 'Filtrar por profesor',
        'filter_by_status' => 'Filtrar por estado',
        'all_teachers' => 'Todos los profesores',
        'all_status' => 'Todos los estados',
        
        // Estados
        'status_active' => 'Activo',
        'status_inactive' => 'Inactivo',
        'status_archived' => 'Archivado',
        
        // Modal crear
        'create_new_course' => 'Crear Nuevo Curso',
        'course_name' => 'Nombre del Curso',
        'course_code' => 'Código del Curso',
        'description' => 'Descripción',
        'start_date' => 'Fecha de Inicio',
        'end_date' => 'Fecha de Fin',
        'assign_to_teacher' => 'Asignar a profesor',
        'select_teacher' => 'Seleccionar profesor',
        'course_color' => 'Color del Curso',
        
        // Tarjeta de curso
        'view_course' => 'Ver Curso',
        'edit_course' => 'Editar Curso',
        'delete_course' => 'Eliminar Curso',
        'enter_course' => 'Entrar al Curso',
        'manage' => 'Gestionar',
        'students' => 'Estudiantes',
        
        // Mensajes
        'no_courses_found' => 'No se encontraron cursos',
        'create_first_course' => 'Crea tu primer curso para comenzar',
        'course_created' => 'Curso creado exitosamente',
        'course_updated' => 'Curso actualizado exitosamente',
        'course_deleted' => 'Curso eliminado exitosamente',
        
        // Acciones
        'enroll_course' => 'Inscribirse al Curso',
        'unenroll_course' => 'Darse de Baja',
        'view_students' => 'Ver Estudiantes',
        'view_assignments' => 'Ver Asignaciones',
    ],
    'nav' => [
        'login' => 'Iniciar Sesión',
        'register' => 'Registrarse',
        'spanish' => 'Español',
        'english' => 'Inglés',
        'hello' => 'Hola,',
        'menu' => 'Menú',
        'profile' => 'Perfil',
        'users' => 'Usuarios',
        'tasks' => 'Tareas',
        'assignments' => 'Asignaciones',
        'courses' => 'Cursos',
        'logout' => 'Salir',
    ],
    'footer' => [
        'copyright' => 'Todos los derechos reservados',
        'terms' => 'Términos',
        'privacy' => 'Privacidad',
        'contact' => 'Contacto',
    ],
    'home' => [
        'title' => 'Inicio - Task Organizer',
        'hero' => [
            'title' => '¡Bienvenido 🎓 Maestro a Task Organizer!',
            'subtitle' => 'La Mejor plataforma para gestión Escolar',
            'cta_primary' => 'Comenzar Gratis',
            'cta_secondary' => 'Ver Características',
        ],
        'features' => [
            'title' => 'Características Principales',
            'subtitle' => 'Descubre cómo te ayudamos a ser más productivo',
            '1' => [
                'title' => 'Gestión Visual',
                'description' => 'Organiza tus tareas de manera intuitiva y fácil de usar.',
            ],
            '2' => [
                'title' => 'Seguimiento y tracking',
                'description' => 'Controla y registra documentos y actividades.',
            ],
            '3' => [
                'title' => 'Detalles',
                'description' => 'Observa claramente la información relevante de tus tareas.',
            ],
        ],
    ],
    // app/Language/es/App.php
'tasks' => [
    'title' => 'Tareas',
    'subtitle' => 'Gestiona tus tareas y trabajos',
    'create_new' => 'Nueva Tarea',
    'export' => 'Exportar',
    'description' => 'Descripción',
    
    // Filtros
    'filter_by_teacher' => 'Filtrar por profesor',
    'filter_by_course' => 'Filtrar por curso',
    'filter_by_status' => 'Filtrar por estado',
    'filter_by_priority' => 'Filtrar por prioridad',
    'all_teachers' => 'Todos los profesores',
    'all_courses' => 'Todos los cursos',
    'all_status' => 'Todos los estados',
    'all_priorities' => 'Todas las prioridades',
    
    // Estados
    'status_pending' => 'Pendiente',
    'status_in_progress' => 'En Progreso',
    'status_completed' => 'Completado',
    'status_overdue' => 'Vencida',
    
    // Prioridades
    'priority_low' => 'Baja',
    'priority_medium' => 'Media',
    'priority_high' => 'Alta',
    'priority_urgent' => 'Urgente',
    
    // Tabla
    'task_name' => 'Nombre de Tarea',
    'course' => 'Curso',
    'teacher' => 'Profesor',
    'due_date' => 'Fecha Límite',
    'priority' => 'Prioridad',
    'status' => 'Estado',
    'students_assigned' => 'Estudiantes Asignados',
    'actions' => 'Acciones',
    
    // Modal crear
    'create_new_task' => 'Crear Nueva Tarea',
    'select_course' => 'Seleccionar curso',
    'description' => 'Descripción',
    'max_points' => 'Puntos Máximos',
    'assign_to_teacher' => 'Asignar a profesor',
    'select_teacher' => 'Seleccionar profesor',
    'attachments' => 'Archivos Adjuntos',
    'attachments_help' => 'Puedes adjuntar múltiples archivos (PDF, Word, imágenes)',
    
    // Modal entregar (estudiantes)
    'submit_task' => 'Entregar Tarea',
    'submission_notes' => 'Notas de Entrega',
    'notes_placeholder' => 'Agrega cualquier comentario sobre tu entrega...',
    'upload_files' => 'Subir Archivos',
    'files_help' => 'Sube los archivos de tu trabajo',
    'submit_work' => 'Entregar Trabajo',
    
    // Mensajes
    'no_tasks_found' => 'No se encontraron tareas',
    'task_created' => 'Tarea creada exitosamente',
    'task_updated' => 'Tarea actualizada exitosamente',
    'task_deleted' => 'Tarea eliminada exitosamente',
    'task_submitted' => 'Tarea entregada exitosamente',
    
    // Acciones
    'view_task' => 'Ver Tarea',
    'edit_task' => 'Editar Tarea',
    'delete_task' => 'Eliminar Tarea',
    'grade_task' => 'Calificar Tarea',
    'download_files' => 'Descargar Archivos',
],
    'assignments' => [
        'title' => 'Asignaciones',
        'subtitle' => 'Gestiona tus tareas y asignaciones',
        'create_new' => 'Nueva Asignación',
        'export' => 'Exportar',
        
        // Filtros
        'filter_by_teacher' => 'Filtrar por profesor',
        'filter_by_course' => 'Filtrar por curso',
        'filter_by_status' => 'Filtrar por estado',
        'all_teachers' => 'Todos los profesores',
        'all_courses' => 'Todos los cursos',
        'all_status' => 'Todos los estados',
        
        // Estados
        'status_pending' => 'Pendiente',
        'status_in_progress' => 'En Progreso',
        'status_completed' => 'Completado',
        'status_graded' => 'Calificado',
        
        // Tabla
        'assignment_name' => 'Nombre de Asignación',
        'course' => 'Curso',
        'teacher' => 'Profesor',
        'due_date' => 'Fecha Límite',
        'status' => 'Estado',
        'grade' => 'Calificación',
        'students_assigned' => 'Estudiantes Asignados',
        'actions' => 'Acciones',
        
        // Modal crear
        'create_new_assignment' => 'Crear Nueva Asignación',
        'select_course' => 'Seleccionar curso',
        'select_student' => 'Seleccionar estudiante',
        'description' => 'Descripción',
        'max_points' => 'Puntos Máximos',
        'assign_to_teacher' => 'Asignar a profesor',
        'select_teacher' => 'Seleccionar profesor',
        
        // Mensajes
        'no_assignments_found' => 'No se encontraron asignaciones',
        'assignment_created' => 'Asignación creada exitosamente',
        'assignment_updated' => 'Asignación actualizada exitosamente',
        'assignment_deleted' => 'Asignación eliminada exitosamente',
        
        // Acciones
        'view_assignment' => 'Ver Asignación',
        'edit_assignment' => 'Editar Asignación',
        'delete_assignment' => 'Eliminar Asignación',
        'submit_assignment' => 'Entregar Asignación',
        'grade_assignment' => 'Calificar Asignación',
    ],
    'dashboard' => [
        'title' => 'Panel de Control - Task Organizer',
        'welcome' => 'Bienvenido',
        'intro' => 'Aquí puedes gestionar tus tareas y proyectos de manera eficiente.',
    ],
    'profile' => [
        'title' => 'Perfil - Task Organizer',
        'back_to_dashboard' => 'Volver al Panel',
        'user_profile' => 'Información Personal',
        'edit_profile' => 'Editar Perfil',
        'profile_picture' => 'Foto de Perfil',
        'change_picture' => 'Cambiar Foto',
        'delete_picture' => 'Eliminar Foto',
        'name' => 'Nombre',
        'email' => 'Correo Electrónico',
        'role' => 'Rol',
        'joined' => 'Miembro desde',
        'update_profile' => 'Actualizar Perfil',
        'confirm_changes' => 'Por tu seguridad, ingresa tu contraseña para confirmar los cambios.',
        'enter_password_to_save' => 'Ingresa tu contraseña para guardar los cambios',
        'security' => [
            'title' => 'Seguridad de la Cuenta',
            'description' => 'Actualiza tu contraseña para mantener tu cuenta segura.',
            'change_password' => 'Cambiar Contraseña',
            'current_password' => 'Contraseña Actual',
            'new_password' => 'Nueva Contraseña',
            'confirm_new_password' => 'Confirmar Nueva Contraseña',
            'password_help' => 'La contraseña debe tener al menos 8 caracteres.',
        ],
        'image' => [
            'select' => 'Seleccionar imagen',
            'current' => 'Imagen actual',
            'remove' => 'Eliminar imagen',
            'help' => 'Formatos permitidos: JPG, PNG, GIF. Máx. 2MB.',
            'save' => 'Guardar Foto',
            'text_null' => 'No se ha seleccionado ninguna imagen.',
            'delete_confirm' => '¿Estás seguro de que deseas eliminar tu foto de perfil?',
            'delete_success' => 'Foto de perfil eliminada exitosamente.',
        ],
    ],
    'auth' => [
        'logout' => [
            'success' => 'Has cerrado sesión exitosamente.',
        ],
        'login' => [
            'title' => 'Iniciar Sesión',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'submit' => 'Entrar',
            'success' => '¡Inicio de sesión exitoso! Bienvenido de nuevo.',
            'register_link' => '¿No tienes una cuenta? Regístrate',
            'remember_me' => 'Recuérdame',
            'welcome' => '¡Bienvenido de nuevo!',
            'verified' => 'Tu correo ha sido verificado exitosamente. Ahora puedes iniciar sesión.',
            'forgot_password' => '¿Olvidaste tu contraseña?',
            'error' => [
                'invalid_credentials' => 'Credenciales inválidas',
                'inactive_user' => 'Usuario inactivo. Por favor, verifica tu correo.',
                'email_not_verified' => 'Correo no verificado. Por favor, verifica tu correo.',
                'email_verified_link' => 'El enlace de verificación es inválido o ya fue usado.',
                ]
            ],
            'forgot_password' => [
                'title' => 'Recuperar Contraseña',
                'instructions' => 'Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.',
                'email' => 'Correo Electrónico',
                'email_placeholder' => 'tu@ejemplo.com',
                'submit' => 'Enviar Enlace de Recuperación',
                'back_to_login' => 'Volver al Inicio de Sesión',
                'email_not_exists'=> 'El correo electrónico no existe.',
                'sended' => 'Instrucciones enviadas a tu correo.',
                'password_reset_success' => 'Contraseña actualizada exitosamente. Ahora puedes iniciar sesión con tu nueva contraseña.',
                'password_reset_failed' => 'Error al actualizar la contraseña. Por favor, intenta nuevamente.',
            ],
            'new_password' => [
                'title' => 'Establecer Nueva Contraseña',
                'instructions' => 'Ingresa tu nueva contraseña. Asegúrate de que sea segura y diferente de las anteriores.',
                'password' => 'Nueva Contraseña',
                'password_placeholder' => 'Mínimo 8 caracteres',
                'password_help' => 'La contraseña debe tener al menos 8 caracteres.',
                'password_confirm' => 'Confirmar Contraseña',
                'password_confirm_placeholder' => 'Repite tu contraseña',
                'submit' => 'Actualizar Contraseña',
                'back_to_login' => 'Volver al Inicio de Sesión'
            ],
            'register' => [
                'title' => 'Crear Cuenta',
                'name' => 'Nombre Completo',
                'email' => 'Correo Electrónico',
                'password' => 'Contraseña',
                'password_confirm' => 'Confirmar Contraseña',
                'submit' => 'Crear Cuenta',
                'login_link' => '¿Ya tienes una cuenta? Inicia Sesión',
                'success' => 'Registro exitoso. Por favor, verifica tu correo.',
            ],
            'mail_verify' => [
                'title' => 'Verifica tu Correo',
                'instruction' => 'Se ha enviado un enlace de verificación a tu dirección de correo electrónico.',
                'check_email' => 'Por favor revisa tu email y haz clic en el enlace para verificar tu cuenta.',
                'spam_notice' => 'Si no ves el correo, por favor revisa tu carpeta de spam.',
                'resend_button' => 'Reenviar Correo de Verificación',
            ],
            ]
        ];