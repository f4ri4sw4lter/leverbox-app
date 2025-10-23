<template>
  <div class="min-h-screen bg-gray-100">

    <header class="bg-blue-600 text-center p-4">
    </header>

    <main class="p-6 mx-5">
      <router-view/>
    </main>

    <footer class="bg-gray-200 text-gray-700 p-4 text-center">
      &copy; 2025 Aplicación de tareas de Leverbox
    </footer>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';

onMounted(() => {
  window.addEventListener('api-error', (e: any) => {
    const payload = e.detail ?? {};
    // simple visual: puedes usar Bootstrap Toast aquí
    // ejemplo rápido con alert (sustituir por Toast para mejor UX)
    // alert(`${payload.status ?? ''} - ${payload.message}`);
    // implementar toast DOM mínimo:
    const container = document.getElementById('api-toast');
    if (!container) return;
    const el = document.createElement('div');
    el.className = 'alert alert-danger shadow';
    el.style.marginBottom = '0.5rem';
    el.innerText = `${payload.status ?? ''} — ${payload.message ?? 'Error'}`;
    container.appendChild(el);
    setTimeout(() => el.remove(), 6000);
  });
});
</script>

<style>
</style>
