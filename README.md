
# SGLPWEB - Sistema de Gestión de Casos Jurídicos

Este proyecto es un sistema web desarrollado con **Laravel** para gestionar casos jurídicos en la firma LegalPro. Permite a los usuarios internos registrar casos, tareas, plazos en calendario y a los clientes visualizar sus casos con evidencias.

---

## 📦 Requisitos

- PHP 8.1 o superior
- Composer
- Postgresql


## ⚙️ Instalación del Proyecto

```bash
# 1. Clonar el repositorio
https://github.com/Jesus115/oficinaJuridica.git
cd oficinaJuridica

# 2. Instalar dependencias
composer install

# 3. Crear archivo de entorno
cp .env.example .env

# 4. Configurar variables de entorno
# Editar .env y configurar la conexión a base de datos

# 5. Generar clave de aplicación
php artisan key:generate

# 6. Ejecutar migraciones
php artisan migrate

# 7. Crear enlace simbólico para archivos públicos (evidencias)
php artisan storage:link

# 8. Servir la aplicación
php artisan serve
```

---

## 👤 Accesos de prueba

Puedes usar los siguientes accesos después de crear usuarios manualmente con tinker o seeder:

- **Usuario interno**
  - Email: `admin@example.com`
  - Password: `password`

- **Cliente**
  - Email: `cliente@example.com`
  - Password: `password`

---

## 🛡️ Guard Authentication

- `web` para usuarios internos
- `cliente` para clientes externos con acceso restringido al portal

---

## 🧪 Pruebas

El sistema fue probado manualmente validando:

- CRUD de casos, tareas, calendario
- Acceso por tipo de usuario
- Subida de evidencias y su visibilidad
- Restricción de rutas protegidas