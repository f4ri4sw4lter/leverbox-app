# Leverbox Desafio

Proyecto Full-Stack con Laravel 12 (Backend) y Vue3+Vite (Frontend) usando Docker, optimizado para compatibilidad Windows/Linux.

## Características

- **Backend:** Laravel 12 con PHP 8.2
- **Frontend:** Vue 3 + Vite + TypeScript + Vue Router + Pinia
- **Base de datos:** MySQL 8.0
- **Servidor web:** Nginx

## Requisitos Previos

- Docker Desktop instalado y ejecutándose

## Configuración del Entorno

### 1. Clonar o descargar el proyecto

```bash
git clone <repository-url> nombre-proyecto
cd nombre-proyecto
```

### 2. Configuración de variables de entorno

Copiar los archivos `.env.example` que ya estan configurado con valores por defecto:

```bash
cp .env.example .env
cp frontend/.env.example frontend/.env
cp backend/.env.example backend/.env
```

## Ejecución del proyecto

### 1. Levantar los servicios

Para levantar todos los proyectos (backend, frontend, base de datos y nginx) juntos, ejecuta:

```bash
docker compose up -d
```

Esto construirá y levantará todos los servicios definidos en el archivo `docker-compose.yml`.

### 2. Instalar las dependencias, migraciones y seeders

```bash
docker exec -it php_82 sh
composer install
php artisan migrate
php artisan key:generate
php artisan db:seed
```

Esto construirá y levantará todos los servicios definidos en el archivo `docker-compose.yml`.

## 🌐 Servicios disponibles

- **Frontend (Vue3):** [http://localhost:5173](http://localhost:5173)
- **Backend (Laravel):** [http://localhost:8081](http://localhost:8081)
- **Base de datos MySQL:** `localhost:3330`
