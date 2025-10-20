<template>
  <form @submit.prevent="submit" class="card p-3">
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input v-model="task.titulo" placeholder="Título de la tarea" type="text" class="form-control" required />
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
       <textarea v-model="task.descripcion" class="form-control" roows="3" placeholder="Describa la tarea a realizar"></textarea>
    </div>

    <div class="row g-2 align-items-center mb-3">
      <div class="col-auto">
        <label class="form-label">Estado</label>
        <select v-model="task.estado" class="form-select">
          <option value="pendiente">Pendiente</option>
          <option value="en_progreso">En progreso</option>
          <option value="completada">Completada</option>
        </select>
      </div>

      <div class="col-auto">
        <label class="form-label">Vence</label>
        <input v-model="task.fecha_vencimiento" type="date" class="form-control" />
      </div>

    </div>

    <div class="d-flex justify-content-end gap-2">
      <button class="btn btn-success col-6" type="submit">Guardar</button>
      <button type="button" class="btn btn-secondary col-6" @click="goBack">Volver</button>
    </div>
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
    task.value = await store.fetchTask(Number(route.params.id));
  }
});

async function submit() {
  if (route.params.id) {
    await store.updateTask(task.value as Task);
  } else {
    await store.createTask(task.value);
    console.log('Creando tarea', task.value);
  }
  router.push('/');
}

function goBack() {
  router.back()
}
</script>
