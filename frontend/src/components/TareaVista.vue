<template>
    <button type="button" class="btn btn-secondary rounded mb-3" @click="volver"><i
            class="bi bi-arrow-left"></i></button>

    <form @submit.prevent="submit" class="">
        <div class="row g-3 mb-4">

            <p class="h3"><strong>{{ tarea.titulo }}</strong></p>

            <div class="mb-3 col-md-9">
                <label class="form-label">Descripción</label>
                <textarea v-model="tarea.descripcion" class="form-control height-auto" rows="1" ref="textarea"
                    placeholder="Agregue una descripción de la tarea" @input="autoResize"></textarea>

                <div class="d-flex justify-content-begin mt-3">
                    <transition name="fade">
                        <button class="btn btn-success col-auto" type="submit" v-show="mostrarGuardar">Guardar</button>
                    </transition>
                </div>
            </div>

            <div class="col-md-3 border border-secondary rounded p-3">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto">
                        <label class="form-label">Estado</label>
                        <select v-model="tarea.estado" class="form-select select-estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="en_progreso">En progreso</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>

                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Etiquetas</label>
                        <div>
                            <div class="form-check form-check-inline" v-for="etiqueta in etiquetas" :key="etiqueta.id">
                                <!-- usar v-model en tarea.etiquetas (array de ids). quitar :checked/isChecked y no vincular al objeto etiqueta -->
                                <input class="form-check-input" type="checkbox" :id="'etiqueta-' + etiqueta.id"
                                    :value="etiqueta.id" v-model="tarea.etiquetas" />
                                <label class="form-check-label" :for="'etiqueta-' + etiqueta.id">
                                    {{ etiqueta.etiqueta }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="col-auto">
                        <label class="form-label">Vence</label>
                        <input v-model="tarea.fecha_vencimiento" type="date" class="form-control" />
                    </div>

                    <hr>

                    <div class="col-auto d-flex">
                        <div class="col-auto">
                            <label class="form-label">Prioridad</label>
                            <select v-model="tarea.prioridad_id" class="form-select select-prioridad">
                                <option value="1">BAJA</option>
                                <option value="2">MEDIA</option>
                                <option value="3">ALTA</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <div class="col-auto d-flex">
                        <button type="button" class="btn btn-sm btn-danger" @click="confirmarBorrado">Borrar tarea <i
                                class="bi bi-trash-fill"></i></button>
                    </div>

                </div>
            </div>
        </div>

    </form>
</template>

<script setup lang="ts">

import { ref, onMounted, nextTick, watch } from 'vue';
import { useTareaStore, Tarea } from '@/stores/tareaStore';
import { useEtiquetaStore } from '@/stores/etiquetaStore';
import { useRoute, useRouter } from 'vue-router';

const props = defineProps<{ id?: string | number }>();

const storeTarea = useTareaStore();
const storeEtiqueta = useEtiquetaStore();
const route = useRoute();
const router = useRouter();
const mostrarGuardar = ref(false)
const etiquetas = ref<Object[]>([]);
const textarea = ref<HTMLTextAreaElement | null>(null)
const tarea = ref<Partial<Tarea>>({
    titulo: '',
    descripcion: '',
    estado: 'pendiente',
    fecha_vencimiento: undefined,
    prioridad_id: 1,
    etiquetas: [],
});

watch(
    tarea,
    (nuevaTarea, anteriorTarea) => {
        mostrarGuardar.value = true
    },
    { deep: true }
)

onMounted(async () => {
    etiquetas.value = await storeEtiqueta.fetchEtiquetas();
    tarea.value = await storeTarea.fetchTarea(Number(route.params.id));
    tarea.value.etiquetas = (tarea.value.etiquetas ?? []).map((e: any) =>
        typeof e === 'number' ? e : (e?.id ?? e)
    );
    nextTick(() => autoResize())
});

watch(() => tarea.value.descripcion, () => nextTick(() => autoResize()))

function autoResize() {
    if (!textarea.value) return
    textarea.value.style.height = 'auto' // reset
    textarea.value.style.height = textarea.value.scrollHeight + 'px' // ajustar
}

function volver() {
    router.back()
}

async function submit() {
    await storeTarea.modificarTarea(tarea.value as Tarea);
    router.push('/');
}

async function confirmarBorrado() {
    const confirmado = window.confirm('¿Estás seguro que quieres borrar esta tarea? Esta acción no se puede deshacer.');
    if (!confirmado) return;
    await borrarTarea();
}

async function borrarTarea() {
    await storeTarea.eliminarTarea(props.id);
    router.push('/');
}

function isChecked(etiquetaId: number) {

    const { etiquetas } = tarea.value;
    return etiquetas.some(e => e.id === etiquetaId);
}
</script>
