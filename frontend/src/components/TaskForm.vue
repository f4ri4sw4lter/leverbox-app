<template>
  <form @submit.prevent="submit">
    <input v-model="task.titulo" placeholder="Título" />
    <textarea v-model="task.descripcion" placeholder="Descripción"></textarea>
    <select v-model="task.estado">
      <option value="pendiente">Pendiente</option>
      <option value="en_progreso">En Progreso</option>
      <option value="completada">Completada</option>
    </select>
    <input type="date" v-model="task.fecha_vencimiento" />
    <button type="submit">Guardar</button>
  </form>
</template>

<script setup lang="ts">

import { ref, onMounted } from 'vue';
import { useTaskStore, Task } from '../stores/taskStore';
import { useRoute, useRouter } from 'vue-router';
import api from '../services/api';

const store = useTaskStore();
const route = useRoute();
const router = useRouter();

const task = ref<Partial<Task>>({
  titulo: '',
  descripcion: '',
  estado: 'pendiente',
  fecha_vencimiento: undefined,
  prioridad_id: 1,
});

onMounted(async () => {
  if (route.params.id) {
    const { data } = await api.get(`/tareas/${route.params.id}`);
    task.value = data;
  }
});

async function submit() {
  if (route.params.id) {
    await store.updateTask(task.value as Task);
  } else {
    await store.createTask(task.value);
  }
  router.push('/');
}
</script>
