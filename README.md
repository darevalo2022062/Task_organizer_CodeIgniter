# 🎓 Sistema Organizador de Tareas Escolares  
> Proyecto académico desarrollado con **PHP 8.2**, **CodeIgniter 4** y **MariaDB**, bajo el patrón **MVC**.  
> Diseñado para optimizar la gestión de tareas, cursos y entregas entre **docentes** y **alumnos** de nivel básico.  

---

## 🚀 Descripción General
Este sistema surge de la necesidad de una maestra que busca **organizar mejor las tareas y actividades escolares**.  
Permite registrar usuarios (docentes y estudiantes), gestionar cursos, asignar tareas, recibir entregas y calificar.  

El proyecto fue construido con una **arquitectura limpia**, **segura** y **escalable**, implementando principios de diseño **MVC** y estándares modernos de PHP.

---

## 🧠 Características Principales
✅ Registro, autenticación y roles de usuario (docente / estudiante).  
✅ Gestión de cursos y asignaciones.  
✅ Creación y edición de tareas por curso.  
✅ Subida de archivos por parte de los estudiantes.  
✅ Calificación y control de estado de entregas.  
✅ Soporte multilenguaje (Español / Inglés).  
✅ Sistema de activación por correo electrónico y recuperación de contraseña.  
✅ CRUD completo con validaciones, timestamps y soft deletes.  
✅ Compatible con despliegue en GitHub y entornos virtualizados (Lubuntu / XAMPP).

---

## 🧩 Arquitectura
El sistema sigue el modelo **MVC (Model–View–Controller)** nativo de CodeIgniter:

``` bash
/app
├── Controllers/ # Lógica de negocio (User, Course, Task, Submission)
├── Models/ # Acceso a datos y relaciones
├── Views/ # Interfaz HTML + Bootstrap 5
├── Database/
│ ├── Migrations/ # Versionado de estructura de tablas
│ └── Seeds/ # Datos iniciales (Admin, roles, etc.)
└── Config/ # Rutas, filtros, validaciones e idiomas
```


---

## 🧱 Diseño de Base de Datos
### Diagrama Entidad–Relación
> Total: **5 tablas principales + relaciones foráneas**  

| Tabla | Descripción |
|-------|--------------|
| **users** | Registro y autenticación de usuarios con roles. |
| **courses** | Cursos gestionados por los docentes. |
| **tasks** | Actividades asociadas a cursos. |
| **assignments** | Relación alumno ↔ curso (inscripciones). |
| **submissions** | Entregas de tareas por parte de los alumnos. |

**Relaciones principales:**
- Un `user (teacher)` tiene muchos `courses`.
- Un `course` tiene muchas `tasks`.
- Un `user (student)` puede estar en muchos `courses` (via `assignments`).
- Un `user` puede realizar muchas `submissions` a distintas `tasks`.

---

## 🛠️ Tecnologías Utilizadas
| Componente | Versión | Descripción |
|-------------|----------|-------------|
| **PHP** | 8.2+ | Lenguaje principal del backend. |
| **CodeIgniter** | 4.6+ | Framework MVC liviano y eficiente. |
| **MariaDB** | 10.4+ | Sistema de base de datos relacional. |
| **Bootstrap** | 5.3 | Diseño moderno y responsive. |
| **phpMyAdmin** | XAMPP | Administración visual de la base de datos. |
| **Composer** | 2.x | Gestión de dependencias PHP. |

---

## 🧾 Requerimientos
- PHP 8.2 o superior  
- Composer 2.x  
- MariaDB / MySQL  
- Servidor local (XAMPP o Apache)  
- Navegador moderno (Chrome, Firefox, Edge)

---

## ⚙️ Instalación y Configuración

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/tuusuario/organizador.git
cd organizador
```
---

## 2️⃣ Instalar dependencias
composer install

### 3️⃣ Configurar entorno

> Copia el archivo de entorno:
    - cp .env.example .env
    - Edita .env y ajusta la conexión a tu BD local (XAMPP o MariaDB):

``` bash
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = 127.0.0.1
database.default.database = organizador_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.charset = utf8mb4
```
---

# DB SQL CODE
```sql
-- Tabla: users
-- =========================
CREATE TABLE users (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  name             VARCHAR(100) NOT NULL,
  email            VARCHAR(120) NOT NULL UNIQUE,
  password_hash    VARCHAR(255) NOT NULL,
  role             VARCHAR(50)  NOT NULL DEFAULT 'student',
  status           TINYINT(1)   NOT NULL DEFAULT 1,
  confirm_email_at DATETIME NULL,
  image_path       VARCHAR(255) NULL,
  created_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at       DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX idx_users_status ON users (status);
CREATE INDEX idx_users_role   ON users (role);

-- Tabla: courses
-- =========================
CREATE TABLE courses (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  name             VARCHAR(120) NOT NULL,
  description      TEXT NULL,
  teacher_owner_id INT NOT NULL,
  status           TINYINT(1) NOT NULL DEFAULT 1,
  created_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at       DATETIME NULL,
  CONSTRAINT fk_courses_teacher
    FOREIGN KEY (teacher_owner_id) REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX idx_courses_teacher ON courses (teacher_owner_id);
CREATE INDEX idx_courses_status  ON courses (status);

-- Tabla: tasks
-- =========================
CREATE TABLE tasks (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  course_id   INT NOT NULL,
  status      TINYINT(1) NOT NULL DEFAULT 1,
  created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at  DATETIME NULL,
  CONSTRAINT fk_tasks_course
    FOREIGN KEY (course_id) REFERENCES courses(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE INDEX idx_tasks_course  ON tasks (course_id);
CREATE INDEX idx_tasks_status  ON tasks (status);

-- Tabla: assignments (inscripciones usuario-curso)
-- =========================
CREATE TABLE assignments (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  id_user    INT NOT NULL,
  id_course  INT NOT NULL,

  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,

  CONSTRAINT uq_assignment UNIQUE (id_user, id_course),
  CONSTRAINT fk_assign_user
    FOREIGN KEY (id_user) REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT fk_assign_course
    FOREIGN KEY (id_course) REFERENCES courses(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX idx_assign_user   ON assignments (id_user);
CREATE INDEX idx_assign_course ON assignments (id_course);

-- Tabla: submissions (entregas de tareas)
-- =========================
CREATE TABLE submissions (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  user_id       INT NOT NULL,
  task_id       INT NOT NULL,
  file_path     VARCHAR(255) NOT NULL,
  file_name     VARCHAR(255) NULL,
  status_submit VARCHAR(50)  NOT NULL DEFAULT 'pending',
  grade         DECIMAL(5,2) NULL,
  status        TINYINT(1)  NOT NULL DEFAULT 1,
  created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at    DATETIME NULL,
  CONSTRAINT fk_sub_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT fk_sub_task
    FOREIGN KEY (task_id) REFERENCES tasks(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX idx_submissions_user  ON submissions (user_id);
CREATE INDEX idx_submissions_task  ON submissions (task_id);
CREATE INDEX idx_submissions_stat  ON submissions (status_submit);

-- Admin seed
-- =========================
INSERT INTO users (name, email, password_hash, role, status, confirm_email_at)
VALUES ('Admin', 'admin@example.com', 
        -- Password: Admin123!
        '$2y$10$wQbHq1pZQ2vK3Qk8T2k8N.uA04n2i6w2m0a0E2s6tN8s6c0h0t3cm',
        'admin', 1, NOW())
ON DUPLICATE KEY UPDATE email = email;
```