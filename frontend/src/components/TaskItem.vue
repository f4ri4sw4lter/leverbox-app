<template>
  <li class="list-group-item">
    <div class="d-flex justify-content-between align-items-start">
      <div>
        <h5 class="mb-1">{{ task.titulo }}</h5>
        <p class="mb-1 text-muted">{{ task.descripcion }}</p>
        <small class="text-secondary">Estado: <span class="badge bg-info text-dark text-uppercase">{{ task.estado }}</span></small>
      </div>
      <div class="text-end">
        <div>
          <router-link :to="`/editar/${task.id}`" class="btn btn-sm btn-primary me-1">Editar</router-link>
          <button type="button" class="btn btn-sm btn-danger" @click="deleteTask">Eliminar</button>
        </div>
      </div>
    </div>
  </li>
</template>

<script setup lang="ts">
import { defineProps, onMounted } from 'vue';
import { useTaskStore, Task } from '../stores/taskStore';

const store = useTaskStore();
const props = defineProps<{ task: Task }>();

async function deleteTask() {
  await store.deleteTask(props.task.id);
}

</script>
