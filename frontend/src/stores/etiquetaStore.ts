import { defineStore } from 'pinia';
import api from '../services/api';

export interface Etiqueta {
  id: number;
  etiqueta: string;
}

export const useEtiquetaStore = defineStore('etiquetaStore', {
  state: () => ({
    etiquetas: [] as Etiqueta[],
  }),
  actions: {
    async fetchEtiquetas() {
      try {
        const { data } = await api.get('/etiquetas');
        this.etiquetas = data.data;
        return data.data;
      } catch (error) {
        throw error;
      }
    },
  },
});
