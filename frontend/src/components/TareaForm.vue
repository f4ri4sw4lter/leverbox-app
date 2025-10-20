<template>
  <form @submit.prevent="submit" class="card p-3">
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input v-model="tarea.titulo" placeholder="Título de la tarea" type="text" class="form-control" required />
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea v-model="tarea.descripcion" class="form-control" roows="3"
        placeholder="Describa la tarea a realizar"></textarea>
    </div>

    <div class="row g-2 align-items-center mb-3">
      <div class="col-auto">
        <label class="form-label">Estado</label>
        <select v-model="tarea.estado" class="form-select">
          <option value="pendiente">Pendiente</option>
          <option value="en_progreso">En progreso</option>
          <option value="completada">Completada</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Etiquetas</label>
        <div>
          <div class="form-check form-check-inline" v-for="etiqueta in etiquetas" :key="etiqueta">
            <input class="form-check-input" type="checkbox" :id="'etiqueta-' + etiqueta.etiqueta"
              :value=etiqueta.etiqueta v-model="tarea.etiquetas" />
            <label class="form-check-label" :for="'etiqueta-' + etiqueta.etiqueta">{{ etiqueta.etiqueta }}</label>
          </div>
        </div>
      </div>

      <div class="col-auto">
        <label class="form-label">Vence</label>
        <input v-model="tarea.fecha_vencimiento" type="date" class="form-control" />
      </div>

    </div>

    <div class="d-flex justify-content-end gap-2">
      <button class="btn btn-success col-6" type="submit">Guardar</button>
      <button type="button" class="btn btn-secondary col-6" @click="volver">Volver</button>
    </div>
  </form>
</template>

<script setup lang="ts">

import { ref, onMounted } from 'vue';
import { useTareaStore, Tarea } from '@/stores/tareaStore';
import { useEtiquetaStore } from '@/stores/etiquetaStore';
import { useRoute, useRouter } from 'vue-router';

const storeTarea = useTareaStore();
const storeEtiqueta = useEtiquetaStore();
const route = useRoute();
const router = useRouter();

const tarea = ref<Partial<Tarea>>({
  titulo: '',
  descripcion: '',
  estado: 'pendiente',
  fecha_vencimiento: undefined,
  prioridad_id: 1,
  etiquetas: [],
});

const etiquetas = ref<string[]>([]);

onMounted(async () => {

  etiquetas.value = await storeEtiqueta.fetchEtiquetas();

  if (route.params.id) {
    tarea.value = await storeTarea.fetchTarea(Number(route.params.id));
  }
});

async function submit() {
  if (route.params.id) {
    await storeTarea.modificarTarea(tarea.value as Tarea);
  } else {
    await storeTarea.crearTarea(tarea.value);
  }
  router.push('/');
}

function volver() {
  router.back()
}
</script>
