<template>
  <li class="list-group-item">

    <div class="d-flex justify-content-between align-items-start">

      <div class="col-md-9">
        <h5 class="mb-1"><router-link :to="`/ver/${tarea.id}`" class="text-decoration-none">
          {{ tarea.titulo}}
        </router-link></h5>
        <p class="mb-1 text-muted">{{ tarea.descripcion }}</p>
      </div>

      <div class="col-md-1 d-flex align-items-center vertical-center">
        <small class="text-secondary"><span class="badge bg-info text-dark text-uppercase">
          {{ tarea.estado}}
        </span></small>
      </div>

      <div class="col-md-1 d-flex align-items-center vertical-center">
        <small class="text-secondary">
          <span class="badge text-dark text-uppercase" :style="{backgroundColor: tarea.prioridad.color, color: '#fff'}">
          {{ tarea.prioridad.prioridad}}
          </span>
        </small>
      </div>

      <div class="col-md-1 d-flex text-center">
        <p>{{ formattedDate }}</p>
      </div>

    </div>

  </li>
</template>

<script setup lang="ts">
import { defineProps, computed } from 'vue';
import { useTareaStore, Tarea } from '@/stores/tareaStore';

const store = useTareaStore();
const { tarea } = defineProps<{ tarea: Tarea }>();


const formattedDate = computed(() => {
  const raw = tarea.fecha_vencimiento;
  if (!raw) return '';

  // si ya viene formateada dd-mm-yyyy
  if (/^\d{2}-\d{2}-\d{4}$/.test(String(raw))) return String(raw);

  // intentar parsear ISO / timestamp
  const d = new Date(String(raw));
  if (isNaN(d.getTime())) return String(raw); // fallback

  const dd = String(d.getDate()).padStart(2, '0');
  const mm = String(d.getMonth() + 1).padStart(2, '0');
  const yyyy = d.getFullYear();
  return `${dd}-${mm}-${yyyy}`;
});

const prioridadStyle = computed(() => {
  return {
    backgroundColor: tarea.prioridad.color, color: '#fff'
  };
});

</script>
