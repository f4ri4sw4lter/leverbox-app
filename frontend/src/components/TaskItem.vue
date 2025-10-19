<template>
  <li>
    <strong> {{ task.titulo }}</strong> - {{ task.estado }}
    <router-link :to="`/editar/${task.id}`">Editar</router-link>
    <button @click="$emit('delete', task.id)">Eliminar</button>
  </li>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { onMounted } from 'vue';
import type { Task } from '../stores/taskStore';

const props = defineProps<{ task: Task }>();

onMounted(() => {
  console.log('Cadena recibida:', props.task);
})
</script>
