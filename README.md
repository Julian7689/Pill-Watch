🏥 Pill Watch - Sistema de Gestión de Medicamentos

📦 Instalación de Dependencias con Breeze

🛠️ Prerrequisitos

PHP 8.1+

Composer

Node.js

MySQL o PostgreSQL

🚀 Pasos de Instalación

1️⃣ Clonar Repositorio

git clone https://github.com/Julian7689/Pill-Watch.git
cd Pill-Watch

2️⃣ Instalar Dependencias de Composer

# Instalar dependencias principales
composer install

# Instalar Breeze como dependencia de desarrollo
composer require laravel/breeze --dev

3️⃣ Instalar Breeze y Configurar Frontend

# Ejecutar instalación de Breeze
php artisan breeze:install

# Seleccionar opciones:
# - Frontend: Blade
# - Estilos: Tailwind CSS
# - escoje despues la opcion 0 
4️⃣ Configurar Entorno

# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

✏️ Configurar base de datos en .env

Editar las credenciales de:

DB_CONNECTION

DB_HOST

DB_PORT

DB_DATABASE

DB_USERNAME

DB_PASSWORD

📂 Migraciones Disponibles

Archivo de Migración

Descripción

0001_01_01_000000_create_users_table.php

Tabla de usuarios

0001_01_01_000001_create_cache_table.php

Tabla de caché

0001_01_01_000002_create_jobs_table.php

Tabla de trabajos en segundo plano

2025_03_16_171838_create_medicamentos_table.php

Tabla de medicamentos

2025_03_16_171843_create_notificaciones_table.php

Tabla de notificaciones

2025_03_16_171847_create_dosis_table.php

Tabla de dosis de medicamentos

2025_03_16_171854_create_historial_table.php

Tabla de historial médico

2025_03_16_171858_create_horarios_table.php

Tabla de horarios de medicación

5️⃣ Configurar Base de Datos

# Ejecutar migraciones
php artisan migrate

# (Opcional) Sembrar datos iniciales
php artisan db:seed

6️⃣ Instalar Dependencias de Frontend

# Instalar dependencias de Node
npm install

# Compilar assets
npm run dev

7️⃣ Iniciar Servidor Local

# Iniciar servidor de desarrollo
php artisan serve

⚡ Comandos Rápidos

Comando

Descripción

php artisan migrate

Actualizar esquema de base de datos

php artisan migrate:status

Ver estado de migraciones

php artisan migrate:fresh

Reiniciar todas las migraciones

php artisan make:migration

Crear nueva migración

🔍 Detalles de Migraciones

Las migraciones definen la estructura de la base de datos.

Cada migración crea o modifica tablas específicas.

Útil para control de versiones del esquema de base de datos.

📋 Notas Importantes

✅ Revisa cada migración antes de ejecutarla.⚠️ Usa migrate:fresh con precaución en producción.🔄 Mantén un respaldo de la base de datos antes de grandes cambios.

🚀 ¡Listo! Ahora puedes comenzar a usar Pill Watch. 🎉

