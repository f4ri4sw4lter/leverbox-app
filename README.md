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

Clonar el archivo `.env.example` ya está configurado con valores por defecto:

```bash
cp .env.example .env
```

El archivo `frontend/.env` está configurado para desarrollo:
```bash
VITE_API_BASE_URL=http://localhost:8081
VITE_APP_NAME="Laravel Vue3 App"
```

## Ejecución del proyecto

### 1. Levantar los servicios

Para levantar todos los proyectos (backend, frontend, base de datos y nginx) juntos, ejecuta:

```bash
docker compose up --build
```

Esto construirá y levantará todos los servicios definidos en el archivo `docker-compose.yml`.

### 2. Corre las migraciones

```bash
docker exec -it php_82 bash
php artisan migrate
php artisan key:generate
php artisan db:seed
```

Esto construirá y levantará todos los servicios definidos en el archivo `docker-compose.yml`.

## 🌐 Servicios disponibles

- **Frontend (Vue3):** [http://localhost:5173](http://localhost:5173)
- **Backend (Laravel):** [http://localhost:8081](http://localhost:8081)
- **Base de datos MySQL:** `localhost:3330`