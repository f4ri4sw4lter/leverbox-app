<template>
  <div>
    <h1>Tareas</h1>
    <router-link to="/crear">Crear Nueva Tarea</router-link>
    <ul>
      <TaskItem v-for="task in store.tasks" :key="task.id" :task="task" @delete="deleteTask"/>
    </ul>
  </div>
</template>

<script setup lang="ts">

import { useTaskStore } from '../stores/taskStore';
import { onMounted } from 'vue';
import TaskItem from './TaskItem.vue';

const store = useTaskStore();
let tasks = [] as Task[];

onMounted(async () => {
  await store.fetchTasks();
});

function deleteTask(id: number) {
  store.deleteTask(id);
}
</script>
