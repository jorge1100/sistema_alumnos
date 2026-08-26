📘 Guía de Instalación y Uso
DocentesAlumnos

UTN – Técnicatura Universitaria en Programación
 Programación IV
 Laravel 13 · MySQL · Docker · Blade · Tailwind CSS · Breeze

📋 Descripción del sistema

DocentesAlumnos es una aplicación web desarrollada con Laravel 13 que permite la gestión de usuarios con distintos niveles de acceso.

Roles disponibles
👨‍🏫 Docente / Administrador

Puede:

Iniciar sesión como administrador.
Ver el listado completo de alumnos registrados.
Consultar el detalle de cualquier usuario.
Acceder a los enlaces de WhatsApp y redes profesionales de los alumnos.
👨‍🎓 Alumno

Puede:

Registrarse en la aplicación.
Subir una foto de perfil.
Ver su información personal.
Modificar únicamente su propio perfil.
🐳 Requisitos Previos

Para ejecutar el sistema solo se necesita:

Docker Desktop
https://www.docker.com/products/docker-desktop/
Git
https://git-scm.com/

Verificar instalación:

Shell
1
docker --version
2
docker compose version
3
git --version
Mostrar más líneas
🚀 Instalación del Proyecto
1. Clonar el repositorio
Shell
1
git clone https://github.com/USUARIO/DocentesAlumnos.git
2
cd DocentesAlumnos
Mostrar más líneas
2. Copiar variables de entorno
Shell
1
cp .env.example .env
Mostrar más líneas
3. Levantar los contenedores
Shell
1
docker compose up -d --build
Mostrar más líneas

Docker descargará y configurará automáticamente:

PHP 8.3
Laravel 13
Composer
Node.js
MySQL
Nginx

Este proceso puede tardar algunos minutos la primera vez.

4. Generar la clave de la aplicación
Shell
1
docker compose exec app php artisan key:generate
Mostrar más líneas
5. Ejecutar migraciones y seeders
Shell
1
docker compose exec app php artisan migrate:fresh --seed
Mostrar más líneas

Esto creará:

La base de datos.
Todas las tablas necesarias.
El usuario administrador de prueba.
6. Crear enlace para almacenamiento de fotos
Shell
1
docker compose exec app php artisan storage:link
Mostrar más líneas
7. Compilar assets

Si el proyecto ya incluye los assets compilados este paso no será necesario.

Caso contrario:

Shell
1
docker compose exec app npm install
2
docker compose exec app npm run build
Mostrar más líneas
8. Acceder al sistema

Abrir:

Plain Text
1
http://localhost:8000
Mostrar más líneas
🔐 Credenciales de Prueba
Administrador
Plain Text
1
Email: admin@utn.edu.ar
2
Password: password
Mostrar más líneas
Alumno

Registrarse desde:

Plain Text
1
http://localhost:8000/register
Mostrar más líneas
🗂️ Estructura Docker
Plain Text
1
DocentesAlumnos
2
│
3
├── app/
4
├── bootstrap/
5
├── config/
6
├── database/
7
├── public/
8
├── resources/
9
├── routes/
10
├── storage/
11
│
12
├── docker/
13
│ ├── nginx/
14
│ │ └── default.conf
15
│ └── php/
16
│ └── Dockerfile
17
│
18
├── docker-compose.yml
19
├── .env.example
20
└── README.md
Mostrar más líneas
⚙️ Variables de Entorno

El archivo .env ya viene preparado para Docker.

Plain Text
env no es totalmente compatible. El resaltado de sintaxis se basa en Plain Text.
1
APP_NAME=DocentesAlumnos
2
 
3
DB_CONNECTION=mysql
4
DB_HOST=db
5
DB_PORT=3306
6
DB_DATABASE=docentes_alumnos
7
DB_USERNAME=laravel
8
DB_PASSWORD=secret
9
 
10
WHATSAPP_PREFIX=+54
Mostrar más líneas
🧪 Flujo de Uso
Como Docente
Iniciar sesión con:
Plain Text
1
admin@utn.edu.ar
2
password
Mostrar más líneas
Acceder a:
Plain Text
1
Usuarios
2
``
Mostrar más líneas

Ver el listado completo de alumnos.

Consultar el detalle de cualquier usuario.

Utilizar:

Enlace directo a WhatsApp.
Enlace a LinkedIn, GitHub u otra red profesional.
Foto de perfil.
Como Alumno
Registrarse.
Completar todos los campos solicitados.
Subir foto de perfil.
Iniciar sesión.
Acceder a:
Plain Text
1
Perfil
Mostrar más líneas
Editar información personal.
🗄️ Modelo de Datos

Tabla principal: users

Campos relevantes:

Plain Text
1
id
2
name
3
email
4
password
5
is_admin
6
phone
7
professional_url
8
photo_path
9
email_verified_at
10
remember_token
11
created_at
12
updated_at
Mostrar más líneas
🛠️ Comandos Útiles
Ver logs
Shell
1
docker compose logs -f
Mostrar más líneas
Ingresar al contenedor
Shell
1
docker compose exec app bash
Mostrar más líneas
Reiniciar contenedores
Shell
1
docker compose restart
Mostrar más líneas
Detener el proyecto
Shell
1
docker compose down
Mostrar más líneas
Eliminar y reconstruir todo
Shell
1
docker compose down -v
2
docker compose up -d --build
Mostrar más líneas
🐛 Solución de Problemas
Error de migraciones

Ejecutar:

Shell
1
docker compose exec app php artisan migrate:fresh --seed
Mostrar más líneas
La imagen no se muestra

Verificar:

Shell
1
docker compose exec app php artisan storage:link
Mostrar más líneas

Comprobar que exista:

Plain Text
1
storage/app/public/profiles
Mostrar más líneas
Error de conexión con MySQL

Verificar contenedores activos:

Shell
1
docker compose ps
Mostrar más líneas

La base de datos debe aparecer como:

Plain Text
1
db running
Mostrar más líneas
Reconstrucción completa
Shell
1
docker compose down -v
2
docker compose up -d --build
3
docker compose exec app php artisan migrate:fresh --seed
Mostrar más líneas
📚 Tecnologías Utilizadas
Laravel 13
PHP 8.3
MySQL 8
Docker & Docker Compose
Laravel Breeze
Blade
Tailwind CSS
Vite
✅ Instalación rápida (TL;DR)
Shell
1
git clone https://github.com/USUARIO/DocentesAlumnos.git
2
cd DocentesAlumnos
3
 
4
cp .env.example .env
5
 
6
docker compose up -d --build
7
 
8
docker compose exec app php artisan key:generate
9
docker compose exec app php artisan migrate:fresh --seed
10
docker compose exec app php artisan storage:link
11
 
12
http://localhost:8000
Mostrar más líneas

Con estos pasos cualquier docente puede clonar el repositorio y tener el proyecto funcionando sin instalar PHP, Composer, Node.js ni MySQL en su computadora.
