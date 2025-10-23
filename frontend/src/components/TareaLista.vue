<template>

  <div class="row g-4 width-100">

    <div class="col-12 px-4">
      <div class="d-flex justify-content-end">
        <router-link to="/crear" class="btn btn-primary mb-4 ">Nueva Tarea <i class="bi bi-plus"></i></router-link>
      </div>

      <div class="col-12 d-flex justify-content-end border border-secondary rounded p-2 mb-4" id="filtros">
        <div class="row g-2 mb-3 align-items-end">
          <div class="col-auto">
            <label class="form-label small mb-1">Estado</label>
            <select class="form-select" v-model="estadoFilter">
              <option value="">Todos</option>
              <option value="pendiente">Pendiente</option>
              <option value="en_progreso">En progreso</option>
              <option value="completada">Completada</option>
            </select>
          </div>

          <div class="col-auto">
            <label class="form-label small mb-1">Vence desde</label>
            <input type="date" class="form-control" v-model="fechaDesde" />
          </div>

          <div class="col-auto">
            <label class="form-label small mb-1">Vence hasta</label>
            <input type="date" class="form-control" v-model="fechaHasta" />
          </div>

          <div class="col-auto">
            <button class="btn btn-outline-secondary" @click.prevent="limpiarFiltros">Limpiar</button>
          </div>
        </div>
      </div>

      <ul class="list-group border border-secondary rounded">
        <TareaItem v-for="tarea in filteredTareas" :key="tarea.id" :tarea="tarea" @delete="eliminarTarea"/>
      </ul>
    </div>

  </div>

</template>

<script setup lang="ts">

import { useTareaStore } from '@/stores/tareaStore';
import { onMounted, ref, computed } from 'vue';
import TareaItem from './TareaItem.vue';
import { Tarea } from '@/stores/tareaStore';

const store = useTareaStore();

onMounted(() => {
  store.fetchTareas();
});

function eliminarTarea(id: number) {
  store.eliminarTarea(id);
}

const estadoFilter = ref<string>('');
const fechaDesde = ref<string>('');
const fechaHasta = ref<string>('');

const filteredTareas = computed(() => {

  const list = store.tareas ?? [];

  return list.filter((tarea: Tarea) => {
    // filtro por estado
    if (estadoFilter.value && tarea.estado !== estadoFilter.value) return false;

    // filtro por fecha
    if (fechaDesde.value) {
      if (!tarea.fecha_vencimiento) return false;
      if (new Date(tarea.fecha_vencimiento) < new Date(fechaDesde.value)) return false;
    }

    if (fechaHasta.value) {
      if (!tarea.fecha_vencimiento) return false;
      // comparar inclusive hasta la fecha
      const vence = new Date(tarea.fecha_vencimiento);
      const hasta = new Date(fechaHasta.value);
      // normalizar horas para evitar off-by-one
      vence.setHours(0,0,0,0);
      hasta.setHours(23,59,59,999);
      if (vence > hasta) return false;
    }

    return true;
  });
});

function limpiarFiltros() {
  estadoFilter.value = '';
  fechaDesde.value = '';
  fechaHasta.value = '';
}
</script>
