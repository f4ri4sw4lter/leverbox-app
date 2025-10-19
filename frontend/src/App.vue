<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4">
      <h1 class="text-2xl font-bold">Gestión de Tareas</h1>
    </header>

    <!-- Contenido principal -->
    <main class="p-6">
      <router-view />
    </main>

    <!-- Footer opcional -->
    <footer class="bg-gray-200 text-gray-700 p-4 text-center">
      &copy; 2025 Mi Aplicación de Tareas
    </footer>
  </div>
</template>

<script setup lang="ts">
// Aquí no hace falta lógica por ahora.
// El router y store se usan en los componentes hijos.
</script>

<style>
/* Puedes agregar estilos globales aquí si no usas Tailwind */
</style>
