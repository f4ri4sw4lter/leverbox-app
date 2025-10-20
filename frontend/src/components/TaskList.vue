<template>
  <div class="row g-4 width-100">
    <div class="col-12 px-4">
      <router-link to="/crear" class="btn btn-primary mb-4">Crear Nueva Tarea</router-link>

      <ul class="list-group gap-4">
        <TaskItem v-for="task in store.tasks" :key="task.id" :task="task" @delete="deleteTask"/>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">

import { useTaskStore } from '../stores/taskStore';
import { onMounted } from 'vue';
import TaskItem from './TaskItem.vue';

const store = useTaskStore();

onMounted(() => {
  store.fetchTasks();
});

function deleteTask(id: number) {
  store.deleteTask(id);
}
</script>
