<template>
  <li class="list-group-item">

    <div class="d-flex justify-content-between align-items-start">

      <div class="col-md-10">
        <h5 class="mb-1"><router-link :to="`/ver/${tarea.id}`" class="text-decoration-none">{{ tarea.titulo }}</router-link></h5>
        <p class="mb-1 text-muted">{{ tarea.descripcion }}</p>
      </div>

      <div class="col-md-1 d-flex align-items-center vertical-center">
        <small class="text-secondary"><span class="badge bg-info text-dark text-uppercase">{{ tarea.estado }}</span></small>
      </div>

      <div class="col-md-1 d-flex text-center">
        <p>Vencimiento {{ tarea.fecha_vencimiento }}</p>
      </div>

    </div>

  </li>
</template>

<script setup lang="ts">
import { defineProps, onMounted } from 'vue';
import { useTareaStore, Tarea } from '@/stores/tareaStore';

const store = useTareaStore();
const props = defineProps<{ tarea: Tarea }>();

async function eliminarTarea() {
  await store.eliminarTarea(props.tarea.id);
}

</script>
