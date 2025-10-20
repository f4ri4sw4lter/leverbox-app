import { defineStore } from 'pinia';
import api from '../services/api';

export interface Task {
  id: number;
  titulo: string;
  descripcion: string;
  estado: 'pendiente' | 'en_progreso' | 'completada';
  fecha_vencimiento?: string;
  prioridad_id: number;
  etiquetas?: string[];
}

export const useTaskStore = defineStore('taskStore', {
  state: () => ({
    tasks: [] as Task[],
  }),
  actions: {
    async fetchTask(id: number) {
      try {
        const { data } = await api.get(`/tareas/${id}`);
        return data.data;
      } catch (error) {
        console.error('Error fetching task:', error);
        throw error;
      }
    },
    async fetchTasks() {
      try {
        const { data } = await api.get('/tareas');
        this.tasks = data.data;
        return data.data;
      } catch (error) {
        console.error('Error fetching tasks:', error);
        throw error;
      }
    },
    async createTask(task: Partial<Task>) {
      const { data } = await api.post('/tareas', task);
      this.tasks.push(data);
    },
    async updateTask(task: Task) {
      const { data } = await api.put(`/tareas/${task.id}`, task);
      const index = this.tasks.findIndex(t => t.id === data.id);
      if (index !== -1) this.tasks[index] = data;
    },
    async deleteTask(id: number) {
      await api.delete(`/tareas/${id}`);
      this.tasks = this.tasks.filter(t => t.id !== id);
    },
  },
});
