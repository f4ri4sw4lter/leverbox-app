import { defineStore } from 'pinia';
import api from '../services/api';

export interface Tarea {
  id: number;
  titulo: string;
  descripcion: string;
  estado: 'pendiente' | 'en_progreso' | 'completada';
  fecha_vencimiento?: string;
  prioridad_id: number;
  etiquetas?: string[];
}

export const useTareaStore = defineStore('tareaStore', {
  state: () => ({
    tareas: [] as Tarea[],
  }),
  actions: {
    async fetchTarea(id: number) {
      try {
        const { data } = await api.get(`/tareas/${id}`);
        return data.data;
      } catch (error) {
        console.error('Error fetching tarea:', error);
        throw error;
      }
    },
    async fetchTareas() {
      try {
        const { data } = await api.get('/tareas');
        this.tareas = data.data;
        return data.data;
      } catch (error) {
        throw error;
      }
    },
    async crearTarea(tarea: Partial<Tarea>) {
      const { data } = await api.post('/tareas', tarea);
      this.tareas.push(data);
    },
    async modificarTarea(tarea: Tarea) {
      console.log(tarea)
      const { data } = await api.put(`/tareas/${tarea.id}`, tarea);
      const index = this.tareas.findIndex(t => t.id === data.id);
      if (index !== -1) this.tareas[index] = data;
    },
    async eliminarTarea(id: number) {
      await api.delete(`/tareas/${id}`);
      this.tareas = this.tareas.filter(t => t.id !== id);
    },
  },
});
